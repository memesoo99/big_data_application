<html>
  <body>
    <div>
      <p><a href="Store_insert.php">insert store info</a>
      | <a href="Store_delete.php">delete store info</a>
      | <a href="Store_update.php">update store info</a></p>
    </div>
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
        /*sql안됨 왜1!!!!!*/
        $sql = "SELECT all.id, ra.name, s.store_name, a.area, all.sales
        from WholeStore all join RestAreaInfo ra on all.ra_id=ra.id
        join StoreInfo s on all.store_id=s.id
        join Area a on all.area_id=a.id
        ";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            echo "<table><tr><th>ID</th><th>Name</th><th>Rest Area</th><th>product</th><th>type</th><th>ranking</th></tr>";
            // output data of each row
            while($row = $res->fetch_assoc()) {
              echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["store_name"]."</td>
              <td>".$row["area"]."</td><td>".$row["sales"]."</td><td>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }
    mysqli_close($conn);
    ?>
