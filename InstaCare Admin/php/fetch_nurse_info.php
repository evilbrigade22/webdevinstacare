<?php
$query = "SELECT * FROM nurse_db WHERE nurse_id = $nurse_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $username = $row['username'];
  $n_f_name = $row['nurse_f_name'];
  $n_m_name = $row['nurse_m_name'];
  $n_l_name = $row['nurse_l_name'];
} else {
  echo "No nurse record";
}
