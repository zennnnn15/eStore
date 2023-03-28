<?php
require 'database/dbcon.php';

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Escape user input to prevent SQL injection
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    // Query the database for a user with the matching email and hashed password
    $selectUsers = "SELECT id FROM `maualuser` WHERE `email`='$email' AND `password`='$password'";
    $usersq = $con->query($selectUsers);

    if($usersq->num_rows > 0) {
        $row = $usersq->fetch_assoc();
        session_start();
        $_SESSION['login_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
      $_SESSION['email']= $row['email'];

        echo "success"; // This will be returned to AJAX success function
    } else {
        echo "Invalid email or password";
    }
}
?>
