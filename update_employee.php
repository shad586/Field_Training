<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "deptmange";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['employeeID'])) {
    $employeeID = $_POST['employeeID'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $systemType = $_POST['systemType'];
    $ramMemory = $_POST['ramMemory'];

    $sql = "UPDATE الموظفون SET الاسم = '$name', القسم = '$department', نوع_النظام = '$systemType', RAM_الذاكره = '$ramMemory' WHERE معرف_الموظف = $employeeID";

    if ($conn->query($sql) === TRUE) {
        // Redirect to employee list page after successful update
        header("Location: employees.php");
        exit();
    } else {
        echo "حدث خطأ أثناء تحديث معلومات الموظف: " . $conn->error;
    }
}

$conn->close();
?>
