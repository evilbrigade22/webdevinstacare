<?php
session_start();
include ("../../../database/database_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nurse_id = $_SESSION['nurse_id'];
    $student_id = $_POST['student_id'];
    $date_submited = date('F j, Y');


    $check_id = $conn->prepare("SELECT student_id FROM student_db WHERE student_id = ?");
    $check_id->bind_param("s", $student_id);
    $check_id->execute();
    $check_id->store_result();

    if($check_id->num_rows == 0){
        $_SESSION['error_message'] = "No Student Found";
        header("Location: ../../dentalrecord.php?modal=open");
        exit(); 
    }

    $check_id->close();


    $stmt = $conn->prepare("INSERT INTO dental_records_db (student_id, nurse_id, date_submited) 
                            VALUES (?, ?, ?)");
    $stmt->bind_param("si", $student_id, $nurse_id, $date_submited);

    if ($stmt->execute()) {
        header("Location: ../../dentalrecord.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
