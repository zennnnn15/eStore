<?php
// Include the database connection file
include 'database/dbcon.php';

// Get the inventory item data from the AJAX request
$id = $_POST['id'];
$productName = $_POST['product_name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

// Prepare the SQL query to update the inventory item with the specified ID
$sql = "UPDATE inventory SET product_name = '$productName', quantity = '$quantity', price = '$price', updated_date = NOW() WHERE id = $id";

// Execute the SQL query
$result = mysqli_query($con, $sql);

// Check if the query was successful
if ($result) {
  // Send a JSON response indicating success
  $response = array('status' => 'success', 'message' => 'Inventory item updated successfully');
  echo json_encode($response);
} else {
  // Send a JSON response indicating error
  $response = array('status' => 'error', 'message' => 'Error updating inventory item: ' . mysqli_error($con));
  echo json_encode($response);
}

// Close the database connection
mysqli_close($con);
?>
