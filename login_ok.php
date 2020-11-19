<?php
if(!isset($_POST['admin_pwd'])) exit;
$admin_pwd = $_POST['admin_pwd'];
$user_id ='admin';
if($admin_pwd!= 'team05') {
        echo "<script>alert('패스워드가 잘못되었습니다.');history.back();</script>";
        exit;
}else{
    session_start();
$_SESSION['user_id'] = $user_id;
echo "<meta http-equiv='refresh' content='0;url=edit.php'>";
}

?>
