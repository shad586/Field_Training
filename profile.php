<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة البروفايل</title>
</head>
<?php include 'header.php';?>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username'];
    ?>

    <h1>مرحبًا، <?php echo $username; ?>!</h1>
    <h2>بروفايلك</h2>

    <?php
    // Replace with your database connection details
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "deptmange";
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    // Fetch user information
    $sql = "SELECT * FROM المستخدمون WHERE اسم_المستخدم = '$username'";
    $result = $conn->query($sql);
    ?>

    <a href="logout.php">تسجيل الخروج</a>
</body>
</html>
