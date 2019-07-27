<?php 

$connect=mysqli_connect('localhost:3306','root','','dream bricks');
if(isset($_POST['submit']))
{
    $cost=$_POST['cost'];
    $bhk=$_POST['bhk'];
    $area=$_POST['area'];
    $pname=$_POST['pname'];
    
    if(empty($bhk) && empty($area) && empty($pname))
       $query = "select * from `property` where cost < $cost and eligibility=0";
    if(empty($bhk) && empty($area) && empty($cost))
        $query = "select * from `property` where eligibility=0 and name like '%$pname%' or address like '%$pname%'";
    if(empty($pname) && empty($bhk) && empty($cost))
        $query = "select * from `property` where area = $area and eligibility=0";
     if(empty($pname) && empty($area) && empty($cost))
        $query = "select * from `property` where bhk = $bhk and eligibility=0";
}
else
{
    $query="select * from `property` where eligibility=0";
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
                <a><img src="" alt=""></a>
                <a href="reviewpage1.php">DREAM BRICKS</a>
            </div>
            <div class="hang-right">
               <a href="reviewpage1.php">HOME</a>
               <a href="indexpage.php">LOG OUT</a>
            </div>
        </div>
        
        <form action="reviewpage1.php" class="filter" method="post">
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
                
                 
                echo '<a href="reviewpage2.php?pid='.$pid.'">';
                $row1=mysqli_fetch_assoc($result1);
                echo '<div id="display-land">
                <div>
                    <img src="data:image/jpeg;base64,'.base64_encode($row1['img']).'" alt="image">
                </div>';
                echo '<div id="display-land-second">
                <p><b>Name of the property:</b>'.$n.'</p>';
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