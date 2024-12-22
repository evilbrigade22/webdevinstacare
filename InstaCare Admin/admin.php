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
  <title>Admin</title>
  <link rel="stylesheet" href="./asset/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
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
          <p>Admin</p>
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
      <div class="admin-content">
        <div class="admin-filter-container">
          <div class="addadmin">
            <button id="addAdminBtn">+ Add Admin</button>
          </div>
          <input type="text" placeholder="Search ID or Name" />
        </div>
        <table class="admin-table">
          <thead>
            <tr>
              <th>ID number</th>
              <th>Name</th>
              <th>Licence No.</th>
              <th>Contacts</th>
              <th>Username</th>
              <th>Password</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Example row -->
            <?php
            $query = "SELECT * FROM nurse_db";

            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $nurse_id = $row['nurse_id'];
                urlencode($nurse_id);
                $nurse_f_name = $row['nurse_f_name'];
                $nurse_m_name = $row['nurse_m_name'];
                $nurse_l_name = $row['nurse_l_name'];
                $license_number = $row['license_number'];
                $username = $row['username'];
                $password = $row['password'];
                $contact = $row['contact'];

                echo '
                  <tr>
                      <td>' . $nurse_id . '</td>
                      <td>' . $nurse_f_name . ' ' . $nurse_m_name . ' ' . $nurse_l_name . '</td>
                      <td>' . $license_number . '</td>
                      <td>' . $contact . '</td>
                      <td>' . $username . '</td>
                      <td>
                        <div class="password-container">
                          <input type="password" value="' . $password . '" class="password-input" disabled>
                          <button class="show-password-btn" onclick="togglePasswordVisibility(this)">Show</button>
                        </div>
                      </td>
                      <td class="actions">
                        <div class="tooltip">
                          <a href="#" class="edit-row"><i style="color: green;" class="fa-regular fa-pen-to-square"></i></a>
                          <a href="php/delete_admin_data.php?nurse_id=' . urlencode($nurse_id) . '"><i style="color:red;" class="fa-solid fa-trash"></i></a>
                        </div>
                      </td>
                    </tr>


                ';
              }
            }
            ?>
            <tr>
              <td>2021-170234</td>
              <td>Nathaniel Victor</td>
              <td>4123434</td>
              <td>09771237654</td>
              <td>nath</td>
              <td>
                <div class="password-container">
                  <input type="password" value="69696969" class="password-input" disabled>
                  <button class="show-password-btn" onclick="togglePasswordVisibility(this)">Show</button>
                </div>
              </td>
              <td class="actions">
                <div class="tooltip">
                  <a href="#" class="edit-row"><i style="color: green;" class="fa-regular fa-pen-to-square"></i></a>
                  <a href="#"><i style="color:red;" class="fa-solid fa-trash"></i></a>
                </div>
              </td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>
    </div>
    <!-- main end-->
  </div>

  <!-- The Modal -->
  <div id="addAdminModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Add Admin</h2>
      <form id="addAdminForm" action="php/insert_admin_data.php" method="POST">
        <div class="form-group">
          <label for="name">First name :</label>
          <input type="text" id="name" name="f_name">
          <label for="name">Middle name:</label>
          <input type="text" id="name" name="m_name">
          <label for="name">Last name:</label>
          <input type="text" id="name" name="l_name">
        </div>
        <div class="form-group">
          <label for="licenceNo">Licence Number:</label>
          <input type="text" id="licenceNo" name="licenceNo">
        </div>
        <div class="form-group">
          <label for="contacts">Contact Number:</label>
          <input type="text" id="contacts" name="contacts">
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
          <input type="submit" value="Add Admin">
        </div>
        <div class="form-group">
          <p>
            <?php
            if (isset($_SESSION['errors']) && is_array($_SESSION['errors']) && !empty($_SESSION['errors'])) {
              echo implode("<br>", $_SESSION['errors']);
              // Destroy the errors session
              unset($_SESSION['errors']);
            }
            ?>
          </p>
        </div>
      </form>
    </div>
  </div>
  <script>
    // Get the modal
    var modal = document.getElementById("addAdminModal");

    // Get the button that opens the modal
    var btn = document.getElementById("addAdminBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    function togglePasswordVisibility(button) {
      var passwordContainer = button.parentElement;
      var passwordInput = passwordContainer.querySelector(".password-input");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        button.textContent = "Hide";
      } else {
        passwordInput.type = "password";
        button.textContent = "Show";
      }
    }

    // Open modal if there's an error
    document.addEventListener('DOMContentLoaded', () => {
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('error')) {
        modal.style.display = 'block';
      }

      // Row editing functionality
      document.querySelectorAll('.edit-row').forEach(editBtn => {
        editBtn.addEventListener('click', function(event) {
          event.preventDefault();
          const row = this.closest('tr');
          if (!row.classList.contains('editing')) {
            toggleRowEdit(row, true);
          }
        });
      });
    });

    function toggleRowEdit(row, isEditMode) {
      const cells = row.querySelectorAll('td:not(.actions)');
      if (isEditMode) {
        row.classList.add('editing');
        cells.forEach(cell => {
          const cellValue = cell.textContent.trim();
          if (cell.querySelector('.password-container')) {
            const passwordContainer = cell.querySelector('.password-container');
            const passwordInput = passwordContainer.querySelector('.password-input');
            const passwordValue = passwordInput.value;

            const input = document.createElement('input');
            input.type = 'text';
            input.value = passwordValue;
            passwordContainer.innerHTML = '';
            passwordContainer.appendChild(input);
          } else {
            const input = document.createElement('input');
            input.type = 'text';
            input.value = cellValue;
            cell.innerHTML = '';
            cell.appendChild(input);
          }
        });

        const actionsCell = row.querySelector('.actions');
        const saveBtn = document.createElement('a');
        saveBtn.href = '#';
        saveBtn.innerHTML = '<i style="color: blue;" class="fa-solid fa-save"></i>';
        saveBtn.classList.add('save-row');
        saveBtn.addEventListener('click', function(event) {
          event.preventDefault();
          toggleRowEdit(row, false);
        });
        actionsCell.appendChild(saveBtn);
      } else {
        row.classList.remove('editing');
        cells.forEach(cell => {
          if (cell.querySelector('.password-container')) {
            const passwordContainer = cell.querySelector('.password-container');
            const input = passwordContainer.querySelector('input');
            if (input) {
              const passwordValue = input.value;
              passwordContainer.innerHTML = `<input type="password" value="${passwordValue}" class="password-input" disabled>
                                           <button class="show-password-btn" onclick="togglePasswordVisibility(this)">Show</button>`;
            }
          } else {
            const input = cell.querySelector('input');
            if (input) {
              cell.textContent = input.value;
            }
          }
        });

        const actionsCell = row.querySelector('.actions');
        const saveBtn = actionsCell.querySelector('.save-row');
        if (saveBtn) {
          saveBtn.remove();
        }
      }
    }
  </script>
</body>

</html>