<?php 
$connect=mysqli_connect('localhost:3306','root','','dream bricks');

if($connect)
{
    if(isset($_POST['submit']))
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $query= "select * from `login users` where username = '$username'";
        $result = mysqli_query($connect,$query);
        $pass=" ";
        while($row= mysqli_fetch_assoc($result))
        {
            $pass = $row['password'];
            if(!strcmp($pass,$password))
            {
                 if($row['type']==1)
                    header("Location:buyerpage.php?cid=".$row['cid']);
                elseif($row['type']==2)
                    header("Location:reviewpage1.php");
            }
        }
       echo '<script>alert("Invalid username/password");</script>';  
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
                 <form action="signin.php" class="form" method="post">
                 
                  <div>
                        <label for="">USERNAME</label><br>
                        <input type="text" required name="username">
                  </div>
                  <div>
                        <label for="">PASSWORD</label><br>
                        <input type="password" required name="password">
                  </div>
                  
                  <button type="submit" name="submit">LOGIN</button>
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