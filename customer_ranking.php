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

//$sql = "SELECT * FROM customerinfo INNER JOIN storetype ON customerinfo.store_type = storetype.id";

$sql = "SELECT storetype.store_type, AVG(customerinfo.age) FROM customerinfo INNER JOIN storetype ON customerinfo.store_type = storetype.id GROUP BY store_type";

$res = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    printf("store_type:%s, average age: %d\n",$row["store_type"], $row["AVG(customerinfo.age)"]);
}

mysqli_close($conn);
?>