<?php
require 'dbconfig/config.php';
?>

<!doctype html>
<html>
    <head>
        <title>CRM</title>
        <link rel="stylesheet" href="assets/css/forgotstyle.css" /> 
    </head>
    <body>
        <img src="images/forgotpassword.png" title="forgot password" id="forgot-image"/>
        <div class="forgot-block">
            <form action="" method="post" autocomplete="on">
                <h1>Forgot Password</h1>
                <input type="text" name="username" placeholder="Username" autofocus required>
                <input type="password" name="password" placeholder="enter new password" required>
                <input type="password" name="con_password" placeholder="confirm new password" required>
                <button type="submit" name="update_btn">Update</button>
                <a href="adminlogin.php" class="link" style="color: #ff0000;">Back to Login Page</a>
            </form>
			<?php
			if(isset($_POST['update_btn']))
			{
				$username=$_POST['username'];
				$password=$_POST['password'];
				$cpassword=$_POST['con_password'];
				if($password==$cpassword)
				{
					$query="select * from admin_login where username='$username'" ;
					$query_run = mysqli_query($con,$query);
					if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							$query = "update admin_login SET password='$password' WHERE username= '$username'";
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
			}
			?>
        </div>
    </body>
</html>