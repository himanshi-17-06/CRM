<?php
require 'dbconfig/config.php';
session_start();
?>
<!doctype html>
<html>
    <head>
        <title> CRM </title>
         <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <style>
            body{
                background-attachment: fixed;
             /*   background-position: center;*/
                background-repeat: no-repeat;
                background-size: cover;
            }
            .logo{
                position: fixed;
                top: 0px;
                right: 0px;
                left: 0px;
                z-index: 2000;
                margin-top: 30px;
            }
            #mein{
                position: fixed;
                top: 0px;
                right: 0px;
                left: 0px;
                z-index: 2000;
                margin-top: 30px;
            }
			.fa {
	            position: absolute;
				right: 520px;
				font-size: 20px;
				top: 295px;
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
        <!-- Nav -->
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
        <div class="login-block" style="margin-top: 230px;">
            <form action="" method="post">
                <h1>Enter OTP Here</h1>
                <input type="text" name="otp" placeholder="Enter OTP From Your E-mail" autofocus required>
			<!--	 <i class="fa fa-eye" id="eye"></i> -->
                
           <!--     <img src="image.php" style="float: left; border-radius: 5px;">
	
					
                <input type="text" name="captcha" placeholder="Enter Captcha Code*" style="float: left; width: 202px; !important; margin-left: 5px;" required>
                <a href="forgotpassword.php" class="link float">forgot password?</a>-->
				<button type="submit" name="submit_btn">Submit</button>
				
                
            </form>
        </div>
        <?php
		
		if(isset($_POST['submit_btn']))
		{
			$otp = $_SESSION['otp'];
			$entered_otp = $_POST['otp'];
			if($otp == $entered_otp )
			{
				$username = $_SESSION['username'];
				$email = $_SESSION['email'];
				$password = $_SESSION['password'];
				$phone_no = $_SESSION['phone_no'];
				$code =  $_SESSION['code'];
				$address = $_SESSION['address'];
				$city = $_SESSION['city'];
				$state = $_SESSION['state'];
				$country = $_SESSION['country'];
				$target_file = $_SESSION['target_file'];
				$img_tmp = $_SESSION['img_tmp'];
				if(file_exists($target_file))
                            {
                                //move_uploaded_file($img_tmp, $target_file);
                                $query = "insert into userinfotable (username, email, password, contact_no, address, city, state, country, pin_code, imglink) values('$username', '$email', '$password', '$phone_no', '$address', '$city', '$state', '$country', '$code', '$target_file')";
                                $query_run = mysqli_query($con,$query);
                                if($query_run)
                                {
										 echo '<script type="text/javascript"> alert("You are registered ..Go to login page") </script>' ;
                                }
                                else
                                {
                                    echo '<script type="text/javascript"> alert("'.mysqli_error($con).'") </script>' ;
                                }
                            }
                            else
                            {
                                move_uploaded_file($img_tmp, $target_file);
                                $query = "insert into userinfotable (username, email, password, contact_no, address, city, state, country, pin_code, imglink) values('$username', '$email', '$password', '$phone_no', '$address', '$city', '$state', '$country', '$code', '$target_file')";
                                $query_run = mysqli_query($con,$query);
                                if($query_run)
                                {
                                    	echo '<script type="text/javascript"> alert("You are registered ..Go to login page") </script>' ;
                                }
                                else
                                {
                                    echo '<script type="text/javascript"> alert("'.mysqli_error($con).'") </script>' ;
                                }   
                            }
			}
			else
			{
				echo "<script type='text/javascript'>alert('WRONG OTP')</script>";
			}
		}
		?>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/skel.min.js"></script> 
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        
    </body>
</html>