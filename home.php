<?php
require 'database/dbcon.php';

if(!isset($_SESSION['login_id'])){
    header('Location: login.php');
    exit;
}



$id = $_SESSION['login_id'];
$get_user = mysqli_query($con, "SELECT * FROM `users` WHERE `google_id`='$id'");
$get_user2 = mysqli_query($con, "SELECT * FROM `maualuser` WHERE `id`='$id'");

if (mysqli_num_rows($get_user) > 0) {
    $user = mysqli_fetch_assoc($get_user);
} else if (mysqli_num_rows($get_user2) > 0) {
    $user2 = mysqli_fetch_assoc($get_user2);
} else {
    header('Location: logout.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

<!-- JavaScript (jQuery is required) -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>




    <title>EStore</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7ff;
            padding: 10px;
            margin: 0;
        }
        ._container{
            max-width: 400px;
            background-color: #ffffff;
            padding: 20px;
            margin: 0 auto;
            border-radius: 2px;
        }
        .heading{
            text-align: center;
            color: #4d4d4d;
            text-transform: uppercase;
        }
        ._img{
            overflow: hidden;
            width: 100px;
            height: 100px;
            margin: 0 auto;
            border-radius: 50%;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        ._img > img{
            width: 100px;
            min-height: 100px;
        }
        ._info{
            text-align: center;
        }
        ._info h1{
            margin:10px 0;
            text-transform: capitalize;
        }
        ._info p{
            color: #555555;
        }
        ._info a{
            display: inline-block;
            background-color: #E53E3E;
            color: #fff;
            text-decoration: none;
            padding:5px 10px;
            border-radius: 2px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<nav>
  <div class="nav-logo">
    <img src="css/192877_5445044_979319_image-removebg-preview.png" alt="EStore logo">
  </div>
  <div class="nav-name">
  </div>
  <ul>
    <li><div class="search-container">
  <input type="text" id="search-input" placeholder="Search...">
  <button id="search-button">Search</button>
</div>
</li>
    <li><button type="button" class="btn btn-primary" id="add-inventory-button" data-toggle="modal" data-target="#add-inventory-modal">Add Inventory</button></li>
    <li><a href="#" id="account-btn">My Account</a></li>

  </ul>
</nav>


<div id="account-modal" class="modal1">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="_container">
      <h2 class="heading">My Account</h2>
    </div>
    <div class="_container">
      <?php if(isset($user['profile_image'])): ?>
      <div class="_img">
        <img src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>">
      </div>
      <?php endif; ?>
      <div class="_info">
        <?php if(isset($user['name'])): ?>
        <h1><?php echo $user['name']; ?></h1>
        <?php endif; ?>
        <?php if(isset($user['email'])): ?>
        <p><?php echo $user['email']; ?></p>
        <?php endif; ?>
        <?php if(isset($user2)): ?>
        <?php foreach($user2 as $key => $value): ?>
        <?php if($key == 'name' || $key == 'email'): ?>
        <p><?php echo $key . ': ' . $value; ?></p>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>


<style>
    .modal1 {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal1-content {
  background-color: #fefefe;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  position: absolute;
  top: 0;
  right: 0;
  font-size: 28px;
  font-weight: bold;
  color: #aaa;
  padding: 10px;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}


nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 1rem;
  height: 70px;
}

nav .nav-logo img {
  height: 150px;
  margin-right: 0.5rem;
}

nav .nav-name h1 {
  font-size: 1.5rem;
  margin: 0;
}

nav ul {
  display: flex;
  align-items: center;
  margin: 0;
  padding: 0;
}

nav ul li {
  list-style: none;
  margin: 0 1rem;
}

nav ul li a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
  font-size: 1.1rem;
}

nav ul li a:hover {
  color: #007bff;
}


</style>


<div>
    <h3>eStore Inventory</h3>
</div>


<table id="inventory-table">


  <thead>
    <tr>
      <th>ID</th>
      <th>Product Name</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Date Created</th>
      <th>Updated Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<div id="add-inventory-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Inventory</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="add-inventory-form">
          <div class="form-group">
            <label for="product-name-input">Product Name:</label>
            <input type="text" class="form-control" id="product-name-input" name="product_name">
          </div>
          <div class="form-group">
            <label for="quantity-input">Quantity:</label>
            <input type="number" class="form-control" id="quantity-input" name="quantity">
          </div>
          <div class="form-group">
            <label for="price-input">Price:</label>
            <input type="number" class="form-control" id="price-input" name="price">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add-inventory-submit">Add</button>
      </div>
    </div>
  </div>
</div>




<div id="edit-inventory-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Inventory</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="edit-inventory-form">
          <input type="hidden" id="edit-inventory-id" name="id">
          <div class="form-group">
            <label for="edit-product-name-input">Product Name:</label>
            <input type="text" class="form-control" id="edit-product-name-input" name="product_name">
          </div>
          <div class="form-group">
            <label for="edit-quantity-input">Quantity:</label>
            <input type="number" class="form-control" id="edit-quantity-input" name="quantity">
          </div>
          <div class="form-group">
            <label for="edit-price-input">Price:</label>
            <input type="number" class="form-control" id="edit-price-input" name="price">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="edit-inventory-submit">Save Changes</button>
      </div>
    </div>
  </div>
</div>




<style>
    #inventory-table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

#inventory-table th,
#inventory-table td {
  padding: 10px;
  text-align: left;
  vertical-align: middle;
  border: 1px solid #ccc;
}

#inventory-table th {
  font-weight: bold;
  background-color: #f0f0f0;
}

#inventory-table tbody tr:hover {
  background-color: #f0f0f0;
}

