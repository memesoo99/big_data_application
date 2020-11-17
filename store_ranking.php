<html>
  <head><link rel="stylesheet" href="bitnami.css"/></head>
  <body>
    <button type="button" onclick="location.href='index.html' ">홈으로 이동</button>
    <button type="button" onclick="location.href='rest_area_list.php' ">뒤로가기</button>
        <?php
      include "connection.php";
      $id = $_GET['id'];
      $sql = "SELECT w.id, ra.name, s.store_name, w.sales, (DENSE_RANK() OVER (PARTITION BY ra_id ORDER BY sales)) as ranking FROM wholestore w
          INNER JOIN restareainfo as ra on w.ra_id=ra.id
          INNER JOIN storeinfo as s on w.store_id=s.id WHERE w.ra_id='$id'";
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
