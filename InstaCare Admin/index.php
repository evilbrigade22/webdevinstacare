<?php
session_start();

$nurse_id = $_SESSION['nurse_id'];

include('../database/database_conn.php');
include('php/fetch_nurse_info.php');

//count consultation pending
date_default_timezone_set('Asia/Manila');

$current_date = date('F j, Y');
$query_count_consultation = "SELECT COUNT(*) AS count FROM consultation_records_db WHERE date_submited = '$current_date'";
$result_count_consultation = mysqli_query($conn, $query_count_consultation);
$row_count_consultation = mysqli_fetch_assoc($result_count_consultation);
$consultation_count = $row_count_consultation['count'];

//count appointment pending
$query_count_appointment = "SELECT COUNT(*) AS count FROM appointment_db WHERE appointment_status = 'Pending'";
$result_count_appointment = mysqli_query($conn, $query_count_appointment);
$row_count_appointment = mysqli_fetch_assoc($result_count_appointment);
$appointment_count = $row_count_appointment['count'];

//count med req pending
$query_count_medreq = "SELECT COUNT(*) AS count FROM medicine_request_db WHERE med_status = 'Pending'";
$result_count_medreq = mysqli_query($conn, $query_count_medreq);
$row_count_medreq = mysqli_fetch_assoc($result_count_medreq);
$medreq_count = $row_count_medreq['count'];

//count med cert pending
$query_count_medcert = "SELECT COUNT(*) AS count FROM medcert_db WHERE medcert_status = 'Pending'";
$result_count_medcert = mysqli_query($conn, $query_count_medcert);
$row_count_medcert = mysqli_fetch_assoc($result_count_medcert);
$medcert_count = $row_count_medcert['count'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="./asset/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <script src="script.js"></script>
</head>

<body>
  <!-- container start -->
  <div class="container">
    <!-- sidebar start  -->
    <div class="sidebar">
      <?php include('php/sidenav.php') ?>
    </div>


    <!-- sidebar end  -->
    <!-- main start -->

    <div class="main">
      <!-- top-bar start  -->
      <div class="top-bar">
        <div class="top-bar-title">
          <p>Dashboard</p>
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
      <div class="filter-container">
        <label for="filter-select">Filter&nbsp;&nbsp;</label>
        <select id="filter-select" onchange="updateFilter()">
          <option value="daily">Daily</option>
          <option value="weekly">Weekly</option>
          <option value="monthly">Monthly</option>
        </select>
      </div>

      <!-- top-bar end  -->
      <!-- card start  -->

      <div style="margin-top: 0" class="cards">
        <div class="card">
          <div class="card-content">
            <div class="number"><?php
                                if ($consultation_count == 0) {
                                  echo '0';
                                } else {
                                  echo $consultation_count;
                                }
                                ?></div>
            <div class="card-name">Consultation Visits</div>
          </div>
          <div class="icon-box">
            <i class="fas fa-wheelchair"></i>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="number"><?php
                                if ($appointment_count == 0) {
                                  echo '0';
                                } else {
                                  echo $appointment_count;
                                }
                                ?>
            </div>
            <div class="card-name">Appoinment Request</div>
          </div>
          <div class="icon-box">
            <i class="fas fa-briefcase-medical"></i>
          </div>
        </div>

        <div class="card">
          <div class="card-content">
            <div class="number"><?php
                                if ($medreq_count == 0) {
                                  echo '0';
                                } else {
                                  echo $medreq_count;
                                }
                                ?></div>
            <div class="card-name">Medicine Request</div>
          </div>
          <div class="icon-box">
            <i class="fa-solid fa-capsules"></i>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="number"><?php
                                if ($medcert_count == 0) {
                                  echo '0';
                                } else {
                                  echo $medcert_count;
                                } ?>

            </div>

            <div class="card-name">Medical Certificate Request</div>
          </div>
          <div class="icon-box">
            <i class="fa-solid fa-file-prescription"></i>
          </div>
        </div>
      </div>
      <!-- cards end  -->
      <!-- table start  -->

      <div class="tables">
        <!-- last appoinments start  -->
        <div class="last-appoinments">
          <div class="heading">
            <h2>Appointment Request</h2>
            <a href="appointment.php" class="btn-action">View All</a>
          </div>
          <div class="table-container">
            <table class="appoinments">
              <thead>
                <td>Name</td>
                <td>Appointment Date</td>
                <td>Health Concern</td>
              </thead>
              <tbody>

                <?php
                $query = "SELECT * FROM appointment_db a
                        JOIN student_db b ON a.student_id = b.student_id
                        WHERE a.appointment_status = 'Pending'";

                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $f_name = $row['f_name'];
                    $m_name = $row['m_name'];
                    $l_name = $row['l_name'];
                    $appointment_date = $row['appointment_date'];
                    $health_concern = $row['health_concern'];

                    echo '
                          <tr>
                            <td>' . $f_name . ' ' . $m_name . ' ' . $l_name . '</td>
                            <td>' . $appointment_date . '</td>
                            <td>' . $health_concern . '</td>
                          </tr>
                    ';
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- end appointment request -->
        <!-- Start Medicine Request -->
        <div class="last-appoinments">
          <div class="heading">
            <h2>Medicine Request</h2>
            <a href="medicinerequest.html" class="btn-action">View All</a>
          </div>

          <div class="table-container">
            <table class="appoinments">
              <thead>
                <td>Name</td>
                <td>Medicine</td>
                <td>Quantity</td>
                <td>Health Conern</td>
              </thead>
              <tbody>

                <?php
                $query = "SELECT * FROM medicine_request_db a
                        JOIN student_db b ON a.student_id = b.student_id
                        JOIN inventory_db c ON a.product_id = c.product_id
                        WHERE med_status = 'Pending'";

                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $f_name = $row['f_name'];
                    $m_name = $row['m_name'];
                    $l_name = $row['l_name'];
                    $medicine_name = $row['medicine_name'];
                    $quantity = $row['quantity'];
                    $health_concern = $row['health_concern'];

                    echo '
                          <tr>
                            <td>' . $f_name . ' ' . $m_name . ' ' . $l_name . '</td>
                            <td>' . $medicine_name . '</td>
                            <td>' . $quantity . '</td>
                            <td>' . $health_concern . '</td>

                          </tr>
                    ';
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- start medical certificate request -->
        <div class="last-appoinments">
          <div class="heading">
            <h2>Medical Certificate Request</h2>
            <a href="medicalcertificaterequest.php
              " class="btn-action">View All</a>
          </div>
          <div class="table-container">
            <table class="appoinments">
              <thead>
                <td>Name</td>
                <td>Purpose</td>
                <td>Date Requested</td>
              </thead>
              <tbody>

                <?php
                $query = "SELECT * FROM medcert_db a
                        JOIN student_db b ON a.student_id = b.student_id
                        WHERE a.medcert_status = 'Pending'";

                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $f_name = $row['f_name'];
                    $m_name = $row['m_name'];
                    $l_name = $row['l_name'];
                    $purpose = $row['purpose'];
                    $current_date = $row['current_date'];

                    echo '
                          <tr>
                            <td>' . $f_name . ' ' . $m_name . ' ' . $l_name . '</td>
                            <td>' . $purpose . '</td>
                            <td>' . $current_date . '</td>
                          </tr>
                    ';
                  }
                }
                ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- end medical certificate request -->





      <!-- last Appointments end  -->
      <!-- doctor visit start  -->

      <!-- doctor visit end  -->
    </div>

    <!-- table end -->
  </div>
  <!-- main end-->
  </div>
  <!-- container end -->
</body>

</html>