<?php

include 'database/dbcon.php';

// Get the user registration data from the AJAX request
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Insert the user's registration data into the database
$sql = "INSERT INTO maualuser (email, username, password)
        VALUES ('$email', '$username', '$password')";

if (mysqli_query($con, $sql)) {
    // If the insertion is successful, redirect to home.php
    header("Location: login1.php");
    exit(); // Make sure to exit after the header is sent
} else {
    // If the insertion fails, return an error message to the AJAX request
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($con);

?>
