<?php
$cid=$_GET['cid'];
$connect=mysqli_connect('localhost:3306','root','','dream bricks');
$query="select * from `login users` where cid=$cid";
$result=mysqli_query($connect,$query);
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];
    $terms = $_POST['terms']; 
    if(!strcmp($password,$conpassword))
    {
        
        $query1="select * from `login users`";
        $result2= mysqli_query($connect,$query1);
        while($row2=mysqli_fetch_assoc($result2))
        {
            $temp=$row2['username'];
            if(!strcmp($username,$temp))
            {
               echo '<script>alert("Username already taken")</script>'; 
            }
        }
        
       $query2 = "update `login users` set username='$username',gender='$gender',email='$email',fname='$fname',
       lname='$lname',dob='$dob',password='$password' where cid=$cid";
       $result2=mysqli_query($connect,$query2);
        header('Location:dashboard1.php?cid='.$cid);
    }
   else if(strcmp($password,$conpassword)!=0)
   { 
       $f=0;
     echo '<script>alert("Enter correct password")</script>';    
   }
}
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
            <div id="dash-body-second">
                <form action="dashboard1.php?cid=<?php echo $cid;?>" method="post" class="form-create">
                      <div class="form-create-div">
                                <div>
                                    <label for="">First Name</label><br>
                                    <input type="text" class="textbox" required name="fname" value="<?php echo $row['fname'];?>">
                                </div>
                                 <div>
                                    <label for="">Last Name</label><br>
                                    <input type="text" class="textbox" required name="lname" value="<?php echo $row['lname'];?>">
                                </div>
                          </div>
                          <div class="form-create-adiv">
                                <label for="" >DOB</label><br>
                                <input type="date" class="textbox" required name="dob" value="<?php echo $row['dob'];?>">
                          </div>
                          <div class="form-create-adiv">
                                <label for="">Gender</label><br>
                                <select name="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                          </div>
                          <div class="form-create-adiv">
                                <label for="">Email</label><br>
                                <input type="email" class="textbox" required name="email" value="<?php echo $row['email'];?>">
                          </div>
                          <div class="form-create-adiv">
                                <label for="">Username</label><br>
                                <input type="text" class="textbox" required name="username" value="<?php echo $row['username'];?>">
                          </div>
                          <div class="form-create-div">
                                <div>
                                    <label for="">Password</label><br>
                                    <input type="password" class="textbox" required name="password" value="<?php echo $row['password'];?>">
                                </div>
                                 <div>
                                    <label for="">Confirm Password</label><br>
                                    <input type="password" class="textbox" required name="conpassword" value="<?php echo $row['password'];?>">
                                </div>
                          </div>
                          <a href="terms%20and%20conditions.html"><input type="checkbox" checked required name="terms">Terms and Conditions</a><br>
                          <button type="submit" class="content" name="update">UPDATE</button>
                </form>

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