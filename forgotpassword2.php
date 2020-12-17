<?php
require 'dbconfig/config.php';
session_start();
?>

<!doctype html>
<html>
    <head>
        <title>CRM</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/forgotstyle.css" /> 
        <link rel="stylesheet" href="assets/css/userstyle.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <style>
			.fa {
	            position: absolute;
				right: 510px;
				font-size: 20px;
				top: 475px;
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
       <div class="bar">
            <img src="images/crm%20Logo.png" class="logo" alt="" />
            <div class="box">
            <?php 
                     if($_SESSION['imglink']=="uploads/")
                     {
                        echo '<img src="images/pic.png" class="image" alt="" />';
                     }
                     else	
                     {				 
                        echo '<img src="'.$_SESSION['imglink'].'" class="image" alt="" />';
                     }
                ?>
                <ul class="text">
                    <li>
						<a href="">
						<?php echo $_SESSION['username']; ?> 
						</a>
                        <ul>
                            <li><a href="profile.php">My Profile</a></li>
                            <li><a href="enquiry_details.php">Enquiries</a></li>
                            <li><a href="change_profile_picture.php">Change Profile Picture</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
   <!--     <img src="images/forgotpassword.png" title="forgot password" id="forgot-image"/>-->
        <div class="login-block">
            <form action="" method="post" autocomplete="on">
                <h1>Change Password</h1>
                <input type="email" name="email" placeholder="email" value="<?php echo $_SESSION['email']; ?>" autofocus readonly>
                 <i class="fa fa-eye" id="eye3" style="top: 420px;"></i>
                <input type="password" name="rec_password" placeholder="enter recent password" id="pwd3" required>
                <i class="fa fa-eye" id="eye"></i>
                <input type="password" name="password" placeholder="enter new password" id="pwd" required>
                <i class="fa fa-eye" id="eye2" style="top: 525px;"></i>
                <input type="password" name="con_password" placeholder="confirm new password" id="pwd2" required>
                <button type="submit" name="update_btn">Update</button>
                <script type="text/javascript">
					var pwd = document.getElementById('pwd');
			        var eye = document.getElementById('eye');
					var eye2 = document.getElementById('eye2');
					var eye3 = document.getElementById('eye3');
			        eye.addEventListener('click', togglePass);
					 eye2.addEventListener('click', togglePass2);
						 eye3.addEventListener('click', togglePass3);
			        function togglePass() {
				       eye.classList.toggle('active');
					   (pwd.type == 'password') ? pwd.type = 'text' : pwd.type ='password';
			        }
					function togglePass2() {
						eye2.classList.toggle('active');
						(pwd2.type == 'password') ? pwd2.type = 'text' : pwd2.type ='password';
					}
					function togglePass3() {
						eye3.classList.toggle('active');
						(pwd3.type == 'password') ? pwd3.type = 'text' : pwd3.type ='password';
					}
				</script>
                <a href="profile.php" class="link" style="color: #ffffff; padding-top: 15px;">Back to Profile Page</a>
            </form>
			<?php
			if(isset($_POST['update_btn']))
			{
				$email=$_POST['email'];
				$password=$_POST['password'];
				$cpassword=$_POST['con_password'];
				$rpassword = $_POST['rec_password'];
				$query="select * from userinfotable where email='$email'" ;
				$query_run = mysqli_query($con,$query);
				$row = mysqli_fetch_array($query_run);
				$rec_pass = $row['password'];
				if($password==$cpassword && $rpassword == $rec_pass)
				{
					
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
				else if($rpassword !=rec_pass)
				{
					echo '<script type="text/javascript">alert("Recent Password is incorrect!")</script>';
					
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