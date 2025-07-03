<?php
session_start();
include "db_connect.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password_input = $_POST["password"];
    $role = $_POST["role"];

    // Check if email already exists
    $check_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $error = "An account with this email already exists.";
    } else {
        $hashed_password = password_hash($password_input, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, role) 
                VALUES ('$name', '$email', '$hashed_password', '$role')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION["user_id"] = $conn->insert_id;
            $_SESSION["role"] = $role;
            $_SESSION["name"] = $name;

            // Redirect to appropriate dashboard
            if ($role == "user") {
                header("Location: user_dashboard.php");
            } elseif ($role == "therapist") {
                header("Location: therapist_dashboard.php");
            } elseif ($role == "admin") {
                header("Location: admin_dashboard.php");
            }
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - GreenLife Wellness Center</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
            padding: 20px 0;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: drift 20s linear infinite;
            z-index: 1;
        }

        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.03) 50%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
            z-index: 2;
        }

        @keyframes drift {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-50px, -50px) rotate(360deg); }
        }

        @keyframes shimmer {
            0%, 100% { opacity: 0; }
            50% { opacity: 1; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes glow {
            0%, 100% { box-shadow: 0 20px 60px rgba(0,0,0,0.15), 0 0 30px rgba(255,255,255,0.1); }
            50% { box-shadow: 0 25px 80px rgba(0,0,0,0.2), 0 0 40px rgba(255,255,255,0.15); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes slideInUp {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        .register-container {
            position: relative;
            z-index: 10;
            animation: float 6s ease-in-out infinite;
            width: 100%;
            max-width: 480px;
        }

        .register-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 50px;
            border-radius: 25px;
            width: 100%;
            animation: glow 4s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        .register-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
            background-size: 200% 100%;
            animation: gradient-flow 3s ease infinite;
        }

        @keyframes gradient-flow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo::before {
            content: '🌱';
            font-size: 48px;
            display: block;
            margin-bottom: 10px;
            animation: pulse 2s ease-in-out infinite;
        }

        h2 {
            text-align: center;
            color: #2d3748;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .subtitle {
            text-align: center;
            color: #718096;
            font-size: 16px;
            margin-bottom: 40px;
            font-weight: 400;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
            animation: slideInUp 0.6s ease forwards;
            opacity: 0;
        }

        .form-group:nth-child(3) { animation-delay: 0.1s; }
        .form-group:nth-child(4) { animation-delay: 0.2s; }
        .form-group:nth-child(5) { animation-delay: 0.3s; }
        .form-group:nth-child(6) { animation-delay: 0.4s; }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 18px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.9);
            color: #2d3748;
            appearance: none;
        }

        .form-group select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 45px;
            cursor: pointer;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 1);
        }

        .form-group input::placeholder {
            color: #a0aec0;
            transition: all 0.3s ease;
        }

        .form-group input:focus::placeholder {
            opacity: 0.7;
            transform: translateY(-2px);
        }

        .form-group select option {
            padding: 12px;
            background: white;
            color: #2d3748;
        }

        .role-icons {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            padding: 0 5px;
        }

        .role-icon {
            font-size: 12px;
            color: #a0aec0;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .register-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-size: 18px;
            font-weight: 600;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            margin-bottom: 25px;
            animation: slideInUp 0.6s ease forwards 0.5s;
            opacity: 0;
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .register-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .register-btn:active {
            transform: translateY(-1px);
        }

        .error {
            background: linear-gradient(135deg, #fed7d7, #feb2b2);
            color: #c53030;
            text-align: center;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #fca5a5;
            font-weight: 500;
            animation: shake 0.5s ease-in-out;
        }

        .success {
            background: linear-gradient(135deg, #c6f6d5, #9ae6b4);
            color: #2f855a;
            text-align: center;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #68d391;
            font-weight: 500;
            animation: slideInUp 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            animation: slideInUp 0.6s ease forwards 0.6s;
            opacity: 0;
        }

        .login-link {
            color: #718096;
            font-size: 15px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        .login-link a:hover::after {
            width: 100%;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-grid .form-group {
            margin-bottom: 0;
        }

        .form-full {
            grid-column: 1 / -1;
        }

        /* Security indicator */
        .password-strength {
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
            position: relative;
        }

        .password-strength::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #fc8181, #f6ad55, #68d391);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .form-group input[type="password"]:focus + .password-strength::after {
            width: 100%;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .register-box {
                padding: 30px 20px;
                margin: 20px;
            }
            
            h2 {
                font-size: 28px;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .form-grid .form-group {
                margin-bottom: 25px;
            }
            
            .form-group input,
            .form-group select {
                padding: 16px 18px;
            }
            
            .register-btn {
                padding: 16px;
                font-size: 16px;
            }
        }

        /* Enhanced focus states for accessibility */
        .form-group input:focus-visible,
        .form-group select:focus-visible,
        .register-btn:focus-visible,
        .login-link a:focus-visible {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        /* Role selection enhancement */
        .form-group select:focus + .role-icons .role-icon {
            opacity: 1;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-box">
            <div class="logo"></div>
            <h2>Join GreenLife</h2>
            <p class="subtitle">Create your wellness journey account</p>
            
            <?php
            if ($error != "") {
                echo "<div class='error'>$error</div>";
            }
            if ($success != "") {
                echo "<div class='success'>$success</div>";
            }
            ?>
            
            <form method="post">
                <div class="form-grid">
                    <div class="form-group form-full">
                        <input type="text" name="name" placeholder="Enter your full name" required>
                    </div>
                    
                    <div class="form-group form-full">
                        <input type="email" name="email" placeholder="Enter your email address" required>
                    </div>
                    
                    <div class="form-group form-full">
                        <input type="password" name="password" placeholder="Create a secure password" required>
                        <div class="password-strength"></div>
                    </div>
                    
                    <div class="form-group form-full">
                        <select name="role" required>
                            <option value="">Choose your role</option>
                            <option value="user">Client - Seeking wellness services</option>
                            <option value="therapist">Therapist - Providing services</option>
                            <option value="admin">Administrator - Managing platform</option>
                        </select>
                        <div class="role-icons">
                            <span class="role-icon">👤 Client</span>
                            <span class="role-icon">🧘‍♀️ Therapist</span>
                            <span class="role-icon">⚙️ Admin</span>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="register-btn">Create Account</button>
            </form>
            
            <div class="login-link">
                Already have an account? <a href="login.php">Sign in here</a>
            </div>
        </div>
    </div>
</body>
</html>