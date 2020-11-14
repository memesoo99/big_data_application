<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "myDB";
    
    $conn = mysqli_connect($servername, $username, $password, "myDB");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else {
        $name=$_POST["name"];
        $area=$_POST["area"];
        $sql="INSERT INTO RestAreaInfo(name, area) VALUES ('$name',$area)";
        
        if (mysqli_query($conn,$sql)) {
            echo "New record inserted successfully";
        } else {
            echo "Error inserting database: " . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }
?>