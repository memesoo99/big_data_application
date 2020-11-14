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
        $sql = "SELECT s.id, s.store_name, ra.name, p.product_name, stype.store_type, ranking
        from StoreInfo s join RestAreaInfo ra on s.ra_id=ra.id
        join ProductInfo p on s.product_id=p.id
        join StoreType stype on s.store_type=stype.id;
        ";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            echo "<table><tr><th>ID</th><th>Name</th><th>Rest Area</th><th>product</th><th>type</th><th>ranking</th></tr>";
            // output data of each row
            while($row = $res->fetch_assoc()) {
              echo "<tr><td>".$row["id"]."</td><td>".$row["store_name"]."</td><td>".$row["name"]."</td>
              <td>".$row["product_name"]."</td><td>".$row["store_type"]."</td><td>".$row["ranking"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }
    mysqli_close($conn);
?>