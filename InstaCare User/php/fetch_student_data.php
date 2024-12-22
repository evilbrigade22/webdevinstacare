<?php
$query = "SELECT * FROM student_db WHERE student_id = $student_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $student_id = $row['student_id'];
  $username = $row['username'];
  $f_name = $row['f_name'];
  $m_name = $row['m_name'];
  $l_name = $row['l_name'];
  $course = $row['course'];
  $section = $row['section'];
  $address = $row['address'];
  $bday = $row['bday'];
  $gender = $row['gender'];
  $status = $row['status'];
  $nationality = $row['nationality'];
  $contact_number = $row['contact_number'];
  $contact_person = $row['contact_person'];
  $username = $row['username'];
} else {
  echo "No nurse record";
}
