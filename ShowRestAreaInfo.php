<html>
  <head></head>
  <body>
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
        $sql = "SELECT * from RestAreaInfo join Area a where RestAreaInfo.area=a.id";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            echo "<table><tr><th>ID</th><th>Name</th><th>area</th></tr>";
            // output data of each row
            while($row = $res->fetch_assoc()) {
              echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["area"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }
    mysqli_close($conn);
?>
<a href="RestArea_insert.html">휴게소 정보 추가하기</a>
</body>
</html>