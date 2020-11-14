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
<<<<<<< HEAD

$sql = "SELECT store_type, AVG(age) FROM CustomerInfo GROUP BY store_type";
=======
$sql = "SELECT store_type, AVG(age) FROM CustomerInfo join StoreType s where CustomerInfo.store_type=s.store_type GROUP BY store_type";
>>>>>>> b5e0b637cb55add10a9a2de77ac3b264ac37fb48
$res = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($res)){
    printf("store_type:%d, average age: %d\n",$row["store_type"], $row["AVG(age)"]);
}

mysqli_close($conn);
?>