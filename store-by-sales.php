<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="bitnami.css"/>
    </head>
    <body>
        <h3>해당 구간의 가게 정보 보기 : 구간을 선택하세요</h3>
        <form action="" method="POST">
        <input type="hidden" name="new" value="1" />
            <select name="range-select" size=5>
                    <option value="0-20,000">0-20,000</option>
                    <option value="20,000-40,000">20,000-40,000</option>
                    <option value="40,000-60,000">40,000-60,000</option>
                    <option value="60,000-60,000">60,000-60,000</option>
                    <option value="more than 80,000">more than 80,000</option>
            </select>
            <input type="submit" value="enter">
        </form>
<?php
    include "connection.php";
    if(isset($_POST['new']) && $_POST['new']==1){
    $range=$_POST['range-select'];
    $sql="SELECT * FROM (SELECT sub1.srange, sub1.id, ra.name, s.store_name, sub1.sales
    FROM (SELECT id, ra_id, store_id, sales,
            (CASE 
        WHEN sales <= 20000 THEN '0-20,000'
        WHEN sales > 20000 AND sales <= 40000 THEN '20,000-40,000'
        WHEN sales > 40000 AND sales <= 60000 THEN '40,000-60,000'
        WHEN sales > 60000 AND sales <= 80000 THEN '60,000-80,000'
        WHEN sales > 80000 THEN 'more than 80,000'
          END) as srange
    FROM wholestore) as sub1
    inner join restareainfo as ra on sub1.ra_id=ra.id
    INNER JOIN storeinfo as s on sub1.store_id=s.id
    ORDER by sub1.srange) as sub2
    WHERE sub2.srange='$range' ORDER BY sub2.sales";
    $res=mysqli_query($conn,$sql);
    if($res){
        ?>
        <table>
            <tr><?php echo $range."구간의 매장 목록";?></tr>
            <tr>
                <th>ID</th><th>Rest Area</th><th>Store Name</th><th>Sales</th>
            </tr>
            <?php while($row = $res->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['store_name'];?></td>
                <td><?php echo $row['sales'];?></td>
            </tr><?php }?>
        </table><?php
    }
    else { echo mysqli_error($conn); }
    mysqli_close($conn);
}
?>