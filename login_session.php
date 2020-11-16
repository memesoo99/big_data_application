<!DOCTYPE html>
<meta charset="utf-8" />
<form method='post' action=''>
<table>
<tr>
	<td>관리자 암호를 입력하세요 :
	<td><input type='text' name='password' tabindex='1'/></td>
	<td rowspan='2'><input type='submit' tabindex='2' value='로그인' style='height:50px'/></td>
</tr>
</table>
</form>
<?php
session_start();
if(!isset($_POST['password'])) exit;
$admin_pw = $_POST['password'];


if($admin_pw!='1234') {
        echo "<script>alert('패스워드가 잘못되었습니다.');history.back();</script>";
        exit;
}
else{
session_start(); 
$_SESSION['admin_pw'] = $admin_pw;
echo "<p><a href='customer_correct.php'></a></p>";
}

?>
