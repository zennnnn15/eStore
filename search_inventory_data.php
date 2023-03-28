<?php
// Retrieve search query from GET parameters
$query = $_GET['query'];

include 'database/dbcon.php';

// Build SQL query based on search query
$sql = "SELECT * FROM inventory WHERE 
          id LIKE '%$query%' OR 
          product_name LIKE '%$query%' OR 
          quantity LIKE '%$query%' OR 
          price LIKE '%$query%' OR 
          date_created LIKE '%$query%' OR 
          updated_date LIKE '%$query%'";
$result = $con->query($sql);

// Build array of inventory items
$inventoryItems = array();
while ($row = $result->fetch_assoc()) {
  $inventoryItem = array(
    'id' => $row['id'],
    'product_name' => $row['product_name'],
    'quantity' => $row['quantity'],
    'price' => $row['price'],
    'date_created' => $row['date_created'],
    'updated_date' => $row['updated_date']
  );
  array_push($inventoryItems, $inventoryItem);
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($inventoryItems);

// Close database connection
$con->close();
?>
