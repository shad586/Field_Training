<?php
if (isset($_POST['addEmployee'])) {
    // Replace with your database connection details
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "deptmange"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $department = $_POST['department'];
    $macAddress = $_POST['macAddress'];
    $ram = $_POST['ram'];
    $osType = $_POST['osType'];

    // Insert new employee into the database
    $sql = "INSERT INTO الموظفون (الاسم, القسم, MAC_عنوان, RAM_الذاكره, نوع_النظام) VALUES ('$name', '$department', '$macAddress', '$ram', '$osType')";

    if ($conn->query($sql) === TRUE) {
        echo "تمت إضافة الموظف بنجاح.";
    } else {
        echo "حدث خطأ أثناء إضافة الموظف: " . $conn->error;
    }

    $conn->close();
}

// Redirect back to the employee list page
header("Location: employees.php");
exit();
?>
