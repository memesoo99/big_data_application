<?php

include "connection.php";

$id = $_GET['id']; 
$sql = "DELETE from RestAreaInfo where id = '$id'";
$del = mysqli_query($conn,$sql);

if($del)
{
    mysqli_close($conn);
    header("location:rest-area-list.php"); 
    exit;	
}
else
{
    echo "Error deleting record"; 
}
?>