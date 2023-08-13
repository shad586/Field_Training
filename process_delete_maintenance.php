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

if (isset($_POST['maintenanceID'])) {
    $maintenanceID = $_POST['maintenanceID'];


    // Delete the record from the database
    $sql = "DELETE FROM سجل_صيانة WHERE معرف_صيانة = $maintenanceID";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error; // Add this line to display errors
    }
}


// Close the database connection
$conn->close();
?>
