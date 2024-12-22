<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <ul>
    <li class="logo-container">
      <a href="index.php">
        <img class="logo" src="asset/img/InstaCare_Combined.png
              " alt="" />
      </a>
    </li>
    <li>
      <a href="index.php">
        <i class="fas fa-th-large"></i>
        <div class="title">Dashboard</div>
      </a>
    </li>
    <li>
      <a href="appointment.php">
        <i class="fa-solid fa-calendar-check"></i>
        <div class="title">Appointments</div>
      </a>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-btn" onclick="toggleDropdown(event)">
        <i class="fa-solid fa-tablets"></i>
        <div class="title">Request</div>
      </a>
      <div class="dropdown-content">
        <a href="medicinerequest.php">Medicine Request</a>
        <a href="medicalcertificaterequest.php">Medical Certificate Request</a>
      </div>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-btn" onclick="toggleDropdown(event)">
        <i class="fa-solid fa-clipboard"></i>
        <div class="title">Record</div>
      </a>
      <div class="dropdown-content">
        <a href="consultation.php">Consultation Record</a>
        <a href="dentalrecord.php">Dental Record</a>
        <a href="medicalrecord.php">Medical Record</a>
      </div>
    </li>
    <li>
      <a href="accidentreport.php">
        <i class="fa-solid fa-person-falling-burst"></i>
        <div class="title">Accident Report</div>
      </a>
    </li>
    <li>
      <a href="inventory.php">
        <i class="fa-solid fa-box-archive"></i>
        <div class="title">Inventory</div>
      </a>
    </li>
    <li>
      <a href="admin.php">
        <i class="fa-solid fa-user-tie"></i>
        <div class="title">Admin</div>
      </a>
    </li>
    <li style="margin-top: 5rem">
      <a href="php/log_out_function.php">
        <i class="fa-solid fa-right-from-bracket"></i>
        <div class="title">Logout</div>
      </a>
    </li>
  </ul>

</body>

</html>