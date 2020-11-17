<html>
  <head>
    <head><link rel="stylesheet" href="bitnami.css"/></head>
  </head>
  <body>
  <button type="button" onclick="location.href='index.html' ">홈으로 이동</button>
    <table border=1>

      <?php 
      include "connection.php";

      $sql="SELECT area, name,store_name, SUM(sales) FROM(SELECT 
        area, name, store_name,sales
        FROM(SELECT sub1.area_id,area.area, sub1.store_id, sub1.name, sub1.sales
        FROM(SELECT wholestore.area_id, wholestore.store_id AS store_id,restareainfo.name AS name, sales, restareainfo.id as ra_id FROM wholestore 
              INNER JOIN  restareainfo ON wholestore.ra_id=restareainfo.id)sub1 INNER JOIN area ON sub1.area_id=area.id ORDER BY sub1.ra_id)sub2 INNER JOIN storeinfo ON storeinfo.id = sub2.store_id)sub3
              GROUP BY name, store_name WITH ROLLUP";
      $res = mysqli_query($conn, $sql);
      if(mysqli_num_rows($res) > 0){
          echo "<tr><th>area</th><th>Name</th><th>store_name</th><th>sales</th></tr>";
          while($row = $res->fetch_assoc()) {
            echo "<tr><td>".$row["area"]."</td><td>".$row["name"]."</td><td>".$row["store_name"]."</td><td>".$row["SUM(sales)"]."</td><tr>";
          }
          echo "</table>";
      } else {
          echo "0 results";
      }
      
      mysqli_close($conn);
      ?>
</table>
</body>
</html>


