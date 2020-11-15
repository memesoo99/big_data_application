<html>
  <head></head>
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
    else { //하고싶은것 : wholestore 테이블에서 같은 휴게소 id 가진 애들의 매출 합 출력하기... 대체 어ㄸㅓㅎ게 하는 건데 ㅠㅠ
        $sql = "SELECT RestAreaInfo.* SUM(WholeStore.sales) from RestAreaInfo
        inner join Area where RestAreaInfo.area=Area.id
        inner join WholeStore on WholeStore.ra_id=RestAreaInfo.id
        GROUP BY WholeStore.ra_id";
        //$sql2 = "SELECT SUM(sales) from WholeStore GROUP BY ra_id";
        $res = mysqli_query($conn, $sql);
        //$res2 = musqli_query($conn, $sql2);
        if(mysqli_num_rows($res) > 0){
            echo "<table><tr><th>ID</th><th>Name</th><th>area</th></tr>";
            // output data of each row
            while($row = $res->fetch_assoc()) {
              echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["area"]."</td></tr>".$row['SUM(sales)'];
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