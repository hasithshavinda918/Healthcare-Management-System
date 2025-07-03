<?php
session_start();
include "db_connect.php";

// Protect page: only logged-in users with role 'user'
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "user") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$name = $_SESSION["name"];

// Fetch therapists for dropdowns
$therapists_result = $conn->query("SELECT name FROM users WHERE role = 'therapist'");

// Handle appointment booking
if (isset($_POST["book_appointment"])) {
    $therapist_name = $_POST["therapist_name"];
    $service = $_POST["service"];
    $appointment_date = $_POST["appointment_date"];
    $appointment_time = $_POST["appointment_time"];

    // Basic validation can be added here

    $stmt = $conn->prepare("INSERT INTO appointments (user_id, therapist_name, service, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("issss", $user_id, $therapist_name, $service, $appointment_date, $appointment_time);
    $stmt->execute();
    $stmt->close();
}

// Handle profile update
if (isset($_POST["update_profile"])) {
    $new_name = $_POST["new_name"];
    $new_email = $_POST["new_email"];

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_name, $new_email, $user_id);
    if ($stmt->execute()) {
        $_SESSION["name"] = $new_name;
        $name = $new_name;
    }
    $stmt->close();
}

// Handle sending message to therapist
if (isset($_POST["send_message"])) {
    $therapist_name_msg = $_POST["msg_therapist_name"];
    $message_content = trim($_POST["message_content"]);

    if ($message_content !== "") {
        $stmt = $conn->prepare("INSERT INTO messages (user_id, therapist_name, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $therapist_name_msg, $message_content);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch booked appointments for this user
$appointments_result = $conn->query("SELECT * FROM appointments WHERE user_id = '$user_id' ORDER BY appointment_date DESC, appointment_time DESC");

// Fetch all therapists for chat dropdown
$therapists_for_chat = $conn->query("SELECT name FROM users WHERE role = 'therapist'");

// Chat therapist selected by user (via GET)
$selected_therapist = isset($_GET['chat_therapist']) ? $_GET['chat_therapist'] : null;
$chat_messages = [];

if ($selected_therapist) {
    // Prepare statement to fetch messages between this user and selected therapist
    $stmt = $conn->prepare("SELECT * FROM messages WHERE user_id = ? AND therapist_name = ? ORDER BY sent_at ASC");
    $stmt->bind_param("is", $user_id, $selected_therapist);
    $stmt->execute();
    $result = $stmt->get_result();
    $chat_messages = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard - GreenLife</title>
    <style>
        body { font-family: Arial, sans-serif; background: #e2f0d9; padding: 20px; }
        h2 { color: #4caf50; }
        .section { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 0 5px rgba(0,0,0,0.1); }
        input, select, textarea { width: 100%; padding: 8px; margin: 6px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { background: #4caf50; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #45a049; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #4caf50; color: white; }
        .logout { text-align: right; margin-bottom: 10px; }
        /* Chat styles */
        .chat-container { display: flex; gap: 20px; }
        .chat-select { width: 25%; }
        .chat-box { width: 70%; display: flex; flex-direction: column; background: #fff; padding: 15px; border-radius: 10px; max-height: 400px; }
        .messages { flex-grow: 1; overflow-y: auto; border: 1px solid #ccc; padding: 10px; border-radius: 5px; margin-bottom: 10px; }
        .message { max-width: 70%; margin-bottom: 10px; padding: 8px; border-radius: 10px; }
        .message.user { background-color: #c8f7c5; align-self: flex-end; }
        .message.therapist { background-color: #d0e7ff; align-self: flex-start; }
        .message-time { font-size: 0.75em; color: #666; }
        form.chat-form textarea { height: 60px; resize: none; }
        form.chat-form button { width: 100%; }
        a.therapist-link { text-decoration: none; color: #000; display: block; padding: 8px; border-radius: 5px; margin-bottom: 5px; }
        a.therapist-link.selected { background-color: #4caf50; color: white; }
    </style>
</head>
<body>
    <div class="logout">
        Welcome, <?php echo htmlspecialchars($name); ?> |
        <a href="logout.php" style="color: #4caf50; text-decoration: none;">Logout</a>
    </div>

    <div class="section">
        <h2>📅 Book Appointment</h2>
        <form method="post">
            <label>Select Therapist:</label>
            <select name="therapist_name" required>
                <option value="">-- Select Therapist --</option>
                <?php
                $therapists_result->data_seek(0); // reset pointer
                while ($therapist = $therapists_result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($therapist["name"]) . "'>" . htmlspecialchars($therapist["name"]) . "</option>";
                }
                ?>
            </select>
            <input type="text" name="service" placeholder="Service (e.g., Yoga, Massage)" required>
            <input type="date" name="appointment_date" required>
            <input type="time" name="appointment_time" required>
            <button type="submit" name="book_appointment">Book Appointment</button>
        </form>
    </div>

    <div class="section">
        <h2>✅ Your Booked Appointments</h2>
        <table>
            <tr>
                <th>Therapist</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $appointments_result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["therapist_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["service"]); ?></td>
                    <td><?php echo htmlspecialchars($row["appointment_date"]); ?></td>
                    <td><?php echo htmlspecialchars($row["appointment_time"]); ?></td>
                    <td><?php echo htmlspecialchars($row["status"]); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <div class="section">
        <h2>✏️ Edit Profile</h2>
        <form method="post">
            <input type="text" name="new_name" placeholder="New Name" value="<?php echo htmlspecialchars($name); ?>" required>
            <input type="email" name="new_email" placeholder="New Email" required>
            <button type="submit" name="update_profile">Update Profile</button>
        </form>
    </div>

    <div class="section">
        <h2>💬 Chat with Therapist</h2>
        <div class="chat-container">
            <div class="chat-select">
                <h3>Select Therapist</h3>
                <?php if ($therapists_for_chat->num_rows > 0): ?>
                    <?php while ($therapist = $therapists_for_chat->fetch_assoc()): ?>
                        <a href="?chat_therapist=<?php echo urlencode($therapist['name']); ?>" 
                           class="therapist-link <?php echo ($selected_therapist == $therapist['name']) ? 'selected' : ''; ?>">
                            <?php echo htmlspecialchars($therapist['name']); ?>
                        </a>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No therapists available.</p>
                <?php endif; ?>
            </div>
            <div class="chat-box">
                <?php if ($selected_therapist): ?>
                    <h3>Chatting with <?php echo htmlspecialchars($selected_therapist); ?></h3>
                    <div class="messages" id="messages">
                        <?php if (count($chat_messages) == 0): ?>
                            <p>No messages yet. Say hi!</p>
                        <?php else: ?>
                            <?php foreach ($chat_messages as $msg): 
                                $is_user_msg = ($msg["therapist_name"] != $selected_therapist); // User messages have therapist_name = therapist, so reverse check
                                $class = $is_user_msg ? "user" : "therapist";
                            ?>
                                <div class="message <?php echo $class; ?>">
                                    <div><?php echo nl2br(htmlspecialchars($msg["message"])); ?></div>
                                    <div class="message-time"><?php echo $msg["sent_at"]; ?></div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <form method="post" class="chat-form">
                        <input type="hidden" name="msg_therapist_name" value="<?php echo htmlspecialchars($selected_therapist); ?>">
                        <textarea name="message_content" placeholder="Type your message here..." required></textarea>
                        <button type="submit" name="send_message">Send</button>
                    </form>
                <?php else: ?>
                    <p>Select a therapist from the left to start chatting.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>
