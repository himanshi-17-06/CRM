<?php
require 'dbconfig/config.php';
session_start();
?>

<!doctype html>
<html>
    <head>
        <title>CRM</title>
        
        <link rel="stylesheet" href="assets/css/main.css" />  
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/userstyle.css" />
        
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        
        <style>
			.fa {
	            position: absolute;
				right: 518px;
				font-size: 20px;
				top: 300px;
				cursor: pointer;
				/*bottom: 300px;*/
				color: #999;
				}
			.fa.active{
				color: dodgerblue;
			}
		</style>
    </head>
    <body>
     	<header id="header" class="alt">
				<div class="logo">
                    <a href="index.html">
                        <img src="images/crm%20Logo.png" />
                    </a>
                </div>
                <a href="#menu">Menu</a>
        </header>
   <!--     <img src="images/forgotpassword.png" title="forgot password" id="forgot-image"/>-->
       <nav id="menu">
				<ul class="links">
					<li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About us</a></li>
					<li><a href="signup.php">Sign Up</a></li>
					<li><a href="login.php">Login</a></li>
                    <li><a href="contact.php">Contact us</a></li>
                    <li><a href="faq.php">FAQs</a></li>
                   
				</ul>
			</nav> 
        <div class="login-block">
            <form action="" method="post" autocomplete="on">
                <h1>Forgot Password</h1>
                <input type="email" name="email" placeholder="email" autofocus required>
            <!--    <i class="fa fa-eye" id="eye"></i>
                <input type="password" name="password" placeholder="enter new password" id="pwd" required>
                <i class="fa fa-eye" id="eye2" style="top: 350px;"></i>
                <input type="password" name="con_password" placeholder="confirm new password" id="pwd2" required>-->
                <button type="submit" name="update_btn">Submit</button>
           <!--     <script type="text/javascript">
					var pwd = document.getElementById('pwd');
			        var eye = document.getElementById('eye');
					var eye2 = document.getElementById('eye2');
			        eye.addEventListener('click', togglePass);
					 eye2.addEventListener('click', togglePass2);
			        function togglePass() {
				       eye.classList.toggle('active');
					   (pwd.type == 'password') ? pwd.type = 'text' : pwd.type ='password';
			        }
					function togglePass2() {
						eye2.classList.toggle('active');
						(pwd2.type == 'password') ? pwd2.type = 'text' : pwd2.type ='password';
					}
				</script>-->
                <a href="login.php" class="link" style="color: #ffffff; padding-top: 15px;">Back to Login Page</a>
            </form>
			<?php
			if(isset($_POST['update_btn']))
			{
				$email=$_POST['email'];
				$query="select * from userinfotable where email='$email'" ;
				$query_run = mysqli_query($con,$query);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
						$row = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
						$to = $email;
    		    		$subject = 'localhost subject';
		        		$message = 'Your Password is: '.$row['password'];
			    		$headers = 'From: onlyfortest17@gmail.com';
						if(mail($to, $subject, $message, $headers))
						 {
							echo '<script type="text/javascript">alert("Check your Password on your mail")</script>';
						 }
					}
					else
					{
						echo '<script type="text/javascript">alert("Your Email is not registered")</script>';
					}
				}
				
			}
		/*	if(isset($_POST['update_btn']))
			{
				$email=$_POST['email'];
				$password=$_POST['password'];
				$cpassword=$_POST['con_password'];
				if($password==$cpassword)
				{
					$query="select * from userinfotable where email='$email'" ;
					$query_run = mysqli_query($con,$query);
					if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							$query = "update userinfotable SET password='$password' WHERE email='$email'";
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript"> alert("Password Updated")</script>' ;
							}
							else
							{
								echo '<script type="text/javascript"> alert("Error in query")</script>' ;
							}
							
						}
						else
						{
							echo '<script type="text/javascript" alert("Email not exist")</script>';
						}
					}
					else
					{
						echo '<script type="text/javascript"> alert("Error in query")</script>' ;
					}
				}
				else
				{
					echo '<script type="text/javascript"> alert("Password and Confirm Password does not match")</script>' ;
				}
			}*/
			?>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/skel.min.js"></script> 
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>