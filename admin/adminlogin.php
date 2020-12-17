<?php
require 'dbconfig/config.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CRM</title>
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
		<style>
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
        </header>
        <div class="login-block">
            <form action="" method="post">
                <h1>Admin login</h1>
                <input type="text" name="username" placeholder="Username" autofocus required>
				<i class="fa fa-eye" id="eye"></i>
                <input type="password" name="password" placeholder="Password" id="pwd" required>
                <img src="image.php" style="float: left; border-radius: 5px;">
                <input type="text" name="captcha" placeholder="Enter Captcha Code*" style="float: left; width: 202px !important; margin-left: 5px;" required>
             <!--   <a href="forgotpassword.php" class="link float">forgot password?</a>-->
                <button type="submit" name="submit_btn">Login</button>
				<script type="text/javascript"> 
				    var pwd = document.getElementById('pwd');
			        var eye = document.getElementById('eye');
					 eye.addEventListener('click', togglePass);
					 function togglePass() {
				       eye.classList.toggle('active');
					   (pwd.type == 'password') ? pwd.type = 'text' : pwd.type ='password';
			        }
				</script>
            </form>
            <?php 
            if(isset($_POST['submit_btn']))
            {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $captcha = $_SESSION['captcha'];
                $query = "select * from admin_login where username = '$username' AND password = '$password'";
                $query_run = mysqli_query($con, $query);
                if($query_run)
                {
                    if(mysqli_num_rows($query_run)>0 && $captcha == $_POST['captcha'])
                    {
                        $row = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
                        $_SESSION['imglink'] = $row['imglink'];
                        header('location:dashboard.php');
                    }
                    else if(mysqli_num_rows($query_run)==0)
                    {
                        echo '<script type="text/javascript"> alert("Invalid username or Password!")</script>';
                    }
                    else
                    {
                        echo '<script type="text/javascript"> alert("Captcha Code not matched!")</script>';
                    }
                }
                else 
                {
                    echo '<script type="text/javascript"> alert("Error in query!")</script>';
                }
            }
            ?>
        </div>
    </body>
</html>
