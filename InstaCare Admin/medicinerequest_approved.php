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
    <title>Medicine Request</title>
    <link rel="stylesheet" href="./asset/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <?php include('php/sidenav.php') ?>
        </div>


        <div class="main">
            <div class="top-bar">
                <div class="top-bar-title">
                    <p>Medicine Request</p>
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
                    <a href="medicinerequest.php"> Pending</a>
                    <a href="#"> Approved</a>
                    <a href="medicinerequest_rejected.php">Rejected</a>
                    <div class="underline"></div>
                </div>
                <div class="template-cards">
                    <?php
                    $query = "SELECT a.*, b.*, c.*
                    FROM medicine_request_db AS a
                    JOIN student_db AS b ON a.student_id = b.student_id
                    JOIN inventory_db AS c ON a.product_id = c.product_id
                    WHERE a.med_status ='Approved'";


                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $medicine_request_id = $row['medicine_request_id'];
                            urlencode($medicine_request_id);
                            $student_id = $row['student_id'];
                            $product_id = $row['product_id'];
                            $status = $row['med_status'];
                            $date_requested = $row['date_requested'];
                            $time_requested = $row['time_requested'];
                            $f_name = $row['f_name'];
                            $m_name = $row['m_name'];
                            $l_name = $row['l_name'];
                            $medicine_name = $row['medicine_name'];
                            $quantity = $row['quantity'];
                            $health_concern = $row['health_concern'];




                            echo ' 
                      <div class="template-card">
                          <div>
                            <img class="template-img" src="./asset/img/profile.png" alt="" />
                          </div>
                          <label for="student_id">' . $student_id . '</label>
                          <div class="template-card-details">
                            <label for="datecreated">Date Created:' . $date_requested . ' </label>
                            <label for="time">Time: ' . $time_requested . '</label>
                            <label for="name">Name: ' . $f_name . ' ' . $m_name . ' ' . $l_name . '</label>
                            <label for="request"> Request: ' . $medicine_name . '</label>
                            <label for="quantity">Quantity: ' . $quantity . '</label>
                            <label for="healtconcern">Health Concern: ' . $health_concern . '</label>
                            <label for="addedby">Added by:</label>
                            <label for="Status" id="statusLabel">Status: ' . $status . '</label>
                         
                          </div>
                        </div>
              
              ';
                        }
                    }
                    ?>




                </div>
            </div>
        </div>
    </div>
</body>

</html>