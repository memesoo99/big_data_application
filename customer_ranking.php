<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: bisque;">
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

while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    printf("store_type:%s, average age: %d<br>\n",$row["store_type"], $row["AVG(customerinfo.age)"]);
}

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
    $sql = "SELECT sub1.store_type, COUNT(sub1.id) FROM (SELECT storetype.store_type, storetype.id, age FROM customerinfo INNER JOIN storetype ON customerinfo.store_type = storetype.id 
    WHERE (age BETWEEN {$bottom} AND {$top}))sub1 GROUP BY sub1.store_type";
    $res = mysqli_query($conn,$sql);
    $i=1;
    printf("<연령 %d ~ %d세가 가장 선호하는 휴게소 음식><br>\n",$bottom, $top);
    while($row = mysqli_fetch_array($res)){
      
      printf("%d순위 : %s<br>\n",$i, $row["store_type"]);
      $i = $i + 1;

  }
    
    }
  }
//연령별 선호
mysqli_close($conn);
?>