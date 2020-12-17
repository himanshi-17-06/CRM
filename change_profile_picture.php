<?php 
session_start();
require 'dbconfig/config.php';
if(empty($_SESSION['username'])){
header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>CRM</title>
		<link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/userstyle.css" />
        <script type="text/javascript">
            function PreviewImage() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("imglink").files[0]);
                
                oFReader.onload = function(oFREvent) {
                    document.getElementById("uploadPreview").src = oFREvent.target.result;
                };
            };
        </script>
	</head>
	<body>
        <?php
            if(isset($_POST['ch_btn']))
            {
                $email = $_SESSION['email'];
                
                $img_name = $_FILES['imglink']['name'];
				$img_size = $_FILES['imglink']['size'];
				$img_tmp = $_FILES['imglink']['tmp_name'];
                
                $directory = 'uploads/';
				$target_file = $directory.$img_name;
                if($img_name == "")
                {
                     echo '<script type="text/javascript"> alert("Upload the image first!")</script>';
                }
                else
                {
                    $query = "update userinfotable SET imglink='$target_file' WHERE email='$email'";
                    $query_run = mysqli_query($con,$query);
                    if($query_run)
                    {
                        if(file_exists($target_file))
                        {
                            $_SESSION['imglink']= $target_file;
                            echo '<script type="text/javascript"> alert("Profile picture updated successfully!")</script>';
                        }
                        else
                        {
                            move_uploaded_file($img_tmp, $target_file);
                            $_SESSION['imglink']= $target_file;
                            echo '<script type="text/javascript"> alert("Profile picture updated successfully!")</script>';
                        }
                    }
                    else
                    {
                        echo '<script type="text/javascript"> alert("Error in query")</script>';
                    }
                }
            }
            ?>

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
                    <li><a href=""><?php echo $_SESSION['username'];?></a>
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
		<div class="login-block" style="margin-top: 100px !important;">
			<form action="" method="post" enctype="multipart/form-data">
				<center>
                   <?php 
                    if($_SESSION['imglink']=="uploads/")
                    {
                   echo '<img src="images/pic.png" id="uploadPreview" class="ch_prof_pic">';
                    }
                    else
                    {
                        echo '<img src="'.$_SESSION['imglink'].'" id="uploadPreview" class="ch_prof_pic">';
                    }
                    ?>
                    <input type="file" id="imglink" name="imglink" accept=".jpg, .jpeg, .png" onchange="PreviewImage();">
                </center>
                <button type="submit" name="ch_btn" style="margin-top: 10px;"> Change Profile Picture</button>
			</form>
            
		</div>
	</body>
</html>