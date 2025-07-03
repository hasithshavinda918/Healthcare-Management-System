<?php
session_start();
include "db_connect.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password_input = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password_input, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["name"] = $row["name"];

            if ($row["role"] == "user") {
                header("Location: user_dashboard.php");
            } elseif ($row["role"] == "therapist") {
                header("Location: therapist_dashboard.php");
            } elseif ($row["role"] == "admin") {
                header("Location: admin_dashboard.php");
            }
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No user found with this email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - GreenLife Wellness Center</title>
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

        .login-container {
            position: relative;
            z-index: 10;
            animation: float 6s ease-in-out infinite;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 50px;
            border-radius: 25px;
            width: 420px;
            animation: glow 4s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        .login-box::before {
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
            content: '🌿';
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
        }

        .form-group input {
            width: 100%;
            padding: 18px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.9);
            color: #2d3748;
        }

        .form-group input:focus {
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

        .login-btn {
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
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:active {
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

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .register-link {
            color: #718096;
            font-size: 15px;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .register-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .register-link a:hover {
            color: #764ba2;
        }

        .register-link a:hover::after {
            width: 100%;
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .login-box {
                width: 90%;
                padding: 30px 20px;
                margin: 20px;
            }
            
            h2 {
                font-size: 28px;
            }
            
            .form-group input {
                padding: 16px 18px;
            }
            
            .login-btn {
                padding: 16px;
                font-size: 16px;
            }
        }

        /* Enhanced focus states for accessibility */
        .form-group input:focus-visible,
        .login-btn:focus-visible,
        .register-link a:focus-visible {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo"></div>
            <h2>Welcome Back</h2>
            <p class="subtitle">Sign in to your GreenLife account</p>
            
            <?php
            if ($error != "") {
                echo "<div class='error'>$error</div>";
            }
            ?>
            
            <form method="post">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Enter your email address" required>
                </div>
                
                <div class="form-group">
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                
                <button type="submit" class="login-btn">Sign In</button>
            </form>
            
            <div class="register-link">
                Don't have an account? <a href="register.php">Create one here</a>
            </div>
        </div>
    </div>
</body>
</html>