<?php
// Connect to database
include 'database/dbcon.php';

// Check connection
if (!$con) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Query to select all inventory items
$sql = 'SELECT * FROM inventory';

// Execute query and get result
$result = mysqli_query($con, $sql);

// Check if result contains any data
if (mysqli_num_rows($result) > 0) {
  // Loop 
  $inventoryData = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $inventoryData[] = $row;
  }

  // Return data as JSON
  header('Content-Type: application/json');
  echo json_encode($inventoryData);
} else {
  // Return empty array if no data found
  echo '[]';
}

// Close connection
mysqli_close($con);
?>
