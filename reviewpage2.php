<?php 
$pid=$_GET['pid'];
$connect=mysqli_connect('localhost:3306','root','','dream bricks');

if(isset($_POST['eligible']))
{
    $review=$_POST['review'];
    $query="update `property` set eligibility=1,review='$review' where pid=$pid";
    $result=mysqli_query($connect,$query);
    header("Location:reviewpage1.php");
}
elseif(isset($_POST['noteligible']))
{
    
    $review=$_POST['review'];
    $query="update `property` set eligibility=0,review='$review' where pid=$pid";
    $result=mysqli_query($connect,$query);
    header("Location:reviewpage1.php");
}

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
                <a><img src="" alt=""></a>
                <a href="reviewpage1.php">DREAM BRICKS</a>
            </div>
            <div class="hang-right">
               <a href="reviewpage1.php">HOME</a>
               <a href="indexpage.php">LOG OUT</a>
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
                     
                     echo '<p><b>NAME OF THE PROPERTY:</b>   '.$name.'</p>';
                     echo '<p><b>DESCRIPTION:</b><br>'.$details.'</p>';
                     echo '<p><b>ADDRESS:</b><br>'.$address.'</p>';
                     ?>
                    
                 </div>
                 <div>
                     <?php 
                  
                        echo '</form>';
                        echo '<p><b>AREA:</b><br>'.$area.'  sq.fts</p>';
                        echo '<p><b>COST:</b><br>Rs.'.$cost.'  onwards</p>';
                        echo '<p><b>BHK:</b><br>'.$bhk.'</p>';
                     ?>
                 </div>
             </div>
             <div>
                <?php 
                
                echo '<form method="post" action="reviewpage2.php?pid='.$pid.'">
                <textarea cols="30" rows="6" style="margin-bottom:5%" name="review">'.$review.'</textarea><br>
                <button type="submit" name="eligible">ELIGIBLE</button>
                <button type="submit" name="noteligible">NOT ELIGIBLE</button>
                </form>';
              
                 
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