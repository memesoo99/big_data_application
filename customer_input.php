<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>휴게소 이용객 조사</title>
</head>
<body style="background-color: bisque;"> 
<button type="button" onclick="location.href='index.html' ">홈으로 이동</button>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>휴게소 이용객 조사</title>
</head>
<body style="background-color: bisque;"> 
    <p><h3>소비자 조사</h3></p>
    <form action='' method="POST">
        <input type="hidden" name="new" value="1">
        나이 : <input type="text" name="age"><br><br>
        성별 : 
        <label><input type="radio" name="sex" value="1"> 남성</label>
        <label><input type="radio" name="sex" value="2"> 여성</label><br><br>
        이름 : <input type="text" name="customer_name"><br><br>
        음식종류 <br><br>
        <select name="customer_combobox" size=5>
            <option value="1">한식</option>
            <option value="2">카페</option>
            <option value="3">분식</option>
            <option value="4">중식</option>
            <option value="5">양식</option>
            <option value="6">일식</option>
            <option value="7">간식</option>
            <option value="8">편의점</option>
            <option value="9">기타</option>   
        </select> <br><br>
        <input type ="submit" value="추가하기">
    </form>
       
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
    else{
        if(isset($_POST['new']) && $_POST['new']==1){
            $data_age = $_POST['age'];
            $data_combobox = $_POST['customer_combobox'];
            $data_sex = $_POST['sex'];
            $data_name = $_POST['customer_name'];
            $sql = "SELECT * FROM customerinfo INNER JOIN storetype ON customerinfo.store_type = storetype.id";
            $res=mysqli_query($conn,$sql);
    
            $sql = "INSERT INTO CustomerInfo(age, store_type,sex,customer_name) 
            VALUES (".$data_age.",".$data_combobox.",".$data_sex.",'".$data_name."')";
            $res=mysqli_query($conn,$sql);
            if($res===TRUE){
                echo "감사합니다*^^*";
            }else{
                echo "Error inserting database: " . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
    ?>