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
    

    
    // sql to create table
    $sql = "CREATE TABLE storeKind(
    store_kind VARCHAR(6) NOT NULL,
    food_type INT(6) UNSIGNED NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );";
    
    $res = mysqli_query($conn, $sql);
    if ($res === TRUE) {
      echo "Table restareaInfo created successfully";
    } else {
      echo "Error creating table: " . mysqli_error($conn);
    }
    
    //insert data
    $sql = "
    INSERT INTO storeKind (store_kind, food_type) VALUES
    ('한식','1001'),
('카페','1002'),
('분식','1003'),
('기타','1004'),
('간식','1005'),
('편의점','1006'),
('중식','1007'),
('양식','1008'),
('기타','1009');";


    $res = mysqli_query($conn, $sql);
    if ($res === TRUE) {
      echo "New record created successfully";
    } else {
        echo "Error inserting database: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
    ?>