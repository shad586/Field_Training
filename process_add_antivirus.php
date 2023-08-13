<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeID = $_POST['employeeID'];
    $updateStatus = $_POST['updateStatus'];
    $updateDate = $_POST['updateDate'];

    // Insert new record into the database
    $sqlInsert = "INSERT INTO سجل_تحديث_مكافحة_الفيروسات (معرف_الموظف, حالة_التحديث, تاريخ_التحديث) VALUES (?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);

    if ($stmtInsert) {
        $stmtInsert->bind_param("iis", $employeeID, $updateStatus, $updateDate);
        $stmtInsert->execute();
        $stmtInsert->close();
    }
}

$conn->close();
header("Location: history.php?employeeID=" . $employeeID);
exit();
?>
