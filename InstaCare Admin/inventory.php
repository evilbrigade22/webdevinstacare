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
  <title>Inventory</title>
  <link rel="stylesheet" href="./asset/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <script src="script.js" defer></script>
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
          <p>Inventory</p>
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

      <div class="template-cotnent">
        <div class="inventory-add-medicine"><button id="addMedicineBtn">+ Add medicine</button></div>
        <div class="inventory-cards">
          <?php
          $query = "SELECT * FROM inventory_db";
          $result = mysqli_query($conn, $query);

          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $medicine_name = $row['medicine_name'];
              $dosage = $row['dosage'];
              $stock_in = $row['stock_in'];
              $medicine_img = $row['medicine_img'];

              $img_path = 'php/';

              $img = $img_path . $medicine_img;


              echo ' 
                    
                      <div class="inventory-card">
                        <div class="inventory-card-image">
                          <img src="' . $img . '" alt="" />
                        </div>
                        <div class="inventory-card-details">
                          <label for="brandname">' . $medicine_name . '</label>
                          <label for="mg">' . $dosage . '</label>
                        </div>
                        <div class="inventory-count">
                          Stock : ' . $stock_in . ' 
                        </div>
                        <div class="inventory-button"><button class="editMedicineBtn">Edit</button></div>
                      </div>
                    
              
              ';
            }
          }
          ?>
        </div>





      </div>

    </div>
    <!-- main end-->
  </div>
  <!-- container end -->

  <!-- Add Medicine Modal -->
  <div id="addMedicineModal" class="modal">
    <form action="php/insert_medicine_data.php" method="POST" enctype="multipart/form-data">

      <div class="modal-content">
        <span class=" close" style="color: white; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
        <h2>Add Medicine</h2>
        <form id="addMedicineForm" enctype="multipart/form-data">
          <div class="form-group" style="margin-bottom: 15px;">
            <label style="color: white;" for="medicineName">Medicine Name:</label>
            <input type="text" id="medicineName" name="medicineName" required style="width: 100%; padding: 4px; box-sizing: border-box;">
          </div>
          <div class="form-group" style="margin-bottom: 15px;">
            <label style="color: white;" for="dosage">Dosage (mg):</label>
            <input type="number" id="dosage" name="dosage" required style="width: 100%; padding: 4px; box-sizing: border-box;">
          </div>
          <div class="form-group" style="margin-bottom: 15px;">
            <label style="color: white;" for="stockIn">Stock In:</label>
            <input type="number" id="stockIn" name="stockIn" required style="width: 100%; padding: 4px; box-sizing: border-box;">
          </div>
          <div class="form-group" style="margin-bottom: 15px;">
            <label style="color: white;" for="medicineImage">Upload Image:</label>
            <input type="file" id="medicineImage" name="medicineImage" accept="image/*" required style="width: 100%; padding: 4px; box-sizing: border-box;">
          </div>
          <button class="submit" type="submit">Add Medicine</button>
        </form>
      </div>
    </form>
  </div>

  <!-- Edit Medicine Modal -->
  <div id="editMedicineModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Edit Medicine</h2>
      <form id="editMedicineForm" enctype="multipart/form-data">
        <input type="hidden" id="editMedicineId" name="medicineId">
        <div class="form-group">
          <label for="editMedicineName">Medicine Name:</label>
          <input type="text" id="editMedicineName" name="medicineName" required>
        </div>
        <div class="form-group">
          <label for="editDosage">Dosage (mg):</label>
          <input type="number" id="editDosage" name="dosage" required>
        </div>
        <div class="form-group">
          <label for="editStockIn">Stock In:</label>
          <input type="number" id="editStockIn" name="stockIn" required>
        </div>
        <div class="form-group">
          <label for="editStockOut">Stock Out:</label>
          <input type="number" id="editStockOut" name="stockOut" required>
        </div>
        <div class="form-group">
          <label for="editMedicineImage">Upload Image:</label>
          <input type="file" id="editMedicineImage" name="medicineImage" accept="image/*">
        </div>
        <button class="submit" type="submit">Update Medicine</button>
      </form>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const addMedicineBtn = document.getElementById('addMedicineBtn');
      const addMedicineModal = document.getElementById('addMedicineModal');
      const editMedicineBtns = document.querySelectorAll('.editMedicineBtn');
      const editMedicineModal = document.getElementById('editMedicineModal');
      const closeButtons = document.querySelectorAll('.close');

      // Open Add Medicine Modal
      addMedicineBtn.addEventListener('click', function() {
        addMedicineModal.style.display = 'block';
      });

      // Open Edit Medicine Modal
      editMedicineBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
          editMedicineModal.style.display = 'block';
          // Here you can add code to populate the form with existing data if needed
        });
      });

      // Close Modal
      closeButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
          addMedicineModal.style.display = 'none';
          editMedicineModal.style.display = 'none';
        });
      });

      // Close Modal when clicking outside of the modal
      window.addEventListener('click', function(event) {
        if (event.target == addMedicineModal) {
          addMedicineModal.style.display = 'none';
        }
        if (event.target == editMedicineModal) {
          editMedicineModal.style.display = 'none';
        }
      });
    });
  </script>
</body>

</html>