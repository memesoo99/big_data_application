<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: bisque;">
    <button type="button" onclick="location.href='index.html' ">홈으로 이동</button>
    <p><h3>매장종류별 선호연령</h3></p>
    
</body>
</html>
<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, "myDB");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//$sql = "SELECT * FROM customerinfo INNER JOIN storetype ON customerinfo.store_type = storetype.id";

$sql = "SELECT storetype.store_type, AVG(customerinfo.age) FROM customerinfo INNER JOIN storetype ON customerinfo.store_type = storetype.id GROUP BY store_type";

$res = mysqli_query($conn,$sql);
echo "<table border='1'><tr><th>음식종류</th><th>평균나이</th></tr>";
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    echo "<tr><td>".$row["store_type"]."</td><td>".$row["AVG(customerinfo.age)"]."</td></tr>";
}
echo"</table>";
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: bisque;">
    <p><h3>연령별 선호 매장 순위 top3</h3></p>
    <form action='' method="POST">
        <input type="hidden" name="new" value="1">
            나이대 <br>
        <select name="age" size=5>
            <option value="1">10대미만</option>
            <option value="2">10대</option>
            <option value="3">20대</option>
            <option value="4">30대</option>
            <option value="5">40대</option>
            <option value="6">50대</option>
            <option value="7">60대</option>
            <option value="8">70대</option>
            <option value="9">80대이상</option>   
        </select> <br><br>
        <input type ="submit" value="결과보기">
    </form>
    
</body>
</html>

<?php

 // Create connection
 $conn = mysqli_connect($servername, $username, $password, "myDB");
 // Check connection
 if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
 }
 else{
    if(isset($_POST['new']) && $_POST['new']==1){
    $data_age = $_POST['age'];
    $bottom = ($data_age-1)*10;
    $top = ($data_age)*10;
    $sql = "SELECT sub1.store_type, COUNT(sub1.id), RANK() OVER (ORDER BY COUNT(sub1.id) DESC) 
    FROM (SELECT storetype.store_type, storetype.id, age FROM customerinfo INNER JOIN storetype ON customerinfo.store_type = storetype.id 
        WHERE (age BETWEEN {$bottom} AND {$top}))sub1 GROUP BY sub1.store_type ORDER BY RANK() OVER (ORDER BY COUNT(sub1.id) DESC)";
    $res = mysqli_query($conn,$sql);
    $i=1;
    printf("<연령 %d ~ %d세가 가장 선호하는 휴게소 음식><br>\n",$bottom, $top);
    echo "<table border='1'>";
    while($row = mysqli_fetch_array($res)){
        echo "<tr><td>".$i."순위</td><td>".$row["store_type"]."</td></tr>";
      $i = $i + 1;

  }
  echo"</table>";
    
    }
  }
//연령별 선호
mysqli_close($conn);
?>