<?php
session_start();
include ('../../database/database_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['nurse_id'])) {
        die("Error: No nurse ID found in session.");
    }

    $nurse_id = $_SESSION['nurse_id'];
    $medicine_name = $_POST['medicineName'];
    $dosage = $_POST['dosage'];
    $stock_in = $_POST['stockIn'];
    
    
   
    $medicineImage = '';

    if (isset($_FILES['medicineImage']) && $_FILES['medicineImage']['error'] == 0) {
        $upload_dir = 'medicine_img/';
        if (!is_dir($upload_dir) && !mkdir($upload_dir, 0777, true)) {
            die("Failed to create upload directory.");
        }

        $file_name = basename($_FILES['medicineImage']['name']);
        $unique_file_name = uniqid() . '-' . $file_name;
        $medicineImage = $upload_dir . $unique_file_name;

        if (move_uploaded_file($_FILES['medicineImage']['tmp_name'], $medicineImage)) {
            echo "File uploaded successfully: " . $medicineImage;
        } else {
            die("Failed to upload image.");
        }
    } else {
        if (isset($_FILES['medicineImage']['error']) && $_FILES['medicineImage']['error'] != 0) {
            die("File upload error: " . $_FILES['medicineImage']['error']);
        }
    }

        $stmt = $conn->prepare("INSERT INTO inventory_db (nurse_id, medicine_name, dosage, stock_in, medicine_img) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $nurse_id, $medicine_name, $dosage, $stock_in, $medicineImage);
    
        if ($stmt->execute()) {
            header("Location: ../inventory.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
        

  
} else {
    header("Location: ../inventory.php");
    exit();
}
?>
