<?php 
$connect=mysqli_connect('localhost:3306','root','','dream bricks');
if(isset($_POST['send']))
{
$cid=$_GET['cid'];
$pid=$_GET['pid'];
$query="select * from `login users` where cid=$cid";
$result=mysqli_query($connect,$query);
$row=mysqli_fetch_assoc($result);

$buymail=$row['email'];
$username=$row['username'];

$sub="Mail From DREAM BRICKS";
$query="select * from `property` where pid=$pid";
$result=mysqli_query($connect,$query);
$row=mysqli_fetch_assoc($result);
$scid=$row['cid'];
$name=$row['name'];

$query="select * from `login users` where cid=$scid";
$result=mysqli_query($connect,$query);
$row=mysqli_fetch_assoc($result);
$rec=$row['email'];
    
$msg="The user with username:".$username." and gmail:".$buymail." is interested in your property ".$name;
mail($rec,$sub,$msg);
header('Location:buyerpage.php?cid='.$cid);
}
?>