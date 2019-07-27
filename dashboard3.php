<?php
$cid=$_GET['cid'];
$connect=mysqli_connect('localhost:3306','root','','dream bricks');
 $query5="select * from `property` where cid=$cid";
 $result5=mysqli_query($connect,$query5);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>dashboard</title>
        <link rel="stylesheet" href="dashboard.css" type="text/css">
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
        <div id="dash-body">
            <div id="dash-body-first">
                <a href="dashboard1.php?cid=<?php echo $cid;?>">MY PROFILE</a>
                <a href="dashboard2.php?cid=<?php echo $cid;?>">FAVORITES</a>
                <a href="dashboard3.php?cid=<?php echo $cid;?>">POSTED PROPERTY</a>
                           <a href="indexpage.php">LOGOUT</a>
            </div>
            <div id="dash-body-secon" style="flex-direction:column;">

                  <?php
            while($row=mysqli_fetch_assoc($result5))
            {
                $pid=$row['pid'];
                $n = $row['name'];
                $a = $row['address'];
                $p = $row['details'];
                $c = $row['cost'];
                $pid =$row['pid'];
                
                $query1="select * from `image` where pid=$pid";
                $result1=mysqli_query($connect,$query1);
                
                echo '<a href="dash-land-view.php?cid='.$cid.'&pid='.$pid.'">';
                $row1=mysqli_fetch_assoc($result1);
                echo '<div id="display-land">
                <div id="display-land-first">
                    <img src="data:image/jpeg;base64,'.base64_encode($row1['img']).'" alt="image">
                </div>';
                echo '<div id="display-land-second">
                <p><b>Name of the property:</b>'.$n.'</p>';
                echo '<p><b>Address:</b><br>'.$a.'</p>';
                echo '<p><b>Property Details:</b><br>'.$p.'</p>';
                echo '<p><b>Price:</b><br>'.$c.'</p></a>';
                echo ' </div></div>';
            }
    
    ?>
              
            </div>
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