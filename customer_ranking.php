<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, "myDB");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM customerinfo INNER JOIN storetype ON customerinfo.store_type = storetype.id";

$sql = "SELECT store_type, AVG(age) FROM CustomerInfo GROUP BY store_type";
$res = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($res)){
    printf("store_type:%d, average age: %d\n",$row["store_type"], $row["AVG(age)"]);
}

mysqli_close($conn);
?>