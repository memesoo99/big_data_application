<html>
  <head>
    <head><link rel="stylesheet" href="bitnami.css"/></head>
  </head>
  <body>
    <p><a href="insert-rest-area.php">insert rest area</a>
    | <a href="delete-rest-area.php">delete rest area</a>
    | <a href="update-rest-area.php">update rest area info</a></p>
    <table>
      <tr>
        <th>ID</th><th>Name</th><th>area</th><th>sales</th>
      </tr>
    <?php
      include "connection.php";
      $sql="SELECT area.area, sub1.name ,sub1.sum, sub1.id
      FROM(SELECT wholestore.area_id, restareainfo.name AS name, SUM(sales) AS sum, restareainfo.id as id FROM wholestore 
      INNER JOIN  restareainfo ON wholestore.ra_id=restareainfo.id GROUP BY ra_id) sub1
      INNER JOIN area ON sub1.area_id=area.id ORDER BY sub1.id";
       
      $res = mysqli_query($conn, $sql);
      if(mysqli_num_rows($res) > 0){
        while($row = $res->fetch_assoc()) {?>
            <tr>
              <td><?php echo $row["id"];?></td>
              <td><?php echo $row["name"];?></td>
              <td><?php echo $row["area"];?></td>
              <td><?php echo $row['sum'];?></td>
              <td><a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a></td>
              <td><a href="delete.php?id=<?php echo $data['id']; ?>">Delete</a></td>
            </tr></table>
      <?php }
      } else { echo "0 results"; }
      mysqli_close($conn);
      ?>

</body>
</html>