.edit-button,
.delete-button {
  padding: 5px 10px;
  border: none;
  background-color: #3498db;
  color: #fff;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.edit-button:hover,
.delete-button:hover {
  background-color: #2980b9;
}

.edit-button {
  margin-right: 5px;
}

.search-container {
  display: flex;
  justify-content: right;
  margin-bottom: 10px;
}

#search-input {
  padding: 5px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid #ccc;
  margin-right: 5px;
}

#search-button {
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: none;
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}

.modal {
  display: none; /* hide the modal by default */
  position: fixed; /* position the modal relative to the viewport */
  z-index: 1050;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* allow scrolling within the modal */
  background-color: rgba(0, 0, 0, 0.4); /* add a semi-transparent black background behind the modal */
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 500px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}






</style>



<script>
    $(document).ready(function() {
  // Load inventory data on page load
  loadInventoryData();

  // Search inventory data on keyup event
  $('#search-input').on('keyup', function() {
    searchInventoryData();
  });
});




function loadInventoryData() {
  $.ajax({
    url: 'get_inventory_data.php',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
      // Append inventory 
      $.each(data, function(index, inventoryItem) {
        var row = '<tr>';
        row += '<td>' + inventoryItem.id + '</td>';
        row += '<td>' + inventoryItem.product_name + '</td>';
        row += '<td>' + inventoryItem.quantity + '</td>';
        row += '<td>' + inventoryItem.price + '</td>';
        row += '<td>' + inventoryItem.date_created + '</td>';
        row += '<td>' + inventoryItem.updated_date + '</td>';
        row += '<td><button class="edit-button">&#x270E; Edit</button> <button class="delete-button">&#x1F5D1; Delete</button></td>';

        row += '</tr>';
        $('#inventory-table tbody').append(row);
      });
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
}

function searchInventoryData() {
  var searchQuery = $('#search-input').val();
  $.ajax({
    url: 'search_inventory_data.php',
    method: 'GET',
    data: { query: searchQuery },
    dataType: 'json',
    success: function(data) {
      // Clear existing table data
      $('#inventory-table tbody').empty();

   
      $.each(data, function(index, inventoryItem) {
        var row = '<tr>';
        row += '<td>' + inventoryItem.id + '</td>';
        row += '<td>' + inventoryItem.product_name + '</td>';
        row += '<td>' + inventoryItem.quantity + '</td>';
        row += '<td>' + inventoryItem.price + '</td>';
        row += '<td>' + inventoryItem.date_created + '</td>';
        row += '<td>' + inventoryItem.updated_date + '</td>';
        row += '<td><button class="edit-button">Edit</button> <button class="delete-button">Delete</button></td>';
        row += '</tr>';
        $('#inventory-table tbody').append(row);
      });
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
}


$('#add-inventory-button').click(function() {
  $('#add-inventory-modal').fadeIn();
});

// Hide the modal when the close button is clicked
$('.close').click(function() {
  $('#add-inventory-modal').fadeOut();
});

// Hide the modal when the "Cancel" button is clicked
$('#add-inventory-cancel').click(function() {
  $('#add-inventory-modal').fadeOut();
});

// Submit the form and close the modal when the "Add" button is clicked
$('#add-inventory-submit').click(function() {
  $('#add-inventory-form').submit();
  $('#add-inventory-modal').fadeOut();
});

$('#add-inventory-submit').click(function() {
  // Get form data
  var formData = $('#add-inventory-form').serialize();

  // Submit AJAX request
  $.ajax({
    url: 'add_inventory_data.php',
    method: 'POST',
    data: formData,
    dataType: 'json',
    success: function(response) {
      // Reload table data
      getInventoryData();
      // Clear form fields
      $('#add-inventory-form')[0].reset();
      // Close modal
      $('#add-inventory-modal').modal('hide');
      // Show success message
      alert(response.message);
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
});

$(document).on('click', '.edit-button', function() {
  var inventoryItemId = $(this).closest('tr').find('td:first-child').text();
  $('#edit-inventory-modal').modal('show');

  $.ajax({
    url: 'get_inventory_item.php',
    method: 'GET',
    data: { id: inventoryItemId },
    dataType: 'json',
    success: function(data) {
      // Populate the modal form with data
      $('#edit-product-name-input').val(data.product_name);
      $('#edit-quantity-input').val(data.quantity);
      $('#edit-price-input').val(data.price);
      $('#edit-inventory-id').val(data.id);
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
});

$(document).on('click', '#edit-inventory-submit', function() {
  // Get form data
  var formData = $('#edit-inventory-form').serialize();

  // Submit AJAX request
  $.ajax({
    url: 'update_inventory_item.php',
    method: 'POST',
    data: formData,
    dataType: 'json',
    success: function(response) {
      // Hide the modal
      $('#edit-inventory-modal').modal('hide');

      $('#inventory-table tbody').empty();
 // Reload the table data
 loadInventoryData();
      // Show success message
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: response.message
      });
      
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
});




$(document).on('click', '.delete-button', function() {
  // Get the row element
  var row = $(this).closest('tr');
// Get the inventory item ID from the row
var inventoryItemId = row.find('td:first').text();


  
  // Check if inventoryItemId is not empty
  if (inventoryItemId === "") {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Inventory item ID not provided.'
    });
    return;
  }

  // Prompt a Swal confirmation
  Swal.fire({
    title: 'Are you sure?',
    text: 'You will not be able to recover this item!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Submit AJAX request to delete the inventory item
      $.ajax({
        url: 'delete_inventory_item.php',
        method: 'POST',
        data: { id: inventoryItemId },
        dataType: 'json',
        success: function(response) {
          // Remove the row from the table
          row.remove();
          // Show success message
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.message
          });
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    }
  });
});


var modal = document.getElementById("account-modal");
var btn = document.getElementById("account-btn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}














</script>



</body>
</html>