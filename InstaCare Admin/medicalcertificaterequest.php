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
          <a href="#">Pending</a>
          <a href="medicalcertificaterequest_approved.php"> Approved </a>
          <a href="medicalcertificaterequest_rejected.php"> Rejected</a>

          <div class="underline"></div>
        </div>
        <div class="template-cards">
          <?php
          $query = "SELECT * FROM medcert_db a
                  JOIN student_db b ON a.student_id = b.student_id
                  WHERE a.medcert_status = 'Pending'";

          $result = mysqli_query($conn, $query);

          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $medical_cert_id  = $row['medical_cert_id'];
              urlencode($medical_cert_id);
              $current_date = $row['current_date'];
              $current_time = $row['current_time'];
              $student_id = $row['student_id'];
              $f_name = $row['f_name'];
              $m_name = $row['m_name'];
              $l_name = $row['l_name'];

              $purpose = $row['purpose'];
              $medcert_status = $row['medcert_status'];
              $lab_result_img = $row['lab_result_img'];

              $image_path = '../InstaCare User/php/';

              $medcert_img = $image_path . $lab_result_img;

              echo '
              
                  <div  class="template-card">
                    <div>
                      <img class="template-img" src="./asset/img/profile.png" alt="" />
                    </div>
                    <label for="student_id">' . $student_id . '</label>
                    <div class="template-card-details">
                      <label for="datecreated">Date Created:' . $current_date . '</label>
                      <label for="time">Time: ' . $current_time . '</label>
                      <label for="name">Name: ' . $f_name . ' ' . $m_name . ' ' . $l_name . '</label>
                      <label for="reason1">Reason 1:</label>
                      <label for="reason2">Reason 2:</label>
                      <label for="purpose">Purpose: </label>
                      <label for="addedby">Added by:</label>
                      <label for="laboratory">Laboratory Result: </label>
                      <img class="laboratory-img" src="' . $medcert_img . '" alt="" id="laboratory"> </label>

                      <label for="Status" id="statusLabel">Status: ' . $medcert_status . '</label>

                      <form action="php/update_reject_medcert.php?medical_cert_id=' . urlencode($medical_cert_id) . '" method="POST">

                      <textarea id="reason" name="reject_reason" style="display: none" placeholder="Reason"></textarea>
                      <button id="submitReason" style="display: none">Submit</button>

                      </form>

                      <div id="button-container">
                        <a href="php/update_medcert_data.php?medical_cert_id=' . urlencode($medical_cert_id) . '" class="approve">Approve</a>
                        <button class="reject">Reject</button>
                      </div>
                      <button id="generate" style="display: none">Generate</button>
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
  </div>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Add New Consultation Record</h2>
      <!-- Add your form or content here -->
      <form>
        <div class="form-row">
          <div>
            <label for="student_id">ID Number:</label>
            <input type="text" id="student_id" name="student_id" />
          </div>
          <div>
            <label for="datecreated">Date Created: </label>
            <input type="text" id="datecreated" name="datecreated" />
          </div>
        </div>
        <label for="course&section">Course & Section: </label>
        <input type="text" id="course&section" name="course&section" />
        <label for="illness">Illness: </label>
        <input type="text" id="illness" name="illness" />
        <label for="injury">Injury: </label>
        <input type="text" id="injury" name="injury" />
        <label for="compliant">Complaint: </label>
        <textarea id="compliant" name="compliant"></textarea>
        <label for="treatment">Treatment / Intervention</label>
        <textarea id="treatment" name="treatment"></textarea>
        <label for="checkedby">Checked by:</label>
        <input type="text" id="checkedby" name="checkedby" />
        <label for="addedby">Added by:</label>
        <input type="text" id="addedby" name="addedby" />
        <button type="confirm">Confirm</button>
      </form>
    </div>
  </div>
  <!-- Edit Record Modal -->
  <div id="editRecordModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Edit Consultation Record</h2>
      <form>
        <div class="form-row">
          <div>
            <label for="edit_student_id">ID Number:</label>
            <input type="text" id="edit_student_id" name="student_id" />
          </div>
          <div>
            <label for="edit_datecreated">Date Created: </label>
            <input type="text" id="edit_datecreated" name="datecreated" />
          </div>
        </div>
        <label for="edit_course&section">Course & Section: </label>
        <input type="text" id="edit_course&section" name="course&section" />
        <label for="edit_illness">Illness: </label>
        <input type="text" id="edit_illness" name="illness" />
        <label for="edit_injury">Injury: </label>
        <input type="text" id="edit_injury" name="injury" />
        <label for="edit_compliant">Complaint: </label>
        <textarea id="edit_compliant" name="compliant"></textarea>
        <label for="edit_treatment">Treatment / Intervention</label>
        <textarea id="edit_treatment" name="treatment"></textarea>
        <label for="edit_checkedby">Checked by:</label>
        <input type="text" id="edit_checkedby" name="checkedby" />
        <label for="edit_addedby">Added by:</label>
        <input type="text" id="edit_addedby" name="addedby" />
        <button type="confirm">Confirm</button>
      </form>
    </div>
  </div>
</body>

</html>