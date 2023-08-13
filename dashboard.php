<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرئيسية</title>
    <link rel="stylesheet" href="style.css">
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
            background-color: #333;
            border:none;
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

        .dashboard-container {
            width: 400px;
            margin: 150px auto;
            padding: 50px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
          
        }

        .statistics {
            /* ... (إعدادات الإحصائيات) ... */
        }

        .move-button {
            text-align: center;
        }

        .move-button a.button {
            background-color: #333;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .move-button a.button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">الرئيسية</a></li>
                <li><a href="employees.php">قائمة الموظفين</a></li>
                <li><a href="logout.php">تسجيل الخروج</a></li>
            </ul>
        </nav>
    </header>

    <div class="dashboard-container">
        <div class="welcome-message">
            <?php
            session_start();
            if(isset($_SESSION["username"])) {
                $username = $_SESSION["username"];
                echo "مرحبًا بك في موقع إدارة الموظفين، $username!";
            }
            ?>
        </div>
        <div class="statistics">
            <!-- ... (كود PHP الخاص بالإحصائيات) ... -->
        </div>
        <div class="move-button">
            <a href="employees.php" class="button">الانتقال إلى قائمة الموظفين</a>
        </div>
    </div>
</body>
</html>
