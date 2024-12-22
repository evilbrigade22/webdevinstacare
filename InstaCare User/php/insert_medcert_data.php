<?php
session_start();
include ('../../database/database_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['student_id'])) {
        die("Error: No student ID found in session.");
    }

    $student_id = $_SESSION['student_id'];
    $purpose = isset($_POST['purpose']) ? htmlspecialchars($_POST['purpose']) : null;
    $other_purpose = isset($_POST['other-purpose']) ? htmlspecialchars($_POST['other-purpose']) : null;
    
    date_default_timezone_set('Asia/Manila');

    $dateTime = new DateTime();
    $currentDate = $dateTime->format("F j, Y"); 
    $currentTime = $dateTime->format("g:ia"); 

    $uploadLaboratory = '';

    if (isset($_FILES['uploadLaboratory']) && $_FILES['uploadLaboratory']['error'] == 0) {
        $upload_dir = 'medcert_img/';
        if (!is_dir($upload_dir) && !mkdir($upload_dir, 0777, true)) {
            die("Failed to create upload directory.");
        }

        $file_name = basename($_FILES['uploadLaboratory']['name']);
        $unique_file_name = uniqid() . '-' . $file_name;
        $uploadLaboratory = $upload_dir . $unique_file_name;

        if (move_uploaded_file($_FILES['uploadLaboratory']['tmp_name'], $uploadLaboratory)) {
            echo "File uploaded successfully: " . $uploadLaboratory;
        } else {
            die("Failed to upload image.");
        }
    } else {
        if (isset($_FILES['uploadLaboratory']['error']) && $_FILES['uploadLaboratory']['error'] != 0) {
            die("File upload error: " . $_FILES['uploadLaboratory']['error']);
        }
    }

    if($purpose == "Other"){
        $stmt = $conn->prepare("INSERT INTO medcert_db (student_id, `current_date`, `current_time`, purpose, lab_result_img) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $student_id, $currentDate, $currentTime, $other_purpose, $uploadLaboratory);
    
        if ($stmt->execute()) {
            header("Location: ../homepage.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
        

    }elseif($purpose != "Other"){
        $stmt = $conn->prepare("INSERT INTO medcert_db (student_id, `current_date`, `current_time`, purpose, lab_result_img) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $student_id, $currentDate, $currentTime, $purpose, $uploadLaboratory);
    
        if ($stmt->execute()) {
            header("Location: ../homepage.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();

    }

  
} else {
    header("Location: ../homepage.php");
    exit();
}
?>
