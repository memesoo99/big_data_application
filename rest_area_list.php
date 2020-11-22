<html>
  <head>
    <head><link rel="stylesheet" href="bitnami.css"/></head>
  </head>
  <body>
    <button type="button" onclick="location.href='index.html' ">홈으로 이동</button>
    <div class="m20">
      <a href="rest_area_rollup.php">휴게소 매출 확인</a>
    </div>
    <table border=1>
      <tr>
          <th>ID</th><th>Name</th><th>area</th><th>go to store</th></th>
        </tr>
      <?php
        include "connection.php";
        $sql="SELECT ra.id, ra.name, area.area from restareainfo ra
        INNER JOIN area where ra.area=area.id ORDER BY ra.id";
        
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
          while($row = $res->fetch_assoc()) {?>
              <tr>
                <td><?php echo $row["id"];?></td>
                <td><?php echo $row["name"];?></td>
                <td><?php echo $row["area"];?></td>
                <td><a href="store_ranking.php?id=<?php echo $row['id']; ?>">go to store</a></td>
              </tr>
        <?php }
        } else { echo "0 results"; }

        mysqli_close($conn);
        ?>
  </table>
</body>
</html>


