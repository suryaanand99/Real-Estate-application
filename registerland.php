<?php
$connect=mysqli_connect('localhost:3306','root','','dream bricks');


if(isset($_POST['update']))
{
    $cid=$_POST['cid'];
    $name=$_POST['propertyname'];
    $type=$_POST['type'];
    $pay=$_POST['pay'];
    $address=$_POST['address'];
    $area=$_POST['area'];
    $bhk=$_POST['bhk'];
    $location=$_POST['location'];
    $details=$_POST['details'];
    $cost=$_POST['cost'];
    $pid=$_POST['pid'];
    
    $query="update `property` set type='$type',name='$name',address='$address',pay='$pay',area='$area',bhk='$bhk',
    location='$location',details='$details',cost='$cost' where pid=$pid";
    $result=mysqli_query($connect,$query);
    
     mysqli_select_db($connect,"multiple");
    $filename = $_FILES['img']['name'];
    $tmpname = $_FILES['img']['tmp_name'];
    $filetype = $_FILES['img']['type'];
    $query="delete from `image` where pid=$pid";
    mysqli_query($connect,$query);
    for($i=0;$i<=count($tmpname)-1;$i++)
    {
        $name=addslashes($filename[$i]);
        $tmp=addslashes(file_get_contents($tmpname[$i]));
        $query = "insert into `image`(pid,name,img) values($pid,'$name','$tmp')";
        mysqli_query($connect,$query);
    }
    
    header("Location:dashboard3.php?cid=".$cid);
}
?>
