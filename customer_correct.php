<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="bitnami.css"/>
    </head>
    <body>
        <div>
            <span style="font-size:20px;">고객정보 수정하기</span>
            <button type="button" onclick="location.href='logout.php'">종료</button>
        </div>
        *** 유의사항: 본 페이지는 엉터리값으로 입력된 항을 제거해 조사의 정확도를 높이기 위해 제공되는 페이지이다.<br>
        임의로 데이터를 수정하거나 삭제하지 말것!! <br><br>

        
        <br>
        <form action="" method="POST">
            <input type="hidden" name="new" value="1">
            <h4>[ 삭제 ]</h4>
            <table>
                <tr><td>id  </td><td><input type="number" name="id"  /></td>
                <td><input type="submit" value="삭제"></td></tr>
            </table><br><br>
        </form>
        
        <?php
        include "connection.php";
      
        if(isset($_POST['new']) && $_POST['new']==1){
            $sql = "DELETE FROM CustomerInfo WHERE id=".$_POST['id'].";";
            $res = mysqli_query($conn, $sql);

            if($res){
                echo "deleted successfully";
            } else {
                echo "Error deleting database: " . mysqli_error($conn);
            }
        }
    
    mysqli_close($conn);
    ?>
        <form action="" method="POST">
        <input type="hidden" name="new2" value="1">
            <h4>[ 수정 ]</h4>
            <table>
                <tr><td>id </td><td><input type="number" name="id"  /></td></tr>
                <tr><td>나이 </td><td><input type="number" name="age"></td></tr>
                <tr><td>성별 </td><td> 
                <label><input type="radio" name="sex" value="1"> 남성</label>
                <label><input type="radio" name="sex" value="2"> 여성</label></td></tr>
                <tr><td>이름 </td><td><input type="text" name="customer_name"></td></tr>
                <tr><td>음식종류 </td><td><br><br>
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
                </select> <br><br></td><td>
                <input type="submit" value="수정"><br></td></tr>
            </table>
        </form>

        <?php
        include "connection.php";
            if(isset($_POST['new2']) && $_POST['new2']==1){
                $id=$_POST["id"];
                $age=$_POST["age"];
                $store_type=$_POST["customer_combobox"];
                $sex=$_POST["sex"];
                $name=$_POST["customer_name"];
    
                $sql="UPDATE CustomerInfo SET age=".$age.", store_type=".$store_type.", sex=".$sex.", customer_name='".$name."' WHERE id=".$id.";";
    
                if (mysqli_query($conn,$sql)) {
                    echo "record updates successfully";
                } else {
                    echo "Error updating database: " . mysqli_error($conn);
                }    
            }
                
            
        
        $sql = "SELECT * FROM CustomerInfo";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0){
                echo "<table border=1><tr><th>ID</th><th>age</th><th>store_type</th><th> sex</th><th>Customer Name</th></tr>";
                
                while($row = $res->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["age"]."</td><td>".$row["store_type"]."</td><td>".$row["sex"]."</td><td>".$row["customer_name"]."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
        
        mysqli_close($conn);
    ?>
    </body>
</html>

