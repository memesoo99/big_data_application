<html>
  <head><link rel="stylesheet" href="bitnami.css"/></head>
  <body>
    <p><a href="store-by-sales.php">매출 범위 별 가게 보려면 클릭</a></p>
    <?php
      include "connection.php";
      $sql = "SELECT w.id, ra.name, s.store_name, a.area, w.sales from WholeStore w
            join RestAreaInfo ra on w.ra_id=ra.id
            join StoreInfo s on w.store_id=s.id
            join Area a on w.area_id=a.id ORDER BY w.id";
      $res = mysqli_query($conn, $sql);
      if(mysqli_num_rows($res) > 0){
        echo "<table><tr><th>ID</th><th>Rest Area</th><th>Store Name</th><th>Area</th><th>sales</th></tr>";
        
        while($row = $res->fetch_assoc()) {?>
          <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["store_name"]; ?></td>
            <td><?php echo $row["area"]; ?></td>
            <td><?php echo $row["sales"]; ?></td>
        </tr>
        <?php }
        } else { echo "0 results";}
        mysqli_close($conn);
        ?>
        </table>
        <h3>매장별 휴게소 내 매출 순위표</h3>
        <?php
      include "connection.php";
      $sql = "SELECT w.id, ra.name, s.store_name, w.sales, (DENSE_RANK() OVER (PARTITION BY ra_id ORDER BY sales)) as ranking FROM wholestore w
          INNER JOIN restareainfo as ra on w.ra_id=ra.id
          INNER JOIN storeinfo as s on w.store_id=s.id";
      $res = mysqli_query($conn, $sql);
      if(mysqli_num_rows($res) > 0){
        echo "<table><tr><th>ID</th><th>Rest Area</th><th>Store Name</th><th>Sales</th><th>Ranking</th></tr>";
        
        while($row = $res->fetch_assoc()) {?>
          <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["store_name"]; ?></td>
            <td><?php echo $row["sales"]; ?></td>
            <td><?php echo $row["ranking"]; ?></td>
        </tr>
        <?php }
        } else { echo "0 results";}
        mysqli_close($conn);
        ?>
        </table>
  </body>
</html>
