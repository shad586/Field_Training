<?php
// Replace with your database connection details
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "deptmange";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['antivirusID'])) {
    $antivirusID = $_POST['antivirusID'];

    $sql = "DELETE FROM سجل_تحديث_مكافحة_الفيروسات WHERE معرف_تحديث_مكافحة_الفيروسات = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $antivirusID);
        $stmt->execute();
    }
    $stmt->close();
}

$conn->close();
?>
