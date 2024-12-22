<?php
session_start();
include ('../../database/database_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['student_id'])) {
        die("Error: No student ID found in session.");
    }

    $student_id = $_SESSION['student_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $health_concern = $_POST['health-concern'];
    $reason = $_POST['reason'];
    
    date_default_timezone_set('Asia/Manila');

    $dateTime = new DateTime();
    $currentDate = $dateTime->format("F j, Y"); 
    $currentTime = $dateTime->format("g:ia"); 


        $stmt = $conn->prepare("INSERT INTO appointment_db (student_id, appointment_date, appoinment_time, health_concern, reason) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $student_id, $currentDate, $currentTime, $health_concern, $reason);
    
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
?>
