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
  <style>
    body {
      background-image: url('../img/blue.jpg');
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      /* Add other styles as needed */
    }
  </style>
  <link rel="stylesheet" href="css/profile.css" />

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
      <h1>My Profile</h1>

      <div class="box">
        <h2>Personal Information</h2>
        <div class="down">
          <div class="profiles">
            <img src="https://cdn-icons-png.flaticon.com/512/168/168719.png" alt="" />
            &nbsp; <?php echo "$student_id" ?>
          </div>
          <div class="name">
            <div class="upper">
              <label for="name">Name: </label>

              <label for="gender">Gender:</label>
              <label for="address">Address:</label>
            </div>
            <div class="lower">
              <span> <?php echo "$f_name $m_name $l_name"; ?></span>
              <span><?php echo "$gender"; ?></span>
              <p> <?php echo "$address" ?></p>
            </div>
          </div>
          <div class="names">
            <div class="uppers">
              <label for="course">Course:</label>
              <label for="status">Status:</label>
            </div>
            <div class="lowers">
              <span> <?php echo "$course"; ?></span>
              <span><?php echo "$status"; ?></span>
            </div>
          </div>
          <div class="namess">
            <div class="upperss">
              <label for="section">Section:</label>
              <label for="Date">Date of Birth:</label>
            </div>
            <div class="lowerss">
              <span><?php echo "$section"; ?></span>
              <span><?php echo "$bday"; ?></span>
            </div>
          </div>
        </div>
        <div class="prof-right">
          <button class="follow" onclick="openModal()">
            <i class="fa-solid fa-pen-to-square"></i>Edit Profile
          </button>
        </div>
      </div>
      <div class="boxs">
        <h2>Contact Information</h2>
        <div class="down">
          <div class="name">
            <div class="upper">
              <label for="name">Contact Number:</label>
            </div>
            <div class="lower">
              <p><?php echo "$contact_number"; ?></p>
            </div>
          </div>
          <div class="name">
            <div class="upper">
              <label for="name">Contact Number:</label>
            </div>
            <div class="lower">
              <p><?php echo "$contact_person"; ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="boxss">
        <button class="follow">
          <i class="fa-solid fa-pen-to-square"></i>Delete
        </button>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="editProfileModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Profile</h2>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-container">
            <h4>Personal Information</h4>
            <div class="form-groups">
              <label for="id-number">ID Number:</label>
              <input type="text" id="id-number" />
            </div>
            <div class="form-groups">
              <label for="first-name">First Name:</label>
              <input type="text" id="first-name" />
            </div>
            <div class="form-groups">
              <label for="middle-name">Middle Name:</label>
              <input type="text" id="middle-name" />
            </div>
            <div class="form-groups">
              <label for="last-name">Last Name:</label>
              <input type="text" id="last-name" />
            </div>
            <div class="form-groups">
              <label for="course">Course:</label>
              <input type="text" id="course" />
            </div>
            <div class="form-groups">
              <label for="section">Section:</label>
              <input type="text" id="section" />
            </div>
            <div class="form-groups">
              <label for="gender">Gender:</label>
              <select id="gender">
                <option value="female">FEMALE</option>
                <option value="male">MALE</option>
              </select>
              <label for="status">Status:</label>
              <input type="text" id="status" />
            </div>
            <div class="form-groups">
              <label for="dob">Date of Birth:</label>
              <input type="date" id="dob" />
            </div>
            <div class="form-groups">
              <label for="address">Address:</label>
              <input type="text" />
            </div>
            <div class="form-section">
              <strong>Contact Info:</strong>
              <div class="contact-info">
                <div class="form-groups">
                  <label for="contact-number">Contact Number:</label>
                  <input type="text" id="contact-number" class="styled-input" />
                </div>
                <div class="form-groups">
                  <label for="contact-person">Contact Person:</label>
                  <input type="text" id="contact-person" />
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="discard-btn" onclick="closeModal()">
                Discard Changes
              </button>
              <button type="submit" class="save-btn">Save</button>
            </div>
          </div>
          <div class="picture">
            <p>Profile Picture:</p>
            <div class="prof">
              <img id="profilePic" src="https://cdn-icons-png.flaticon.com/512/168/168719.png" alt="" />
              <i class="fa-solid fa-image"></i>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document
      .getElementById("file-input")
      .addEventListener("change", function() {
        var fileName = this.files[0].name;
        if (fileName) {
          document.querySelector(".file-label").textContent = fileName;
        } else {
          document.querySelector(".file-label").textContent = "Choose File";
        }
      });

    function openModal() {
      document.getElementById("editProfileModal").style.display = "block";
    }

    function closeModal() {
      document.getElementById("editProfileModal").style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == document.getElementById("editProfileModal")) {
        closeModal();
      }
    };
  </script>
</body>

</html>