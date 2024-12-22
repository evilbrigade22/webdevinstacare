<?php
session_start();
include('../../database/database_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['student_id'])) {
        die("Error: No student ID found in session.");
    }

    $student_id = $_SESSION['student_id'];
    $medicine = $_POST['medicine'];
    $quantity = $_POST['quantity'];
    $health_concern = $_POST['health-concern'];


    date_default_timezone_set('Asia/Manila');

    $dateTime = new DateTime();
    $currentDate = $dateTime->format("F j, Y");
    $currentTime = $dateTime->format("g:ia");


    $stmt = $conn->prepare("INSERT INTO medicine_request_db (student_id, product_id, date_requested, time_requested, quantity, health_concern) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissis", $student_id, $medicine, $currentDate, $currentTime, $quantity, $health_concern);

    if ($stmt->execute()) {
        header("Location: ../homepage.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../homepage.php");
    exit();
}
