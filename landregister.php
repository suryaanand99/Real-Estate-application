<?php 
$cid=$_GET['cid'];

$connect=mysqli_connect('localhost:3306','root','','dream bricks');

if(isset($_POST['submit']))
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
    
     $query = "select * from `property` where type='$type' and name='$name' and address='$address' and pay='$pay' and area='$area' and bhk='$bhk' and location='$location' and details='$details' and cost=$cost";
    $result=mysqli_query($connect,$query);
    $f=mysqli_num_rows($result);
    if($f==0)
    {
        $query ="insert into `property`(type,name,pay,address,area,cid,bhk,location,details,cost,eligibility) values('$type','$name','$pay','$address','$area','$cid','$bhk','$location','$details','$cost',0)";
    $result = mysqli_query($connect,$query);
    
    $query = "select * from `property` where type='$type' and name='$name' and address='$address' and pay='$pay' and area='$area' and bhk='$bhk' and location='$location' and details='$details' and cost='$cost'";
    $result=mysqli_query($connect,$query);
    $row=mysqli_fetch_assoc($result);
    $pid=$row['pid'];
    mysqli_select_db($connect,"multiple");
    $filename = $_FILES['img']['name'];
    $tmpname = $_FILES['img']['tmp_name'];
    $filetype = $_FILES['img']['type'];
    for($i=0;$i<=count($tmpname)-1;$i++)
    {
        $name=addslashes($filename[$i]);
        $tmp=addslashes(file_get_contents($tmpname[$i]));
        $query = "insert into `image`(pid,name,img) values($pid,'$name','$tmp')";
        mysqli_query($connect,$query);
    }
    }
    else
        echo '<script>alert("record exists")</script>';
   
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>register page</title>
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
        <form action="landregister.php?cid=<?php echo $cid?>" id="entry-form" method="post" enctype="multipart/form-data">
           <div id="wrapper">
               <div id="first-division">
               <input type="hidden" value="<?php echo $cid;?>" name="cid">
               <div>
                    <label for="">Name of the property</label><br>
                    <input type="text" name="propertyname" required>
               </div>
               <div>
                    <label for="">Address</label><br>
                    <textarea name="address" id="" cols="30" rows="6" required></textarea>
               </div>
               <div>
                    <label for="">Description</label><br>
                   <textarea name="details" id="" cols="30" rows="6" required></textarea>
               </div>
               <div>
                    <label for="">Price</label><br>
                    <input type="number" name="cost" required>
               </div>
               <div>
                    <label for="">Area</label><br>
                    <input type="number" placeholder="in sq.ft" name="area" required>
               </div>
               <div>
                    <label for="">Ads</label><br>
                    <select name="pay" required>
                        <option value="free">Free</option>
                        <option value="pay">Pay</option>
                    </select>
               </div>
               <div>
                    <label for="">BHK</label><br>
                    <input type="number" name="bhk" required>
               </div>
               <a href="terms%20and%20conditions.html"><input type="checkbox" checked required name="terms">Terms and Conditions</a><br>
           </div> 
           <div id="second-division">
              <div class="photo-gallery">
                <img src="LOGINIMG.jpg" alt="" id="output">
                <img src="LOGINIMG.jpg" alt="" id="output1">
                <img src="LOGINIMG.jpg" alt="" id="output2">
                <img src="LOGINIMG.jpg" alt="" id="output3">
              </div> 
              <input type="file" name="img[]" accept="image/*" multiple="multiple" id="gallery-photo-add" onchange="imagesPreview()" required>
              
                <div>
                    <label for="">Location URL</label><br>
                    <input type="text" name="location" required>
              </div>
               <div>
                    <label for="">Type</label><br>
                    <select name="type" required>
                        <option value="villa">Villa</option>
                        <option value="apartments">Apartments</option>
                        <option value="flats">Flats</option>
                        <option value="house">House</option>
                    </select>
              </div>
           </div>
           </div>
          <button type="submit" class="content" name="submit">POST</button>
        </form>
    </body>
        <script>
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
</script>
</html>


<script type="text/javascript">
    var imagesPreview = function() {
        
                var reader = new FileReader();

                reader.onload = function(event) {
                    var temp=document.getElementById("output");
                    temp.src=event.target.result;
                   
                }

                reader.readAsDataURL(event.target.files[0]);
        var reader = new FileReader();
         reader.onload = function(event) {
                    var temp=document.getElementById("output1");
                    temp.src=event.target.result;
                   
                }
                reader.readAsDataURL(event.target.files[1]);
         var reader = new FileReader();
         reader.onload = function(event) {
                    var temp=document.getElementById("output2");
                    temp.src=event.target.result;
                   
                }
                reader.readAsDataURL(event.target.files[2]);
        var reader = new FileReader();
         reader.onload = function(event) {
                    var temp=document.getElementById("output3");
                    temp.src=event.target.result;
                   
                }
                reader.readAsDataURL(event.target.files[3]);

    };

</script>