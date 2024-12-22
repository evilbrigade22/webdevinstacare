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
  <title>Accident Report</title>
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
          <p>Accident Report</p>
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
          <button id="addRecordBtn">ADD RECORD</button>
          <input type="text" id="searchInput" placeholder="Search by name or ID" oninput="filterItems()" />

          <input type="date" id="startDate" onchange="filterItems()" /> TO
          &nbsp;
          <input type="date" id="endDate" onchange="filterItems()" />
          <button class="spreadsheet">Manage Spreadsheet</button>
        </div>
        <div class="template-cards">

          <?php
          $query = "SELECT * FROM accident_report_db a
                    JOIN nurse_db b ON a.nurse_id = b.nurse_id
                    JOIN student_db c ON a.student_id = c.student_id";

          $result = mysqli_query($conn, $query);

          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $student_id = $row['student_id'];
              $f_name = $row['f_name'];
              $m_name = $row['m_name'];
              $l_name = $row['l_name'];
              $course = $row['course'];
              $section = $row['section'];
              $date_created = $row['date_created'];
              $time_created = $row['time_created'];
              $address = $row['address'];
              $contact_number = $row['contact_number'];
              $contact_person = $row['contact_person'];
              $chief_complaint = $row['chief_complaint'];
              $treatment_intervention = $row['treatment_intervention'];
              $nurse_f_name = $row['nurse_f_name'];
              $nurse_l_name = $row['nurse_l_name'];

              echo '
                    <div class="template-card">
                      <div>
                        <img class="template-img" src="./asset/img/profile.png" alt="" />
                      </div>
                      <label for="student_id"> ' . $student_id . '</label>
                      <div class="template-card-details">
                        <label for="name">Name: ' . $f_name . ' ' . $m_name . ' ' . $l_name . ' </label>
                        <label for="course&section">Course & Section: ' . $course . ' ' . $section . '</label>
                        <label for="datecreated">Date Created: ' . $date_created . ' </label>
                        <label for="illness">Time: ' . $time_created . '</label>
                        <label for="address">Address : ' . $address . ' </label>
                        <label for="contanctnumber">Contact Number : ' . $contact_number . ' </label>
                        <label for="contactperson">Contact Person : ' . $contact_person . ' </label>
                        <label for="compliant">Chief Complaint: ' . $chief_complaint . ' </label>
                        <label for="treatment">Treatment / Intervention: ' . $treatment_intervention . ' </label>
                        <label for="addedby">Added by: ' . $nurse_f_name . ' ' . $nurse_l_name . '</label>
                        <div>
                          <button class="editBtn">Edit</button>
                          <button class="generate">Generate</button>
                        </div>
                      </div>
                    </div>
              ';
            }
          }
          ?>

          <div class="template-card">
            <div>
              <img class="template-img" src="./asset/img/profile.png" alt="" />
            </div>
            <label for="student_id">2021-170253</label>
            <div class="template-card-details">
              <label for="name">Name: Allisa Joy E Yutuc</label>
              <label for="course&section">Course & Section: BSIT INF211</label>
              <label for="datecreated">Date Created: </label>
              <label for="illness">Time: </label>
              <label for="address">Address : </label>
              <label for="contanctnumber">Contact Number : </label>
              <label for="contactperson">Contact Person : </label>
              <label for="compliant">Chief Complaint: </label>
              <label for="treatment">Treatment / Intervention: </label>
              <label for="addedby">Added by:</label>
              <div>
                <button class="editBtn">Edit</button>
                <button class="generate">Generate</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div id="myModal" class="modal">

    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Add New Accident Report</h2>
      <h5>May 30 2023</h5>
      <!-- Add your form or content here -->
      <form action="php/insert_accident_data.php" method="POST">
        <div class="form-row">
          <div>
            <label for="student_id">ID Number:</label>
            <input type="text" id="student_id" name="student_id" />
          </div>
          <div>
            <label for="name">Name: </label>
            <input type="text" id="full_name" name="name" style="cursor:not-allowed;" readonly />
          </div>
        </div>
        <div class="form-row">
          <div>
            <label for="time">Time: </label>
            <input type="text" name="" id="current_time" name="current_time" />
          </div>
          <div>
            <label for="course&section">Course & Section: </label>
            <input type="text" id="course&section" name="course&section" />
          </div>
        </div>
        <div class="form-row">
          <div>
            <label for="contactperson">Contact Person : </label>
            <input type="text" name="contactperson" id="contactperson" style="cursor:not-allowed;" readonly />
          </div>
          <div>
            <label for="contactperson">Contact Number : </label>
            <input type="text" id="contactnumber" name="contactnumber" style="cursor:not-allowed;" readonly style="cursor:not-allowed;" readonly />
          </div>
        </div>
        <label for="address"> Address</label>
        <textarea id="address" name="address" style="cursor:not-allowed;" readonly></textarea>

        <div class="line"></div>

        <label for="compliant">Complaint: </label>
        <textarea id="compliant" name="compliant"></textarea>

        <label for="treatment">Treatment / Intervention</label>
        <textarea id="treatment" name="treatment"></textarea>

        <div class="form-row">
          <div>
            <label for="addedby">Added by: <?php echo $n_f_name . ' ' . $n_l_name ?></label>
          </div>
          <div>
            <button type="confirm">Confirm</button>
          </div>
        </div>
      </form>
    </div>

  </div>
  <div id="editRecordModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Edit Accident Report</h2>
      <h5>May 30 2023</h5>
      <!-- Add your form or content here -->
      <form>
        <div class="form-row">
          <div>
            <label for="edit_student_id">ID Number:</label>
            <input type="text" id="edit_student_id" name="edit_student_id" />
          </div>
          <div>
            <label for="name">Name : </label>
            <input type="text" name="edit_name" id="edit_name" />
          </div>
        </div>
        <div class="form-row">
          <div>
            <label for="edit_time">Time: </label>
            <input type="text" id="edit_time" name="edit_time" />
          </div>
          <div>
            <label for="edit_course&section">Course & Section: </label>
            <input type="text" id="edit_course&section" name="edit_course&section" />
          </div>
        </div>
        <div class="form-row">
          <div>
            <label for="contactperson">Contact Person : </label>
            <input type="text">
          </div>
          <div>
            <label for="contactperson">Contact Number : </label>
            <input type="text">
          </div>
        </div>
        <label for="address"> Address</label>
        <input type="text">

        <div class="line"></div>

        <label for="edit_compliant">Complaint: </label>
        <textarea id="edit_compliant" name="edit_compliant"></textarea>

        <label for="edit_treatment">Treatment / Intervention</label>
        <textarea id="edit_treatment" name="edit_treatment"></textarea>

        <label for="edit_addedby">Added by: Nurse 1</label>

        <button type="confirm">Confirm</button>
      </form>
    </div>
  </div>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    function updateTime() {
      var currentTimeInput = document.getElementById('current_time');
      var now = new Date();
      var hours = now.getHours();
      var minutes = now.getMinutes();
      var ampm = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12;
      hours = hours ? hours : 12; // the hour '0' should be '12'
      minutes = minutes < 10 ? '0' + minutes : minutes;
      var formattedTime = hours + ':' + minutes + ampm;
      currentTimeInput.value = formattedTime;
    }

    updateTime();
    setInterval(updateTime, 1000); // Update time every second

    var studentIDInput = document.getElementById('student_id');

    studentIDInput.addEventListener('input', function() {
      var studentID = studentIDInput.value;
      console.log(studentID);

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'php/fetch_student_data.php?student_id=' + encodeURIComponent(studentID), true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            try {
              var responseData = JSON.parse(xhr.responseText);

              if (responseData !== null) {
                document.getElementById('full_name').value = responseData.name || "";
                document.getElementById('course&section').value = responseData.course_section || "";
                document.getElementById('address').value = responseData.address || "";
                document.getElementById('contactnumber').value = responseData.contact || "";
                document.getElementById('contactperson').value = responseData.contact_person || "";

              } else {
                document.getElementById('full_name').value = "";
                document.getElementById('course&section').value = "";
                document.getElementById('address').value = "";
                document.getElementById('contactnumber').value = "";
                document.getElementById('contactperson').value = "";

              }
            } catch (e) {
              console.error('Error parsing JSON response: ', e);
              document.getElementById('full_name').value = "";
              document.getElementById('course&section').value = "";
              document.getElementById('address').value = "";
              document.getElementById('contactnumber').value = "";
              document.getElementById('contactperson').value = "";

            }
          } else {
            console.error('Request failed with status: ', xhr.status);
            document.getElementById('full_name').value = "";
            document.getElementById('course&section').value = "";
            document.getElementById('address').value = "";
            document.getElementById('contactnumber').value = "";
            document.getElementById('contactperson').value = "";

          }
        }
      };
      xhr.send();
    });
  });
</script>

</html>