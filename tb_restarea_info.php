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
    $sql = "CREATE TABLE restareaInfo(
    id VARCHAR(6) PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    area VARCHAR(30) NOT NULL,
    rank int(6) UNSIGNED NOT NULL,
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
    INSERT INTO restareaInfo (id, name, area, rank) VALUES
    ('RA01','시흥하늘휴게소','서울경기','1'),
    ('RA02','구리(일산)휴게소','서울경기','2'),
    ('RA03','죽전(서울)휴게소','서울경기','3'),
    ('RA04','선산(양평)휴게소','서울경기','4'),
    ('RA05','안성맞춤(평택)휴게소','서울경기','5'),
    ('RA06','통도사(부산)휴게소','부산경상','6'),
    ('RA07','사천(부산)휴게소','부산경상','7'),
    ('RA08','현풍(대구)휴게소','부산경상','8'),
    ('RA09','칠곡(부산)휴게소','부산경상','9'),
    ('RA10','영천(대구)휴게소','부산경상','10'),
    ('RA11','함평나비(광주)휴게소','전라','11'),
    ('RA12','정읍녹두장군(천안)휴게소','전라','12'),
    ('RA13','보성녹차(순천)휴게소','전라','13'),
    ('RA14','강천산(광주)휴게소','전라','14'),
    ('RA15','청주(서울)휴게소','충청','15'),
    ('RA16','옥산(부산)휴게소','충청','16'),
    ('RA17','공주(대전)휴게소','충청','17'),
    ('RA18','천등산(평택)휴게소','충청','18'),
    ('RA19','예산(당진)휴게소','충청','19'),
    ('RA20','내린천휴게소','강원','20'),
    ('RA21','홍천(양양)휴게소','강원','21'),
    ('RA22','문막(강릉)휴게소','강원','22'),
    ('RA23','옥계(속초)휴게소','강원','23'),
    ('RA24','평창(강릉)휴게소','강원','24');";
    $res = mysqli_query($conn, $sql);
    if ($res === TRUE) {
      echo "New record created successfully";
    } else {
        echo "Error inserting database: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
    ?>