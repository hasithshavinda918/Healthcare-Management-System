<?php
session_start();
include "db_connect.php";

// Only admin can access
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}

$error = "";
$success = "";

// Handle update user info
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, role=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $role, $user_id);
    if ($stmt->execute()) {
        $success = "User updated successfully.";
    } else {
        $error = "Failed to update user.";
    }
    $stmt->close();
}

// Handle update appointment info
if (isset($_POST['update_appointment'])) {
    $appointment_id = $_POST['appointment_id'];
    $service = $_POST['service'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE appointments SET service=?, appointment_date=?, appointment_time=?, status=? WHERE id=?");
    $stmt->bind_param("ssssi", $service, $appointment_date, $appointment_time, $status, $appointment_id);
    if ($stmt->execute()) {
        $success = "Appointment updated successfully.";
    } else {
        $error = "Failed to update appointment.";
    }
    $stmt->close();
}

// Fetch all appointments (with user and therapist names)
$appointments = $conn->query("SELECT a.*, u.name AS user_name FROM appointments a JOIN users u ON a.user_id = u.id ORDER BY a.appointment_date DESC, a.appointment_time DESC");

// Fetch all users
$users = $conn->query("SELECT * FROM users ORDER BY role, name");

// Fetch therapists only
$therapists = $conn->query("SELECT * FROM users WHERE role='therapist' ORDER BY name");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - GreenLife</title>
    <style>
        body { font-family: Arial, sans-serif; background: #e2f0d9; padding: 20px; }
        h1, h2 { color: #4caf50; }
        .logout { text-align: right; margin-bottom: 20px; }
        .tabs { margin-bottom: 20px; }
        .tab-btn { background: #4caf50; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px 5px 0 0; margin-right: 5px; }
        .tab-btn.active { background: #388e3c; }
        .tab-content { background: white; padding: 20px; border-radius: 0 10px 10px 10px; box-shadow: 0 0 5px rgba(0,0,0,0.1); display: none; }
        .tab-content.active { display: block; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #4caf50; color: white; }
        input[type=text], input[type=email], select, input[type=date], input[type=time] {
            width: 90%;
            padding: 6px;
            margin: 2px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button.update-btn {
            background: #4caf50;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        button.update-btn:hover {
            background: #388e3c;
        }
        .message { margin-bottom: 10px; padding: 10px; border-radius: 5px; }
        .error { background: #f8d7da; color: #842029; }
        .success { background: #d1e7dd; color: #0f5132; }
    </style>
    <script>
        function openTab(tabName) {
            const tabs = document.querySelectorAll('.tab-content');
            const btns = document.querySelectorAll('.tab-btn');
            tabs.forEach(t => t.classList.remove('active'));
            btns.forEach(b => b.classList.remove('active'));
            document.getElementById(tabName).classList.add('active');
            document.getElementById('btn_' + tabName).classList.add('active');
        }
        window.onload = function() {
            openTab('appointments'); // open appointments tab by default
        }
    </script>
</head>
<body>

<div class="logout">
    Welcome, Admin <?php echo htmlspecialchars($_SESSION['name']); ?> |
    <a href="logout.php" style="color: #4caf50; text-decoration: none;">Logout</a>
</div>

<h1>Admin Dashboard - GreenLife Wellness Center</h1>

<?php if ($error): ?>
    <div class="message error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<?php if ($success): ?>
    <div class="message success"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>

<div class="tabs">
    <button class="tab-btn" id="btn_appointments" onclick="openTab('appointments')">Appointments</button>
    <button class="tab-btn" id="btn_users" onclick="openTab('users')">Users</button>
    <button class="tab-btn" id="btn_therapists" onclick="openTab('therapists')">Therapists</button>
</div>

<!-- Appointments Tab -->
<div id="appointments" class="tab-content">
    <h2>All Appointments</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Therapist</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($appt = $appointments->fetch_assoc()): ?>
            <tr>
                <form method="post">
                    <td><?php echo $appt['id']; ?><input type="hidden" name="appointment_id" value="<?php echo $appt['id']; ?>"></td>
                    <td><?php echo htmlspecialchars($appt['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($appt['therapist_name']); ?></td>
                    <td><input type="text" name="service" value="<?php echo htmlspecialchars($appt['service']); ?>" required></td>
                    <td><input type="date" name="appointment_date" value="<?php echo $appt['appointment_date']; ?>" required></td>
                    <td><input type="time" name="appointment_time" value="<?php echo $appt['appointment_time']; ?>" required></td>
                    <td>
                        <select name="status" required>
                            <option value="Pending" <?php if($appt['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Approved" <?php if($appt['status'] == 'Approved') echo 'selected'; ?>>Approved</option>
                            <option value="Rejected" <?php if($appt['status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
                        </select>
                    </td>
                    <td><button type="submit" name="update_appointment" class="update-btn">Update</button></td>
                </form>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Users Tab -->
<div id="users" class="tab-content">
    <h2>All Users</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $users->data_seek(0);
        while ($user = $users->fetch_assoc()): ?>
            <tr>
                <form method="post">
                    <td><?php echo $user['id']; ?><input type="hidden" name="user_id" value="<?php echo $user['id']; ?>"></td>
                    <td><input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required></td>
                    <td><input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required></td>
                    <td>
                        <select name="role" required>
                            <option value="user" <?php if($user['role']=='user') echo 'selected'; ?>>User</option>
                            <option value="therapist" <?php if($user['role']=='therapist') echo 'selected'; ?>>Therapist</option>
                            <option value="admin" <?php if($user['role']=='admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </td>
                    <td><button type="submit" name="update_user" class="update-btn">Update</button></td>
                </form>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Therapists Tab -->
<div id="therapists" class="tab-content">
    <h2>All Therapists</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $therapists->data_seek(0);
        while ($therapist = $therapists->fetch_assoc()): ?>
            <tr>
                <form method="post">
                    <td><?php echo $therapist['id']; ?><input type="hidden" name="user_id" value="<?php echo $therapist['id']; ?>"></td>
                    <td><input type="text" name="name" value="<?php echo htmlspecialchars($therapist['name']); ?>" required></td>
                    <td><input type="email" name="email" value="<?php echo htmlspecialchars($therapist['email']); ?>" required></td>
                    <td>
                        <select name="role" required>
                            <option value="user" <?php if($therapist['role']=='user') echo 'selected'; ?>>User</option>
                            <option value="therapist" <?php if($therapist['role']=='therapist') echo 'selected'; ?>>Therapist</option>
                            <option value="admin" <?php if($therapist['role']=='admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </td>
                    <td><button type="submit" name="update_user" class="update-btn">Update</button></td>
                </form>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
