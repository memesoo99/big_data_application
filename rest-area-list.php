<html>
  <head>
    <head><link rel="stylesheet" href="bitnami.css"/></head>
  </head>
  <body>
    <p><a href="insert-rest-area.php">insert rest area</a>
    | <a href="delete-rest-area.php">delete rest area</a>
    | <a href="update-rest-area.php">update rest area info</a></p>
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
      $sql="SELECT area.area, sub1.name ,sub1.sum, sub1.id
      FROM(SELECT wholestore.area_id, restareainfo.name AS name, SUM(sales) AS sum, restareainfo.id as id FROM wholestore 
      INNER JOIN  restareainfo ON wholestore.ra_id=restareainfo.id GROUP BY ra_id) sub1
      INNER JOIN area ON sub1.area_id=area.id ORDER BY sub1.id";
       
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            echo "<table border=1><tr><th>ID</th><th>Name</th><th>area</th><th>sales</th></tr>";
            while($row = $res->fetch_assoc()) {
              echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["area"]."</td><td>".$row['sum']."</td><tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }


        $sql="SELECT area, name,store_name, SUM(sales) FROM(SELECT 
        area, name, store_name,sales
        FROM(SELECT sub1.area_id,area.area, sub1.store_id, sub1.name, sub1.sales
        FROM(SELECT wholestore.area_id, wholestore.store_id AS store_id,restareainfo.name AS name, sales, restareainfo.id as ra_id FROM wholestore 
              INNER JOIN  restareainfo ON wholestore.ra_id=restareainfo.id)sub1 INNER JOIN area ON sub1.area_id=area.id ORDER BY sub1.ra_id)sub2 INNER JOIN storeinfo ON storeinfo.id = sub2.store_id)sub3
              GROUP BY name, store_name WITH ROLLUP";
              $res = mysqli_query($conn, $sql);
              if(mysqli_num_rows($res) > 0){
                  echo "<table border=1><tr><th>area</th><th>Name</th><th>store_name</th><th>sales</th></tr>";
                  while($row = $res->fetch_assoc()) {
                    echo "<tr><td>".$row["area"]."</td><td>".$row["name"]."</td><td>".$row["store_name"]."</td><td>".$row["SUM(sales)"]."</td><tr>";
                  }
                  echo "</table>";
              } else {
                  echo "0 results";
              }
    }
    mysqli_close($conn);
?>
</body>
</html>


