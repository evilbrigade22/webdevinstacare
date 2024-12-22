<?php
session_start();

$nurse_id = $_SESSION['nurse_id'];

include('../database/database_conn.php');
include('php/fetch_nurse_info.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Medical Certificate Request</title>
    <link rel="stylesheet" href="./asset/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <?php include('php/sidenav.php') ?>
        </div>

        <div class="main">
            <div class="top-bar">
                <div class="top-bar-title">
                    <p>Medical Certificate Request</p>
                </div>
                <a href="profile.php" class="user">
                    <div>
                        <img src="./asset/img/doctor-icon.png" alt="" />
                    </div>
                    <div class="user-shortcut">
                        <p><?php echo $n_f_name . ' ' . $n_m_name . ' ' . $n_l_name ?></p>
                        <p>Admin</p>
                    </div>
                </a>
            </div>
            <div class="template-content">
                <div class="template-header">
                    <input type="text" id="searchInput" placeholder="Search by name or ID" oninput="filterItems()" />
                    <input type="date" id="startDate" onchange="filterItems()" /> TO
                    &nbsp;
                    <input type="date" id="endDate" onchange="filterItems()" />
                    <button class="spreadsheet">Manage Spreadsheet</button>
                </div>
                <div class="template-header-second">
                    <a href="medicalcertificaterequest.php">Pending</a>
                    <a href="#"> Approved </a>
                    <a href="medicalcertificaterequest_rejected.php"> Rejected</a>
                    <div class="underline"></div>
                </div>
                <div class="template-cards">
                    <?php
                    $query = "SELECT * FROM medcert_db a
                            JOIN student_db b ON a.student_id = b.student_id
                            JOIN nurse_db c ON a.nurse_id = c.nurse_id
                            WHERE a.medcert_status = 'Approve'";
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $medical_cert_id = urlencode($row['medical_cert_id']);
                            $current_date = $row['current_date'];
                            $current_time = $row['current_time'];
                            $student_id = $row['student_id'];
                            $f_name = $row['f_name'];
                            $m_name = $row['m_name'];
                            $l_name = $row['l_name'];
                            $nurse_f_name = $row['nurse_f_name'];
                            $nurse_l_name = $row['nurse_l_name'];
                            $purpose = $row['purpose'];
                            $medcert_status = $row['medcert_status'];
                            $lab_result_img = $row['lab_result_img'];

                            $image_path = '../InstaCare User/php/';
                            $medcert_img = $image_path . $lab_result_img;

                            echo '
                                <div class="template-card">
                                    <div>
                                        <img class="template-img" src="./asset/img/profile.png" alt="" />
                                    </div>
                                    <label for="student_id">Student ID: ' . $student_id . '</label>
                                    <div class="template-card-details">
                                        <label for="datecreated">Date Created: ' . $current_date . '</label>
                                        <label for="time">Time: ' . $current_time . '</label>
                                        <label for="name">Name: ' . $f_name . ' ' . $m_name . ' ' . $l_name . '</label>
                                        <label for="reason1">Reason 1:</label>
                                        <label for="reason2">Reason 2:</label>
                                        <label for="purpose">Purpose: ' . $purpose . '</label>
                                        <label for="addedby">Added by: ' . $nurse_f_name . ' ' . $nurse_l_name . '</label>
                                        <label for="laboratory">Laboratory Result:</label>
                                        <img class="laboratory-img" src="' . $medcert_img . '" alt="Laboratory Result" id="laboratory">
                                        <label for="Status" id="statusLabel">Status: ' . $medcert_status . '</label>
                                        <a href="printable.php?medical_cert_id=' . urlencode($medical_cert_id) . '" class="generate" target="_blank">Generate</a>
                                    </div>
                                </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>



</body>

</html>