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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['recordID'])) {
    $recordID = $_POST['recordID'];
    $status = $_POST['status'];
    $updateDate = $_POST['updateDate'];

    $sql = "UPDATE سجل_تحديث_مكافحة_الفيروسات SET حالة_التحديث = ?, تاريخ_التحديث = ? WHERE معرف_تحديث_مكافحة_الفيروسات = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssi", $status, $updateDate, $recordID);
        $stmt->execute();
    }
    $stmt->close();
}

$conn->close();
header("Location: your_page_url_here"); // Redirect back to the page with the history list
exit();
?>
