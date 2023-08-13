<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['employeeID'])) {
    $employeeID = $_POST['employeeID'];
    $version = $_POST['version'];
    $updateDate = $_POST['updateDate'];

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

    // Insert the new record
    $sqlInsert = "INSERT INTO سجل_نسخ_ويندوز (معرف_الموظف, نسخة_ويندوز, تاريخ_التحديث) VALUES ($employeeID, '$version', '$updateDate')";
    if ($conn->query($sqlInsert) === TRUE) {
        // Redirect back to your original page
        header("Location: windows_version_history.php?employeeID=$employeeID");
        exit();
    } else {
        echo "Error adding record: " . $conn->error;
    }

    $conn->close();
}
?>
