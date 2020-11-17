<?php
include "connection.php";
$id = $_GET['id'];
$res = mysqli_query($conn,"SELECT * from RestAreaInfo where RestAreaInfo.id='$id'"); 

$data = mysqli_fetch_array($res); 

if(isset($_POST['update'])) 
{
    $name = $_POST['name'];
    $area = $_POST['area'];
	
    $edit = mysqli_query($conn,"UPDATE RestAreaInfo set name='$name', area='$area' where id='$id'");
	
    if($edit)
    {
        mysqli_close($conn); 
        header("location:rest-area-list.php"); 
        exit;
    }
    else
    {
        echo mysqli_error();
    }    	
}
?>
<html>
    <body>
    <button type="button" onclick="location.href='index.html' ">홈으로 이동</button>
        <h3>Update Data</h3>

        <form method="POST">
        <input type="text" name="name" value="<?php echo $data['name'] ?>" placeholder="Enter Name" Required>
        <!--<input type="text" name="area" value="<?php //echo $data['area'] ?>" placeholder="Enter area num" Required>-->
        <select name="area" size=5 value="<?php echo $data['area']?>">
                        <option value="1">서울경기</option>
                        <option value="2">부산경상</option>
                        <option value="3">강원</option>
                        <option value="4">충청</option>
                        <option value="5">전라</option>
                    </select>
        <input type="submit" name="update" value="Update">
        </form>
    </body>
</form>
