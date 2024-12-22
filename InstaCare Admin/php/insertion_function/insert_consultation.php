<?php
session_start();
include ("../../../database/database_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nurse_id = $_SESSION['nurse_id'];
    $student_id = $_POST['student_id'];

    $check_id = $conn->prepare("SELECT student_id FROM student_db WHERE student_id = ?");
    $check_id->bind_param("s", $student_id);
    $check_id->execute();
    $check_id->store_result();

    if($check_id->num_rows == 0){
        $_SESSION['error_message'] = "No Student Found";
        header("Location: ../../consultation.php?modal=open");
        exit(); 
    }

    $check_id->close(); 

    $illness = !empty($_POST['illness']) ? $_POST['illness'] : "None";
    $injury = !empty($_POST['injury']) ? $_POST['injury'] : "None";
    $compliant = $_POST['compliant'];
    $treatment = $_POST['treatment'];
    $date_submited = date('F j, Y');

    $stmt = $conn->prepare("INSERT INTO consultation_records_db (student_id, nurse_id, date_submited, illness, injury, chief_complaint, treatment_intervention) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $student_id, $nurse_id, $date_submited, $illness, $injury, $compliant, $treatment);

    if ($stmt->execute()) {
        header("Location: ../../consultation.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
