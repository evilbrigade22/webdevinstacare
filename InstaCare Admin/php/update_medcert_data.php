<?php
session_start();
include("../../database/database_conn.php");

if (isset($_SESSION['nurse_id']) && isset($_GET['medical_cert_id'])) {
    $nurse_id = $_SESSION['nurse_id'];
    $medical_cert_id = mysqli_real_escape_string($conn, $_GET['medical_cert_id']);

    $query = "UPDATE medcert_db SET nurse_id = $nurse_id, medcert_status = 'Approve' WHERE medical_cert_id = $medical_cert_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: ../medicalcertificaterequest.php');
        exit();
    } else {
        header('Location: ../medicalcertificaterequest.php?error=' . urlencode(mysqli_error($conn)));
        exit();
    }
} else {

    echo "Bobo si toni heheheh.";
}
