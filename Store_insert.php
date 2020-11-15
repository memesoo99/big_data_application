<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div><h3>Insert store information</h3></p></div>
        <form action="" method="POST">
           <input type="hidden" name="new" value="1" />
            <table>
                <tr>
                    <td>Store name</td><td><input type="text" name="name"/></td>
                </tr>
                <tr>
                    <td>store type</td><td>
                        <select name="store-type" size=5>
                            <option value="1">한식</option>
                            <option value="2">카페</option>
                            <option value="3">분식</option>
                            <option value="4">중식</option>
                            <option value="5">양식</option>
                            <option value="6">일식</option>
                            <option value="7">간식</option>
                            <option value="8">편의점</option>
                            <option value="9">기타</option>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="submit" value="add"><br>
        </form>
    </body>
</html>
<?php
    include "connection.php";
    if(isset($_POST['new']) && $_POST['new']==1){
        $name=$_POST["name"];
        $type=$_POST["store-type"];
        $sql="INSERT INTO RestAreaInfo(store_name, store_type) VALUES ('$name',$type)";
        
        if (mysqli_query($conn,$sql)) {
            echo "New record inserted successfully";
        } else {
            echo "Error inserting database: " . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }
    
?>