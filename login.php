<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <style>
                      body {
            font-family: "Helvetica Neue", sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline-block;
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #ffd700;
        }

        .login-container {
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .login-container form {
            text-align: center;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            margin-right: -10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container button:hover {
            background-color: #555;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        html[lang="ar"] {
    direction: rtl;
}

    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">الرئيسية</a></li>
            </ul>
        </nav>
    </header>

    <div class="login-container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h1>تسجيل الدخول</h1>
            <input type="text" name="username" placeholder="اسم المستخدم" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button type="submit">تسجيل الدخول</button>
        </form>
        
        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
        
            // Replace with your database connection details
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $dbname = "deptmange"; // your database name
        
            // Create connection
            $conn = new mysqli($servername, $db_username, $db_password, $dbname);
        
            // Check connection
            if ($conn->connect_error) {
                die("فشل الاتصال: " . $conn->connect_error);
            }
        
            $sql = "SELECT * FROM المستخدمون WHERE اسم_المستخدم = '$username' AND كلمة_المرور = '$password'";
            $result = $conn->query($sql);
        
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION["user_id"] = $row["معرف_المستخدم"];
                $_SESSION["username"] = $row["اسم_المستخدم"];
                header("Location: dashboard.php"); // Redirect to the control panel or desired page
            } else {
                echo '<p class="error-message">اسم المستخدم أو كلمة المرور غير صحيحة.</p>';
            }
        
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
