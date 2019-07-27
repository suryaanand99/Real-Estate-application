<?php 
$cid=$_GET['cid'];
$pid=$_GET['pid'];
$connect=mysqli_connect('localhost:3306','root','','dream bricks');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>landview page</title>
        <link rel="stylesheet" href="style2c.css" type="text/css">
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
        
        <div id="view-wrapper">
            <div class="view-photo-gallery">
               <?php 
                   $query="select * from `image` where pid=$pid";
                   $result=mysqli_query($connect,$query); 
                    $i=1;
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $i=$i+1;
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'"alt="image">';
                    }
                    while($i<5)
                    {
                        echo '<a href="indeximage.jpg" target="
                        _blank"><img src="indeximage.jpg" alt="image" ></a>';
                        $i=$i+1;
                    }
                    echo '<img src="indeximage.jpg"alt="image">';
                ?>
             </div>
             
             <div id="view-wrapper-second">
                 <div>
                   
                    <?php 
                     $query="select * from `property` where pid=$pid";
                     $result=mysqli_query($connect,$query);
                     $row=mysqli_fetch_assoc($result);
                     $name = $row['name'];
                     $address = $row['address'];
                     $details = $row['details'];
                     $cost = $row['cost'];
                     $area = $row['area'];
                     $bhk = $row['bhk'];
                     $review=$row['review'];
                     $eligibility=$row['eligibility'];
                     
                     if($eligibility!=1)
                     {
                         $z="reject.jpg";
                         echo '<script>
                         document.querySelector("#view-wrapper").style.backgroundImage="URL('.$z.')";
                         </script>';
                     }
                     
                     echo '<p><b>NAME OF THE PROPERTY:</b>   '.$name.'</p>';
                     echo '<p><b>DESCRIPTION:</b><br>'.$details.'</p>';
                     echo '<p><b>ADDRESS:</b><br>'.$address.'</p>';
                     ?>
                    
                 </div>
                 <div>
                     <?php 
                        echo '<p><b>AREA:</b><br>'.$area.'  sq.fts</p>';
                        echo '<p><b>COST:</b><br>Rs.'.$cost.'  onwards</p>';
                        echo '<p><b>BHK:</b><br>'.$bhk.'</p>';
                     ?>
                 </div>
             </div>
             <div>
                <?php 
                 if($eligibility!=1)
                {
                 echo '<p><b>REVIEW TEAM: </b>'.$review.'</p>';
                echo '<form method="post" action="dashregister.php?cid='.$cid.'&pid='.$pid.'">
                <button type="submit" name="edit">EDIT</button>
                <button type="submit" name="delete">DELETE</button>
                </form>';
                     
                }
                 elseif($eligibility==1)
                 {
                echo '<form method="post" action="dashregister.php?cid='.$cid.'&pid='.$pid.'">
                <button type="submit" name="delete">DELETE</button>
                </form>';
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