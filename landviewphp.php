<?php
$cid=$_GET['cid'];
$pid=$_GET['pid'];
$fav=$_GET['fav'];
$connect=mysqli_connect('localhost:3306','root','','dream bricks');

if(isset($_POST['add']))
{
    $query2="insert into `favorites` values($cid,$pid)";
    $result2=mysqli_query($connect,$query2);
    header('Location:landview.php?cid='.$cid.'&pid='.$pid.'&fav=1');
}
else if(isset($_POST['remove']))
{
    $query2="delete from `favorites` where cid=$cid and pid=$pid";
    $result2=mysqli_query($connect,$query2);
    header('Location:landview.php?cid='.$cid.'&pid='.$pid.'&fav=0');
}
?>