<?php

include "connection.php";

$id = $_GET['id']; 
$sql = "DELETE from RestAreaInfo where id = '$id'";
$del = mysqli_query($conn,$sql);

if($del)
{
    mysqli_close($conn);
    header("location:rest_area_edit.php"); 
    exit;	
}
else
{
    echo mysqli_error($conn);
    echo "Error deleting record"; 
}
?>