<?php
$servername = "localhost";
$username = "team05";
$password = "team05";


$conn = new mysqli($servername, $username, $password);

if(!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE team05";
$res = mysqli_query($conn, $sql);
if ($res === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}

$conn->close();
?>