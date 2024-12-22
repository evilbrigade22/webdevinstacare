<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('../../database/database_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $licenceNo = $_POST['licenceNo'];
    $contacts = $_POST['contacts'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $errors = [];

    // Check if username already exists
    $check_stmt = $conn->prepare("SELECT nurse_id FROM nurse_db WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $errors[] = "Error: Username already exists.";
    }
    $check_stmt->close();

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO nurse_db (username, password, nurse_f_name, nurse_m_name, nurse_l_name, contact, license_number) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $password, $f_name, $m_name, $l_name, $contacts, $licenceNo);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Registration successful.";
            $stmt->close();
            $conn->close();
            header("Location: ../admin.php?modal=open");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../admin.php?modal=open&error=true");
        exit();
    }

    $conn->close();
}
