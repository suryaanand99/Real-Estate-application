<?php
$connect=mysqli_connect('localhost:3306','root','','dream bricks');

if($connect)
{
    if(isset($_POST['submit']))
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
    
   
        $t=0;
    $query="select * from `login users` where username='$username' and gender='$gender' and email='$email' and fname='$fname' and lname='$lname' and dob=$dob and password='$password'";
    $result = mysqli_query($connect,$query);
    $r=mysqli_num_rows($result);
    if($r>1)
    {
      
        $t=1;
        echo '<script>alert("Record alread exists ")</script>'; 
    }
    else if($r==1 or $r==0)
    {
      
         $query="select * from `login users`where username='$username'";
        $result = mysqli_query($connect,$query);
        $f=mysqli_num_rows($result);
        if($f>0)
        {
            $t=1;
            echo '<script>alert("username already exists")</script>';
        }
    }
    if($t==0)
    {
           $query="INSERT INTO `login users`(`username`, `gender`, `email`, `fname`, `lname`, `dob`, `password`, `type`) VALUES('$username','$gender','$email','$fname','$lname',$dob,'$password',1)";
            $result = mysqli_query($connect,$query);
            header('Location:indexpage.php');
    }
   
    }
}

?>
<!DOCTYPE htnl>
<html>
    <head>
        <title>sign in</title>
        <link rel="stylesheet" href="stylespd.css">
    </head>
    <body>
        <img src="LOGINIMG.jpg" alt="image" height="745px" width="99%" style="z-index: -1;position: absolute;top: 0px;">
         <div class="back_img">
            <img src="images%20(1).jpeg" alt="logo" width="100px" height="100px" class="logo">
            <div class="nav">
                <a href="signin.php">LOG IN</a>
                <a href="createaccount.php">CREATE ACCOUNT</a>
            </div>
            <div class="content-align">
                <div class="content">
                <p>FIND YOUR PROPERTY</p>
                <p>Dream Bricks is the place where you can find your homes dreamt of.
Auto captures leads from all your sources
Doesn't let you miss out on new enquiries and follow-ups
Connects with your lead instantly with inbuilt smart cloud telephony
Highlights hot leads with auto lead scoring and lead pipeline
Get in-depth calling report of your complete pre-sales team</p>
            </div>
                <form action="createaccount.php" method="post" class="form-create" id="formcr">
                      <div class="form-create-div">
                                <div>
                                    <label for="">First Name</label><br>
                                    <input type="text" class="textbox" required name="fname">
                                </div>
                                 <div>
                                    <label for="">Last Name</label><br>
                                    <input type="text" class="textbox" required name="lname">
                                </div>
                          </div>
                          <div class="form-create-adiv">
                                <label for="" >DOB</label><br>
                                <input type="date" class="textbox" required name="dob">
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
                                <input type="email" class="textbox" required name="email">
                          </div>
                          <div class="form-create-adiv">
                                <label for="">Username</label><br>
                                <input type="text" class="textbox" required name="username">
                          </div>
                          <div class="form-create-div">
                                <div>
                                    <label for="">Password</label><br>
                                    <input type="password" class="textbox" required name="password" id="pass">
                                </div>
                                 <div>
                                    <label for="">Confirm Password</label><br>
                                    <input type="password" class="textbox" required name="conpassword" id="cpass" onchange="myclick()">
                                </div>
                          </div>
                          <script type="text/javascript">
                              function myclick()
                              {
                                  var pass=document.forms["formcr"]["pass"].value;
                              var cpass=document.forms["formcr"]["cpass"].value;
                              if(pass!=cpass)
                                  {
                                      alert("Enter correct Password");
                                  }
                              }
                          </script>
                          <a href="terms%20and%20conditions.html"><input type="checkbox" checked required name="terms">Terms and Conditions</a><br>
                          <button type="submit" class="content" name="submit" style="margin-left: 10%;">SIGN UP</button>
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