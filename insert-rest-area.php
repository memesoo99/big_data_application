
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div><h3>휴게소 정보 추가하기</h3></p></div>
        <form action="" method="POST">
            <input type="hidden" name="new" value="1" />
            휴게소 이름: <input type="text" name="name"/><br><br>
            지역을 선택하세요<br>
            <select name="area" size=5>
                <option value="1">서울경기</option>
                <option value="2">부산경상</option>
                <option value="3">강원</option>
                <option value="4">충청</option>
                <option value="5">전라</option>
            </select>
            <input type="submit" value="추가하기"><br>
        </form>
    </body>
</html>
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
        if(isset($_POST['new']) && $_POST['new']==1){
            $name=$_POST["name"];
            $area=$_POST["area"];
            $sql="INSERT INTO RestAreaInfo(name, area) VALUES ('$name',$area)";
            
            if (mysqli_query($conn,$sql)) {
                echo "New record inserted successfully";
            } else {
                echo "Error inserting database: " . mysqli_error($conn);
            }
            
            mysqli_close($conn);
        }
    }
?>