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
  <title>Medical Record</title>
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
          <p>Medical Record</p>
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
          $query = "SELECT *
                        FROM medical_records_db a
                        JOIN nurse_db b ON a.nurse_id = b.nurse_id
                        JOIN student_db c ON  a.student_id = c.student_id;";

          $result = mysqli_query($conn, $query);

          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $student_id = $row['student_id'];
              $f_name = $row['f_name'];
              $m_name = $row['m_name'];
              $l_name = $row['l_name'];
              $course = $row['course'];
              $section = $row['section'];

              $dob = DateTime::createFromFormat('F d, Y', $row['bday']);
              $current_date = new DateTime();
              $age = $current_date->diff($dob)->y;

              $date_submited = $row['date_submited'];
              $address = $row['address'];
              $contact_number = $row['contact_number'];
              $contact_person = $row['contact_person'];
              $nurse_f_name = $row['nurse_f_name'];
              $nurse_l_name = $row['nurse_l_name'];

              echo '
                      <div class="template-card">
                      <div>
                        <img
                          class="template-img"
                          src="./asset/img/profile.png"
                          alt=""
                        />
                      </div>
                      <label for="student_id">' . $student_id . '</label>
                      <div class="template-card-details">
                        <label for="name">Name: ' . $f_name . ' ' . $m_name . ' ' . $l_name . '</label>
                        <label for="course&section"
                          >Course & Section: ' . $course . ' ' . $section . '</label
                        >
        
                        <label for="datecreated">Date Created: ' . $date_submited . ' </label>
                        <label for="age">Age: ' . $age . '</label>
                        <label for="address">Address: ' . $address . ' </label>
        
                        <label for="contactperson">Contact Person: ' . $contact_person . ' </label>
                        <label for="contactnumber">Contact Number: ' . $contact_number . '</label>
        
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


        </div>
      </div>
    </div>
  </div>
  <!-- Add record modal -->

  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Add New Medical Record</h2>
      <h5 id="current_date"></h5>
      <form action="php/insertion_function/insert_medicalrecord.php" method="POST">
        <div class="form-row">
          <div>
            <label for="student_id">ID Number :</label>
            <input type="text" id="student_id" name="student_id" />
          </div>
          <div>
            <label for="name">Name : </label>
            <input type="text" id="full_name" name="name" style="cursor:not-allowed;" readonly />
          </div>
        </div>
        <div class="form-row">
          <div>
            <label for="course&section">Course & Section : </label>
            <input type="text" id="course&section" name="course&section" style="cursor:not-allowed;" readonly />
          </div>
          <div>
            <label for="age">Age : </label>
            <input type="text" id="age" name="age" style="cursor:not-allowed;" readonly />
          </div>
        </div>
        <label for="address">Address: </label>
        <textarea id="address" name="address" style="cursor:not-allowed;" readonly></textarea>
        <div class="line"></div>
        <div class="form-row">
          <div>
            <label for="contactperson">Contact Person: </label>
            <input type="text" name="contactperson" id="contactperson" style="cursor:not-allowed;" readonly />
          </div>
          <div>
            <label for="contactnumber">Contact Number: </label>
            <input type="text" id="contactnumber" name="contactnumber" style="cursor:not-allowed;" readonly style="cursor:not-allowed;" readonly />
          </div>
        </div>
        <!-- display error here for modal in add record -->
        <p style="color: red; font-weight: 700;"><?php
                                                  if (isset($_SESSION['error_message'])) {
                                                    echo $_SESSION['error_message'];
                                                    unset($_SESSION['error_message']);
                                                  }
                                                  ?> </p>
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
  <!-- Edit Record Modal -->
  <div id="editRecordModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Edit Medical Record</h2>
      <h5>May 30 2024</h5>
      <form>
        <div class="form-row">
          <div>
            <label for="edit_student_id">ID Number:</label>
            <input type="text" id="edit_student_id" name="student_id" />
          </div>
          <div>
            <label for="edit_datecreated">Name:</label>
            <input type="text" id="edit_datecreated" name="datecreated" />
          </div>
        </div>
        <div class="form-row">
          <div>
            <label for="edit_course&section">Course & Section:</label>
            <input type="text" id="edit_course&section" name="course&section" />
          </div>
          <div>
            <label for="edit_age">Age:</label>
            <input type="text" id="edit_age" name="age" />
          </div>
        </div>
        <label for="edit_address">Address:</label>
        <textarea id="edit_address" name="address"></textarea>
        <div class="line"></div>
        <div class="form-row">
          <div>
            <label for="edit_contactperson">Contact Person:</label>
            <input type="text" id="edit_contactperson" name="contactperson" />
          </div>
          <div>
            <label for="edit_contactnumber">Contact Number:</label>
            <input type="text" id="edit_contactnumber" name="contactnumber" />
          </div>
        </div>
        <div class="form-row">
          <div>
            <label for="edit_addedby">Added by: Nateman</label>
          </div>
          <div>
            <button type="confirm">Confirm</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

<script>
  document.addEventListener('DOMContentLoaded', function() {
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
                document.getElementById('age').value = responseData.age || "";
                document.getElementById('address').value = responseData.address || "";
                document.getElementById('contactnumber').value = responseData.contact || "";
                document.getElementById('contactperson').value = responseData.contact_person || "";


              } else {
                document.getElementById('full_name').value = "";
                document.getElementById('course&section').value = "";
                document.getElementById('age').value = "";
                document.getElementById('gender').value = "";
                document.getElementById('status').value = "";
                document.getElementById('address').value = "";
                document.getElementById('contactnumber').value = "";
                document.getElementById('contactperson').value = "";

              }
            } catch (e) {
              console.error('Error parsing JSON response: ', e);
              document.getElementById('full_name').value = "";
              document.getElementById('course&section').value = "";
              document.getElementById('age').value = "";
              document.getElementById('gender').value = "";
              document.getElementById('status').value = "";
              document.getElementById('address').value = "";
              document.getElementById('contactnumber').value = "";
              document.getElementById('contactperson').value = "";

            }
          } else {
            console.error('Request failed with status: ', xhr.status);
            document.getElementById('full_name').value = "";
            document.getElementById('course&section').value = "";
            document.getElementById('age').value = "";
            document.getElementById('gender').value = "";
            document.getElementById('status').value = "";
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
<!-- Script for Current Date -->
<script>
  var currentDate = new Date();

  var current_date = document.getElementById("current_date");

  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

  var month = months[currentDate.getMonth()];
  var day = currentDate.getDate();
  var year = currentDate.getFullYear();

  current_date.textContent = month + " " + day + ", " + year;
</script>

</html>