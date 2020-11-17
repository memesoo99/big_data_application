<html>
  <head><link rel="stylesheet" href="bitnami.css"/></head>
  <body>
    <button type="button" onclick="location.href='index.html' ">홈으로 이동</button>
    <div class="m20">
      <a href="store_by_sales.php">매출 범위 별 매장 확인</a> | 
      <a href="store_pivot_table.php">매장종류별 전국 분포 </a>
    </div>
    <?php
      include "connection.php";
      $sql = "SELECT w.id, ra.name, s.store_name, a.area, w.sales from WholeStore w
            join RestAreaInfo ra on w.ra_id=ra.id
            join StoreInfo s on w.store_id=s.id
            join Area a on w.area_id=a.id ORDER BY w.id";
      $res = mysqli_query($conn, $sql);
      if(mysqli_num_rows($res) > 0){?>
    <table border=1>
      <tr>
        <th>ID</th><th>Rest Area</th><th>Store Name</th><th>Area</th><th>sales</th>
      </tr>
      <?php
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
  </body>
</html>
