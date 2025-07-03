<?php
session_start();
include "db_connect.php";

// Only therapists can access this page
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "therapist") {
    header("Location: login.php");
    exit();
}

$therapist_name = $_SESSION["name"];
$therapist_id = $_SESSION["user_id"];
$error = "";

// Handle appointment status update (approve/reject)
if (isset($_POST["update_appointment_status"])) {
    $appointment_id = $_POST["appointment_id"];
    $new_status = $_POST["status"];
    $sql = "UPDATE appointments SET status = '$new_status' WHERE id = $appointment_id AND therapist_name = '$therapist_name'";
    if (!$conn->query($sql)) {
        $error = "Failed to update appointment status.";
    }
}

// Handle sending message to user
if (isset($_POST["send_message"])) {
    $user_id = $_POST["user_id"];
    $message_content = trim($_POST["message_content"]);
    if ($message_content !== "") {
        $sql = "INSERT INTO messages (user_id, therapist_name, message) VALUES ('$user_id', '$therapist_name', '$message_content')";
        $conn->query($sql);
    }
}

// Fetch appointments assigned to therapist
$appointments_result = $conn->query("SELECT a.*, u.name AS user_name, u.email AS user_email FROM appointments a JOIN users u ON a.user_id = u.id WHERE a.therapist_name = '$therapist_name' ORDER BY a.appointment_date, a.appointment_time");

// Fetch all users who have appointments with this therapist (for chat selection)
$chat_users_result = $conn->query("SELECT DISTINCT u.id, u.name FROM users u JOIN appointments a ON u.id = a.user_id WHERE a.therapist_name = '$therapist_name'");

// Handle chat user selection
$chat_user_id = isset($_GET["chat_user_id"]) ? intval($_GET["chat_user_id"]) : null;
$chat_user_name = "";
$chat_messages = [];

if ($chat_user_id) {
    // Get chat user name
    $user_check = $conn->query("SELECT name FROM users WHERE id = $chat_user_id");
    if ($user_check->num_rows == 1) {
        $chat_user_name = $user_check->fetch_assoc()["name"];

        // Fetch chat messages between this therapist and selected user
        $stmt = $conn->prepare("SELECT * FROM messages WHERE (user_id = ? AND therapist_name = ?) ORDER BY sent_at ASC");
        $stmt->bind_param("is", $chat_user_id, $therapist_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $chat_messages = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } else {
        $chat_user_id = null; // invalid user id
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Therapist Dashboard - GreenLife</title>
    <style>
        body { font-family: Arial, sans-serif; background: #e2f0d9; padding: 20px; }
        h2 { color: #4caf50; }
        .logout { text-align: right; margin-bottom: 10px; }
        .section { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 0 5px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #4caf50; color: white; }
        select, textarea, input[type=text] { width: 100%; padding: 8px; margin: 6px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { background: #4caf50; color: white; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #45a049; }
        .chat-container { display: flex; gap: 20px; }
        .chat-users { width: 25%; background: #f7f7f7; padding: 15px; border-radius: 10px; height: 400px; overflow-y: auto; }
        .chat-messages { width: 70%; background: #fff; padding: 15px; border-radius: 10px; height: 400px; display: flex; flex-direction: column; }
        .message { margin-bottom: 10px; padding: 8px; border-radius: 5px; max-width: 70%; }
        .message.user { background: #d0e7ff; align-self: flex-start; }
        .message.therapist { background: #c8f7c5; align-self: flex-end; }
        .message-time { font-size: 0.7em; color: #666; }
        form.chat-form { margin-top: auto; }
        form.chat-form textarea { height: 60px; resize: none; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="logout">
        Welcome, <?php echo htmlspecialchars($therapist_name); ?> |
        <a href="logout.php" style="color: #4caf50; text-decoration: none;">Logout</a>
    </div>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="section">
        <h2>📅 Your Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($appointment = $appointments_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($appointment["user_name"]); ?></td>
                        <td><?php echo htmlspecialchars($appointment["service"]); ?></td>
                        <td><?php echo htmlspecialchars($appointment["appointment_date"]); ?></td>
                        <td><?php echo htmlspecialchars($appointment["appointment_time"]); ?></td>
                        <td><?php echo htmlspecialchars($appointment["status"]); ?></td>
                        <td>
                            <form method="post" style="display:inline-block;">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                <select name="status" required>
                                    <option value="">--Select--</option>
                                    <option value="Approved" <?php if($appointment["status"] == "Approved") echo "selected"; ?>>Approve</option>
                                    <option value="Rejected" <?php if($appointment["status"] == "Rejected") echo "selected"; ?>>Reject</option>
                                    <option value="Pending" <?php if($appointment["status"] == "Pending") echo "selected"; ?>>Pending</option>
                                </select>
                                <button type="submit" name="update_appointment_status">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>💬 Chat with Users</h2>
        <div class="chat-container">
            <div class="chat-users">
                <h3>Users</h3>
                <?php if ($chat_users_result->num_rows > 0): ?>
                    <ul style="list-style:none; padding-left:0;">
                        <?php while ($user = $chat_users_result->fetch_assoc()): ?>
                            <li style="margin-bottom:8px;">
                                <a href="?chat_user_id=<?php echo $user['id']; ?>" style="text-decoration:none; color:<?php echo ($chat_user_id == $user['id']) ? '#4caf50' : '#000'; ?>;">
                                    <?php echo htmlspecialchars($user['name']); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No users have booked appointments yet.</p>
                <?php endif; ?>
            </div>

            <div class="chat-messages">
                <?php if ($chat_user_id && $chat_user_name): ?>
                    <h3>Chat with <?php echo htmlspecialchars($chat_user_name); ?></h3>
                    <div style="flex-grow:1; overflow-y:auto; margin-bottom:10px; border: 1px solid #ccc; padding: 10px; border-radius: 5px; max-height: 320px;">
                        <?php
                        if (count($chat_messages) == 0) {
                            echo "<p>No messages yet.</p>";
                        } else {
                            foreach ($chat_messages as $msg) {
                                $isTherapist = ($msg["therapist_name"] == $therapist_name);
                                $class = $isTherapist ? "therapist" : "user";
                                $sender = $isTherapist ? "You" : htmlspecialchars($chat_user_name);
                                echo "<div class='message $class'>";
                                echo "<strong>$sender:</strong><br>" . nl2br(htmlspecialchars($msg["message"])) . "<br>";
                                echo "<div class='message-time'>" . $msg["sent_at"] . "</div>";
                                echo "</div>";
                            }
                        }
                        ?>
                    </div>
                    <form method="post" class="chat-form">
                        <input type="hidden" name="user_id" value="<?php echo $chat_user_id; ?>">
                        <textarea name="message_content" placeholder="Type your message here..." required></textarea>
                        <button type="submit" name="send_message">Send</button>
                    </form>
                <?php else: ?>
                    <p>Select a user from the left to chat.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
