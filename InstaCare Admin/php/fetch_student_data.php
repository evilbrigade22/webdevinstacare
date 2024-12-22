<?php
include('../../database/database_conn.php');

if (isset($_GET['student_id'])) {
    $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);

    $query = "SELECT * FROM student_db WHERE student_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $student_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $response = array();

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $student_data = mysqli_fetch_assoc($result);

            $dob = DateTime::createFromFormat('F d, Y', $student_data['bday']);
            $current_date = new DateTime();
            $age = $current_date->diff($dob)->y;

            $response = array(
                'studentID' => $student_data['student_id'],
                'name' => $student_data['f_name'] . ' ' . $student_data['m_name'] . ' ' . $student_data['l_name'],
                'course_section' => $student_data['course'] . ' ' . $student_data['section'],
                'gender' => $student_data['gender'],
                'bday' => $student_data['bday'],
                'status' => $student_data['status'],
                'address' => $student_data['address'],
                'contact' => $student_data['contact_number'],
                'contact_person' => $student_data['contact_person'],

                'age' => $age
            );
        } else {
            $response = array('error' => 'Student not found');
        }
    } else {
        $response = array('error' => 'Error executing query: ' . mysqli_error($conn));
    }

    echo json_encode($response);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(array('error' => 'Student ID not provided'));
}
