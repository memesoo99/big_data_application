<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bitnami.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h3>Choose the id of the rest area to delete</h3>
        <table>
            <tr><th>ID</th><th>Name</th></tr>
        <form action="delete-rest-area.php" method="POST">
            <input type="hidden" name="new" value="1" />
            <?php
            include "connection.php";
            $display="SELECT id, name FROM RestAreaInfo";
            $res=mysqli_query($conn,$display) or die("invalid query");
            while($row=mysqli_fetch_array($res)){            
            ?>
            <tr>
                <td><input type="checkbox" name="checkbox[]" value="<?php echo $rows['id']; ?>"></td>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name'];?></td><?php }?></table>
        
            <input type="submit" name="delete" value="Delete"/>
            </form>
    </body>
</html>

<?php
    if(isset($_POST['delete'])){
        $checkbox = $_POST['checkbox'];
        for($i=0 ; $i < count($_POST['checkbox']) ; $i++){
        $del_id = $checkbox[$i];
        $sql = "DELETE FROM RestAreaInfo WHERE id='$del_id'";
        print $sql;
    }
        
    mysqli_close($conn);
    }
?>
