<?php
session_start();
include("../../database/database_conn.php");

if (isset($_SESSION['nurse_id']) && isset($_GET['appointment_id'])) {
    $nurse_id = $_SESSION['nurse_id'];
    $appointment_id = mysqli_real_escape_string($conn, $_GET['appointment_id']);

    $query = "UPDATE appointment_db SET nurse_id = $nurse_id, appointment_status = 'Approve' WHERE appointment_id = $appointment_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: ../appointment.php');
        exit();
    } else {
        header('Location: ../appointment.php?error=' . urlencode(mysqli_error($conn)));
        exit();
    }
} else {
    echo $nurse_id;
    echo $appointment_id;
    echo "Missing nurse_id or medicine_request_id.";
}
