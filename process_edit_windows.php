<?php
// ... (database connection setup)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recordID = $_POST['recordID'];
    $updateStatus = $_POST['updateStatus'];
    $updateDate = $_POST['updateDate'];

    // Update record in the database
    $sqlUpdate = "UPDATE سجل_تحديث_مكافحة_الفيروسات SET حالة_التحديث = ?, تاريخ_التحديث = ? WHERE معرف_تحديث_مكافحة_الفيروسات = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);

    if ($stmtUpdate) {
        $stmtUpdate->bind_param("iss", $updateStatus, $updateDate, $recordID);
        $stmtUpdate->execute();
        $stmtUpdate->close();
    }
}

$conn->close();
header("Location: history.php?employeeID=" . $_POST['employeeID']);
exit();
?>
