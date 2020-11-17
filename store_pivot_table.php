<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="bitnami.css"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
  </head>

  <body>
  <button type="button" onclick="location.href='index.html' ">홈으로 이동</button>
  <button type="button" onclick="location.href='whole_store_list.php' ">뒤로가기</button>
      <p><h3>매장종류별 전국분포</h3></p>
      
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

  $sql = "SELECT area,
  sum(CASE WHEN store_type='한식' THEN cnt ELSE 0 END)AS 한식,
  sum(CASE WHEN store_type='카페' THEN cnt ELSE 0 END)AS 카페,
  sum(CASE WHEN store_type='분식' THEN cnt ELSE 0 END)AS 분식,
  sum(CASE WHEN store_type='중식' THEN cnt ELSE 0 END)AS 중식,
  SUM(CASE WHEN store_type='양식' THEN cnt ELSE 0 END)AS 양식,
  sum(CASE WHEN store_type='일식' THEN cnt ELSE 0 END)AS 일식,
  sum(CASE WHEN store_type='간식' THEN cnt ELSE 0 END)AS 간식,
  SUM(CASE WHEN store_type='편의점' THEN cnt ELSE 0 END)AS 편의점,
  SUM(CASE WHEN store_type='기타' THEN cnt ELSE 0 END) AS 기타
  FROM (SELECT ex2.area,d.store_type, COUNT(ex2.area) AS cnt,d.id FROM (SELECT ex1.area, c.store_type FROM (SELECT a.area_id, a.store_id, b.area FROM wholestore AS a JOIN area AS b ON a.area_id=b.id) ex1 JOIN StoreInfo as c ON c.id = ex1.store_id)ex2 JOIN storetype as d ON d.id= ex2.store_type GROUP BY ex2.area, d.store_type)sample
  GROUP BY area";

  $res = mysqli_query($conn, $sql);
          if(mysqli_num_rows($res) > 0){
              echo "<table border='1'><tr><th>area</th><th>한식</th><th>카페</th><th>분식</th><th>중식</th><th>양식</th><th>일식</th><th>간식</th><th>편의점</th><th>기타</th></tr>";
              
              while($row = mysqli_fetch_array($res)) {
                echo "<tr><td>".$row["area"]."</td><td>".$row["한식"]."</td><td>".$row["카페"]."</td>
                <td>".$row["분식"]."</td><td>".$row["중식"]."</td><td>".$row["양식"]."</td><td>".$row["일식"]."</td><td>".$row["간식"]."</td><td>".$row["편의점"]."</td><td>".$row["기타"]."</td></tr>";
              }
              echo "</table>";
          } else {
              echo "0 results";
          }
  mysqli_close($conn);
  ?>
  </body>
  </html>
