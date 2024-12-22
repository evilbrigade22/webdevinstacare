<?php
session_start();
include('../database/database_conn.php');
$student_id = $_SESSION['student_id'];
include('php/fetch_student_data.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>HealthCare</title>
  <link rel="stylesheet" href="css/status.css" />
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="wrapper">
    <div class="nav">
      <div class="logo">
        <h4><img src="img/instacarelogo.png" alt=""></h4>
      </div>
      <div class="links">
        <a href="homepage.php">Home</a>
        <a href="status.php">Status</a>
        <a href="profile.php">Profile</a>
        <a href="php/logout_function.php" class="mainlink">Logout</a>
      </div>
    </div>

    <!-- LANDING PAGE -->

    <div class="landing">
      <h1>My Status</h1>
      <div class="top">
        <select class="all-filter">
          <option value="all">All</option>
          <option value="medicine_request">Medicine Request</option>
          <option value="medcert_request">MedCert Request</option>
          <option value="appointment">Appointment</option>
        </select>
      </div>

      <div class="filter">
        <a href="status.php">Pending</a>
        <a href="#">Approved</a>
        <a href="status_denied.php"> Denied</a>
      </div>

      <div class="status">
        <?php
        $query = "SELECT * FROM medicine_request_db a
          JOIN inventory_db b ON a.product_id = b.product_id
          WHERE a.student_id = $student_id";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            // medicine_request_db
            $medicine_request_id = $row['medicine_request_id'];
            $quantity = $row['quantity'];
            $medicine_name = $row['medicine_name'];
            $health_concern = $row['health_concern'];
            $med_status = $row['med_status'];



            switch ($med_status) {
              case 'Pending':

                break;
              case 'Approved':
                echo '<div class="status-item approved">
                <div class="status-item-title">
                  <h2>Medicine Request</h2>
                </div>
                <h3>Reference ID: ' . $medicine_request_id . '</h3>
                <div class="alls">
                  <div class="space">
                    <p>Name: ' . $f_name . ' ' . $m_name . ' ' . $l_name . '</p>
                    <p>Medicine request: ' . $medicine_name . '</p>
                  </div>
                  <div class="space">
                    <p>Quantity: ' . $quantity . '</p>
                    <p>Health concern: ' . $health_concern . '</p>
                  </div>
                </div>
                <p class="status-text approved-text">Your request has been approved.</p>
              </div>';
                break;
              case 'Rejected':

                break;
            }
          }
        }
        ?>


        <?php
        $query = "SELECT * FROM medcert_db WHERE student_id = $student_id";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $medical_cert_id = $row['medical_cert_id'];
            $purpose = $row['purpose'];
            $lab_result_img = $row['lab_result_img'];
            $medcert_status = $row['medcert_status'];
            $img_path = 'php/';
            $img_result = $img_path . $lab_result_img;

            switch ($medcert_status) {
              case 'Pending':

                break;

              case 'Approve':
                echo '
          <div class="status-item approved">
            <div class="status-item-title">
              <h2>Medical Certificate Request</h2>
            </div>
            <h3>Reference ID: ' . $medical_cert_id . '</h3>
            <div class="alls">
              <div class="space">
                <p>Name: ' . $f_name . ' ' . $m_name . ' ' . $l_name . '</p>
                <p>ID number: ' . $student_id . '</p>
              </div>
              <div class="space">
                <p>Purpose: ' . $purpose . '</p>
                <p>
                  Laboratory Result: <img style="height: 50px; width: 50px" src="' . $img_result . '" alt="" />
                </p>
              </div>
            </div>
            <p class="status-text approved-text">
              Your medical certificate request has been approved. You may now claim it in the clinic.
            </p>
          </div>';
                break;

              case 'Rejected':

                break;
            }
          }
        }
        ?>






        <?php
        $query = "SELECT * FROM appointment_db WHERE student_id = $student_id";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $appointment_id = $row['appointment_id'];
            $appointment_date = $row['appointment_date'];
            $appointment_time = $row['appoinment_time'];
            $health_concern = $row['health_concern'];
            $reason = $row['reason'];
            $appointment_status = $row['appointment_status'];



            switch ($appointment_status) {
              case 'Pending':

                break;

              case 'Approve':
                echo '
                  <div class="status-item approved">
                    <div class="status-item-title">
                      <h2>Appointment</h2>
                    </div>
                    <h3>Reference ID: ' . $appointment_id . '</h3>
                    <div class="alls">
                      <div class="space">
                        <p>Name: ' . $f_name . ' ' . $m_name . ' ' . $l_name . '</p>
                        <p>ID Number: ' . $student_id . '</p>
                      </div>
                      <div class="space">
                        <p>Date: ' . $appointment_date . '</p>
                        <p>Time: ' . $appointment_time . '</p>
                      </div>
                      <div class="space">
                        <p>Health Concern: ' . $health_concern . '</p>
                        <p>Reason: ' . $reason . '</p>
                      </div>
                    </div>
                    <p class="status-text approved-text">
                      Your appointment request has been approved.
                    </p>
                  </div>';
                break;

              case 'Rejected':

                break;
            }
          }
        }

        ?>




      </div>
    </div>
  </div>
</body>

</html>