<?php

include 'database/dbcon.php';

$email = $_POST['email'];

$sql = "SELECT * FROM maualuser WHERE email = '$email'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  echo 'available';
} else {
  echo 'taken';
}

mysqli_close($con);

?>
