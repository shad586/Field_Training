<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeID = $_POST['employeeID'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $resolution = $_POST['resolution'];
    
    // Insert the maintenance issue into the database
    $sql = "INSERT INTO سجل_صيانة (معرف_المستخدم, معرف_الموظف, تاريخ_الصيانة, وصف_المشكلة, القرار) 
            VALUES (1, $employeeID, '$date', '$description', '$resolution')";
            
    if ($conn->query($sql) === TRUE) {
        echo "تمت إضافة مشكلة الصيانة بنجاح!";
    } else {
        echo "حدث خطأ أثناء إضافة مشكلة الصيانة: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
