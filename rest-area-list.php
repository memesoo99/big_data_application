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
       // $sql="SELECT restareainfo.name AS name, SUM(sales) AS total_sale FROM wholestore INNER JOIN restareainfo ON wholestore.ra_id=restareainfo.id GROUP BY ra_id" 
      //위에꺼 해보삼 근데 원하는게 이게 맞는지 몰겟 ㅜ 위에껀 휴게소이름이랑 매출만 나오는거고
      //아래꺼는 지역이름이랑 휴게소이름 매출나오는거
      //$sql="SELECT area.area, sub1.name ,sub1.total_sale FROM(SELECT wholestore.area_id, restareainfo.name AS name, SUM(sales) AS total_sale FROM wholestore INNER JOIN  restareainfo ON wholestore.ra_id=restareainfo.id GROUP BY ra_id) sub1 INNER JOIN area ON sub1.area_id=area.id";
        $sqla = "SELECT RestAreaInfo.* SUM(WholeStore.sales) from RestAreaInfo
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