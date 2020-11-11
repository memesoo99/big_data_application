<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myDB";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, "myDB");
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    

    
    // sql to create table
    $sql = "CREATE TABLE customerInfo(
    customer_id INT(6) PRIMARY KEY,
    age INT(6) UNSIGNED NOT NULL,
    store_id int(6) UNSIGNED NOT NULL,
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
    INSERT INTO customerInfo (customer_id, age, store_id) VALUES
    ('101','17','1002'),
    ('102','46','1001'),
    ('103','44','1005'),
    ('104','31','1002'),
    ('105','31','1001'),
    ('106','20','1005'),
    ('107','52','1001'),
    ('108','25','1001'),
    ('109','40','1003'),
    ('110','27','1002'),
    ('111','35','1002'),
    ('112','15','1008'),
    ('113','46','1001'),
    ('114','20','1005'),
    ('115','30','1003'),
    ('116','37','1001'),
    ('117','40','1002'),
    ('118','62','1001'),
    ('119','48','1001'),
    ('120','55','1001'),
    ('121','23','1005'),
    ('122','19','1002'),
    ('123','31','1002'),
    ('124','63','1001'),
    ('125','30','1006'),
    ('126','22','1005'),
    ('127','44','1001'),
    ('128','37','1005'),
    ('129','17','1005'),
    ('130','30','1001');";
    

    $res = mysqli_query($conn, $sql);
    if ($res === TRUE) {
      echo "New record created successfully";
    } else {
        echo "Error inserting database: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
    ?>