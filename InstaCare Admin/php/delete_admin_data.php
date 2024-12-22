<?php
session_start();
include('../../database/database_conn.php');

if (isset($_GET['nurse_id'])) {
    $nurse_id = $_GET['nurse_id'];

    $stmt = $conn->prepare("DELETE FROM nurse_db WHERE nurse_id = ?");
    $stmt->bind_param("s", $nurse_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Record deleted successfully.";
    } else {
        $_SESSION['errors'] = ["Error deleting record: " . $stmt->error];
    }

    $stmt->close();
    $conn->close();

    header("Location: ../admin.php");
    exit();
} else {
    $_SESSION['errors'] = ["No ID provided for deletion."];
    header("Location: ../admin.php");
    exit();
}
