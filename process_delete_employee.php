<?php
session_start();

// Replace with your database connection details
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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['employeeID'])) {
    $employeeID = $_GET['employeeID'];

    // Start a transaction
    $conn->begin_transaction();

    // Delete related records from سجل_تحديث_مكافحة_الفيروسات table
    $sqlDeleteAntivirus = "DELETE FROM سجل_تحديث_مكافحة_الفيروسات WHERE معرف_الموظف = ?";
    $stmtAntivirus = $conn->prepare($sqlDeleteAntivirus);
    $stmtAntivirus->bind_param("i", $employeeID);
    $stmtAntivirus->execute();
    $stmtAntivirus->close();

    // Delete related records from سجل_صيانة table
    $sqlDeleteMaintenance = "DELETE FROM سجل_صيانة WHERE معرف_الموظف = ?";
    $stmtMaintenance = $conn->prepare($sqlDeleteMaintenance);
    $stmtMaintenance->bind_param("i", $employeeID);
    $stmtMaintenance->execute();
    $stmtMaintenance->close();

    // Delete related records from سجل_نسخ_ويندوز table
    $sqlDeleteWindows = "DELETE FROM سجل_نسخ_ويندوز WHERE معرف_الموظف = ?";
    $stmtWindows = $conn->prepare($sqlDeleteWindows);
    $stmtWindows->bind_param("i", $employeeID);
    $stmtWindows->execute();
    $stmtWindows->close();

    // Delete employee record using prepared statement
    $sqlDeleteEmployee = "DELETE FROM الموظفون WHERE معرف_الموظف = ?";
    $stmtEmployee = $conn->prepare($sqlDeleteEmployee);
    $stmtEmployee->bind_param("i", $employeeID);

    if ($stmtEmployee->execute()) {
        $conn->commit();
        $_SESSION['notification'] = "Employee deleted successfully.";
    } else {
        $conn->rollback();
        $_SESSION['notification'] = "Error deleting employee: " . $stmtEmployee->error;
    }

    $stmtEmployee->close();
}

$conn->close();

// Redirect back to the employee list page
header("Location: employees.php");
exit();
?>
