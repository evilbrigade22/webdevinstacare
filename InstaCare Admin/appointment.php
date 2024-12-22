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
  <title>Appointment</title>
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
          <p>Appointment</p>
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

          <input type="date" id="startDate" onchange="filterItems()" />
          &nbsp;
          <input type="date" id="endDate" onchange="filterItems()" />
          <button class="spreadsheet">Manage Spreadsheet</button>
        </div>
        <div class="template-header-second">
          <a href="#"><label for="pending">Pending</label></a>
          <a href="appointment_approved.php">Approved</a>
          <a href="appointment_rejected.php"><label id="denied-label" for="Rejected">Rejected</label></a>
          <div class="underline"></div>
        </div>
        <div class="template-cards">

          <!-- start of card content here -->
          <?php
          $query = "SELECT * FROM appointment_db a 
          JOIN student_db b ON a.student_id = b.student_id
          WHERE a.appointment_status = 'Pending'";

          $result = mysqli_query($conn, $query);

          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $appointment_id = urlencode($row['appointment_id']);
              $f_name = htmlspecialchars($row['f_name']);
              $m_name = htmlspecialchars($row['m_name']);
              $l_name = htmlspecialchars($row['l_name']);
              $appointment_date = htmlspecialchars($row['appointment_date']);
              $appointment_time = htmlspecialchars($row['appoinment_time']);
              $health_concern = htmlspecialchars($row['health_concern']);
              $reason = htmlspecialchars($row['reason']);
              $status = htmlspecialchars($row['appointment_status']);

              echo '
            <div class="template-card">
                <div>
                    <img class="template-img" src="./asset/img/profile.png" alt="" />
                </div>
                <label for="student_id">2021-170253</label>
                <div class="template-card-details">
                    <label for="name">Name: ' . $f_name . ' ' . $m_name . ' ' . $l_name . '</label>
                    <label for="appointment_date">Appointment Date: ' . $appointment_date . ' </label>
                    <label for="appointment_time">Appointment Time: ' . $appointment_time . ' </label>
                    <label for="healthconcern">Health Concern: ' . $health_concern . '</label>
                    <label for="reason">Reason: ' . $reason . '</label>
                   <label for="addedby">Check by:</label>
                    <label for="Status" id="statusLabel">Status: ' . $status . '</label>

                    <form action="php/update_reject_appointment.php?appointment_id=' . $appointment_id . '" method="POST">
                        <textarea id="reason" style="display: none" name="reject_reason" placeholder="Reason"></textarea>
                        <button id="submitReason" style="display: none">Submit</button>
                    </form>
                    
                    <div id="button-container">
                        <a href="php/update_appointment_data.php?appointment_id=' . $appointment_id . '" class="approve">Approve</a>
                        <button class="reject">Reject</button>
                    </div>
                </div>
            </div>
        ';
            }
          }
          ?>



          <!-- end of card content here -->

        </div>
      </div>
    </div>
  </div>

  </div>
</body>

</html>