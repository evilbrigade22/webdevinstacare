<?php
session_start();
include('../../database/database_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['nurse_id'])) {
        die("Error: No student ID found in session.");
    }

    $nurse_id = $_SESSION['nurse_id'];

    $student_id = $_POST['student_id'];
    $compliant = $_POST['compliant'];
    $treatment = $_POST['treatment'];

    date_default_timezone_set('Asia/Manila');

    $dateTime = new DateTime();
    $currentDate = $dateTime->format("F j, Y");
    $currentTime = $dateTime->format("g:ia");


    $stmt = $conn->prepare("INSERT INTO accident_report_db (nurse_id, student_id, date_created, time_created, chief_complaint, treatment_intervention) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $nurse_id, $student_id, $currentDate, $currentTime, $compliant, $treatment);

    if ($stmt->execute()) {
        header("Location: ../accidentreport.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../accidentreport.php");
    exit();
}
