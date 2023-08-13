<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['windowsID'])) {
    $windowsID = $_POST['windowsID'];

    // Replace this with your database connection code
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "deptmange"; // your database name

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the record using prepared statement
    $sqlDelete = "DELETE FROM سجل_نسخ_ويندوز WHERE معرف_نسخة_ويندوز = ?";
    
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $windowsID);
    
    if ($stmt->execute()) {
        // Redirect back to your original page
        header("Location: windows_version_history.php?employeeID=$employeeID");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
