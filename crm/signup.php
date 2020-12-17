<?php
session_start();
require 'dbconfig/config.php';
?>
<!doctype html>
<html>
    <head> 
        <title> CRM </title>
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
    </head>  
    <body>
       
        <header id="header" class="alt">
				<div class="logo"><a href="index.html">
                    <img src="images/crm%20Logo.png" />
                    </a></div>
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
        <div class="login-block">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
               <h1>Registration Form</h1> 
                <center><img src="images/user.png" class="avatar" /></center><br />
                <input type="file" name="imglink" accept=".jpg, .jpeg, .png" onchange="PreviewImage();">
                <input type ="text" name="username" placeholder="Name*" autofocus required>
                <input type="email" name="email" placeholder="email*" required>
                <input type="password" name="password" placeholder="Password*" required>
                <input type="password" name="con_password" placeholder="confirm Password*" required>
                <button name="submit_btn" type="submit">Signup</button>
                <a href="login.php" class="link">If you are already a user</a>
            </form>
            
        </div>
        <?php
			if(isset($_POST['submit_btn']))
			{
				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$cpassword = $_POST ['con_password'];
				if($password==$cpassword)
				{
					$query = "select * from userinfotable WHERE email='$email'" ;
					$query_run = mysqli_query($con,$query);
					if($query_run)
					{	
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript"> alert("Email already exist..try another email") </script>' ;
						}
						else
						{
							$query = "insert into userinfotable (username, email, password, contact_no, address, city, country, pin_code) values('$username', '$email', '$password', '', '', '', '', 0)";
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								#$_SESSION['username'] = $username;
								echo '<script type="text/javascript"> alert("You are registered ..Go to login page") </script>' ;
							}
							else
							{
								echo '<script type="text/javascript"> alert("'.mysqli_error($con).'") </script>' ;
							}
							
						}
					}
				}
			
				else 
				{
					echo '<script type="text/javascript"> alert("Password and confirm password does not match") </script>' ;
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