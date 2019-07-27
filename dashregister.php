<?php 
$cid=$_GET['cid'];
$pid=$_GET['pid'];
$connect=mysqli_connect('localhost:3306','root','','dream bricks');

if(isset($_POST['delete']))
{
    $query="delete from `image` where pid=$pid";
    mysqli_query($connect,$query);
    $query="delete from `property` where pid=$pid";
    mysqli_query($connect,$query);
    header('Location:dashboard3.php?cid='.$cid);
}
$query="select * from `property` where pid=$pid";
$result=mysqli_query($connect,$query);
$row=mysqli_fetch_assoc($result);
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
        <form action="registerland.php" id="entry-form" method="post" enctype="multipart/form-data">
           <div id="wrapper">
               <div id="first-division">
               <input type="hidden" value="<?php echo $cid;?>" name="cid">
                <input type="hidden" value="<?php echo $pid;?>" name="pid">
               <div>
                    <label for="">Name of the property</label><br>
                    <input type="text" name="propertyname" required value="<?php echo $row['name'];?>">
               </div>
               <div>
                    <label for="">Address</label><br>
                    <textarea name="address" id="" cols="30" rows="6" required><?php echo $row['address']?></textarea>
               </div>
               <div>
                    <label for="">Description</label><br>
                   <textarea name="details" id="" cols="30" rows="6" required><?php echo $row['details']?></textarea>
               </div>
               <div>
                    <label for="">Price</label><br>
                    <input type="number" name="cost" required value="<?php echo $row['cost'];?>">
               </div>
               <div>
                    <label for="">Area</label><br>
                    <input type="number" placeholder="in sq.ft" name="area" required value="<?php echo $row['area'];?>">
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
                    <input type="number" name="bhk" required value="<?php echo $row['bhk'];?>">
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
                    <input type="text" name="location" required value="<?php echo $row['location'];?>">
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
          <button type="submit" class="content" name="update">UPDATE</button>
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