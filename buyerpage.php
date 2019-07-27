<?php 
$cid =$_GET['cid'];

$connect=mysqli_connect('localhost:3306','root','','dream bricks');
if(isset($_POST['submit']))
{
    $cost=$_POST['cost'];
    $bhk=$_POST['bhk'];
    $area=$_POST['area'];
    $pname=$_POST['pname'];
    
    if(empty($bhk) && empty($area) && empty($pname))
       $query = "select * from `property` where cost < $cost and eligibility=1";
    if(empty($bhk) && empty($area) && empty($cost))
        $query = "select * from `property` where eligibility=1 and name like '%$pname%' or address like '%$pname%'";
    if(empty($pname) && empty($bhk) && empty($cost))
        $query = "select * from `property` where area = $area and eligibility=1";
     if(empty($pname) && empty($area) && empty($cost))
        $query = "select * from `property` where bhk = $bhk and eligibility=1";
}
else
{
    $query="select * from `property` where eligibility=1";
}
$result=mysqli_query($connect,$query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>buyer page</title>
        <link rel="stylesheet" href="style2c.css">
    </head>
    <body>
       <div class="nav">
            <div class="hang-left">
                <a href="dashboard1.php?cid=<?php echo $cid;?>"><img src="dash.png" alt="dehaze"></a>
                <a href="buyerpage.php?cid=<?php echo $cid;?>">DREAM BRICKS</a>
            </div>
            <div class="hang-right">
               <a href="buyerpage.php?cid=<?php echo $cid;?>">HOME</a>
                <a href="landregister.php?cid=<?php echo $cid;?>"><p>POST PROPERTY</p></a>
            </div>
        </div>
        
        <form action="buyerpage.php?cid=<?php echo $cid;?>" class="filter" method="post">
            <div>
                <input type="number" placeholder="Price" name="cost">
                <input type="number" placeholder="BHK" name="bhk">
                <input type="number" placeholder="Area" name="area">
                <input type="text" placeholder="Locality/Property Name" name="pname">
                <button type="submit" name="submit">SEARCH</button>
            </div>
        </form>
        <div class="display-land-wrapper">
           
           <?php
            $i=0;
            $r=mysqli_num_rows($result);
            if($r==0)
                echo '<p>Search result not found</p>';
            else{
            while($row=mysqli_fetch_assoc($result))
            {
                $n = $row['name'];
                $a = $row['address'];
                $p = $row['details'];
                $c = $row['cost'];
                $pid =$row['pid'];
                
                $query1="select * from `image` where pid=$pid";
                $result1=mysqli_query($connect,$query1);
                
              
                $query2="select * from `favorites` where cid=$cid and pid=$pid";
                $result2=mysqli_query($connect,$query2);
                $row2=mysqli_fetch_assoc($result2);
                
                    if($row2['pid']==$pid)
                    {
                        $scr22="dfav.png";
                        $fav=1;
                    }
                    else
                    {
                         $scr22="fav.png";
                        $fav=0;
                    }
                
                if(mysqli_num_rows($result2)==0)
                {
                     $scr22="fav.png";
                        $fav=0;
                }
                
                 
                echo '<a href="landview.php?cid='.$cid.'&pid='.$pid.'&fav='.$fav.'">';
                $row1=mysqli_fetch_assoc($result1);
                echo '<div id="display-land">
                <div>
                    <img src="data:image/jpeg;base64,'.base64_encode($row1['img']).'" alt="image">
                </div>';
                echo '<div id="display-land-second">
                <p><b>Name of the property:</b>'.$n.'</p>';
                echo '<img src="'.$scr22.'" alt="favorite icon" class="tb-img">';
                echo '<p><b>Address:</b><br>'.$a.'</p>';
                echo '<p><b>Property Details:</b><br>'.$p.'</p>';
                echo '<p><b>Price:</b><br>'.$c.'</p></a>';
                echo ' </div></div>';
              
            }
            }
            ?>

        </div>
    </body>
    <script>
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
</script>
</html>
