<?php
include 'database/dbcon.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
  
    $sql = "DELETE FROM `inventory` WHERE `inventory`.`id` = $id;";
  

    $result = mysqli_query($con, $sql);
  

    if ($result) {
  
      $response = [
        'success' => true,
        'message' => 'Inventory item deleted successfully.'
      ];
    } else {

      $response = [
        'success' => false,
        'message' => 'Failed to delete inventory item.'
      ];
    }
  } else {
    
    $response = [
      'success' => false,
      'message' => 'Inventory item ID not provided.'
    ];
  }
  
 
  echo json_encode($response);
  
?>
