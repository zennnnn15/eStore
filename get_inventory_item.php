<?php

include 'database/dbcon.php';


$id = $_GET['id'];


$sql = "SELECT * FROM inventory WHERE id = $id";

$result = mysqli_query($con, $sql);

if ($result) {

  $inventoryItem = mysqli_fetch_assoc($result);


  $json = json_encode($inventoryItem);

  header('Content-Type: application/json');


  echo $json;
} else {
 
  $error = mysqli_error($conn);
  echo "Error fetching inventory item: $error";
}


mysqli_close($con);
?> 