<html>
  <head>
    <head><link rel="stylesheet" href="bitnami.css"/></head>
  </head>
  <body>
    <button type="button" onclick="location.href='logout.php'">종료</button><br>
    <table border=1>
      <tr>
        <th>ID</th><th>Name</th><th>area</th><th>edit</th><th>delete</th>
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
              <td><a href="update-rest-area.php?id=<?php echo $row['id']; ?>">Edit</a></td>
              <td><a href="delete-rest-area.php?id=<?php echo $row['id']; ?>">Delete</a></td>
            </tr>
      <?php }
      } else { echo "0 results"; }

      mysqli_close($conn);
      ?>
</table>
</body>
</html>


