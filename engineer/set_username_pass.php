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
				top: 505px;
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
                /*     if($_SESSION['imglink']=="uploads/")
                     {
                        echo '<img src="images/pic.png" class="image" alt="" />';
                     }
                     else	
                     {				 
                        echo '<img src="'.$_SESSION['imglink'].'" class="image" alt="" />';
                     }*/
                ?>
               <!-- <ul class="text">
                    <li>
						<a href="">
						<?php //echo $_SESSION['username']; ?> 
						</a>
                        <ul>
                            <li><a href="profile.php">My Profile</a></li>
                            <li><a href="enquiry_details.php">Enquiries</a></li>
                            <li><a href="change_profile_picture.php">Change Profile Picture</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>-->
            </div>
        </div>
   <!--     <img src="images/forgotpassword.png" title="forgot password" id="forgot-image"/>-->
        <div class="login-block">
            <form action="" method="post" autocomplete="on">
                <h1>SET USERNAME AND PASSWORD</h1>
                <input type="text" name="username" placeholder="Username">
                 <i class="fa fa-eye" id="eye3" style="top: 455px;"></i>
                <input type="password" name="password" placeholder="Password" id="pwd3" required>
                <i class="fa fa-eye" id="eye"></i>
                <input type="password" name="con_password" placeholder="Confirm Password" id="pwd" required>
            <!--    <i class="fa fa-eye" id="eye2" style="top: 525px;"></i>
                <input type="password" name="con_password" placeholder="confirm new password" id="pwd2" required>-->
                <button type="submit" name="update_btn">Update</button>
                <script type="text/javascript">
					var pwd = document.getElementById('pwd');
			        var eye = document.getElementById('eye');
					var eye3 = document.getElementById('eye3');
					var pwd3 = document.getElementById('pwd3');
			        eye.addEventListener('click', togglePass);
				    eye3.addEventListener('click', togglePass3);
			        function togglePass() {
				       eye.classList.toggle('active');
					   (pwd.type == 'password') ? pwd.type = 'text' : pwd.type ='password';
			        }
					function togglePass3() {
						eye3.classList.toggle('active');
						(pwd3.type == 'password') ? pwd3.type = 'text' : pwd3.type ='password';
					}
				</script>
            </form>
			<?php
			if(isset($_POST['update_btn']))
			{
				$id = $_GET['id'];
				$username=$_POST['username'];
				$password=$_POST['password'];
				$cpassword=$_POST['con_password'];
				$query = "select * from engineer where engineer_username = '$username'";
				$query_run = mysqli_query($con,$query);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
						echo '<script type="text/javascript">alert("TRY ANOTHER USERNAME")</script>';
					}
					else
					{
						$query2 = "update engineer SET engineer_username = '$username', password = '$password' where engineer_id = $id";
						$run = mysqli_query($con, $query2);
						if($run)
						{
							echo '<script type="text/javascript">alert("Username and Password successfully set!")</script>';
						}
						else
						{
							echo '<script type="text/javascript">alert("Error in query 2")</script>';
						}
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Error in query 1")</script>';
				}
			}
			?>
        </div>
    </body>
</html>