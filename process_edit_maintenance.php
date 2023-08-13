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
    $maintenanceID = $_POST['maintenanceID'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $resolution = $_POST['resolution'];
    
    // Update the maintenance record in the database
    $sql = "UPDATE سجل_صيانة SET تاريخ_الصيانة = '$date', وصف_المشكلة = '$description', القرار = '$resolution' WHERE معرف_صيانة = $maintenanceID";
            
    if ($conn->query($sql) === TRUE) {
        echo "تم تحديث سجل الصيانة بنجاح!";
    } else {
        echo "حدث خطأ أثناء تحديث سجل الصيانة: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
