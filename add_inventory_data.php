<?php
  // kunin and db
  require 'database/dbcon.php';

  // get post data
  $product_name = $_POST['product_name'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];

  // prep statement
  $stmt = $con->prepare("INSERT INTO inventory (product_name, quantity, price) VALUES (?, ?, ?)");
  $stmt->bind_param("sii", $product_name, $quantity, $price);

  // run statement
  if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Inventory added successfully";
  } else {
    $response['success'] = false;
    $response['message'] = "Error adding inventory";
  }

  //send response
  header('Content-Type: application/json');
  echo json_encode($response);
//close conn
  $stmt->close();
  $con->close();
?>
