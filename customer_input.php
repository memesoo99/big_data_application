<?php

    $data_age = $_POST['age'];
    $data_combobox = $_POST['customer_combobox'];

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

    $sql = "INSERT INTO CustomerInfo(age, store_type) 
    VALUES (".$data_age.,.$data_combobox.")";
    $res=mysqli_query($conn,$sql);
    if($res===TRUE){
        echo "A record has been inserted.";
    }else{
        echo "Error inserting database: " . mysqli_error($conn);
    }
    mysqli_close($conn);





?>