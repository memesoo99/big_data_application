<?php
session_start();
if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}


?>
