<?php
require 'dbconfig/config.php';
session_start();
if(empty($_SESSION['imglink'])){
header('Location: adminlogin.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CRM</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/userstyle.css">
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
               // $email = $_SESSION['email'];
                
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
                    $query = "update admin_login SET imglink='$target_file'";
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
                <h1>Welcome Admin</h1>
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
                    <li class="logout"><a href="logout.php">Logout </a>
                        <!--<ul>
                            <li><a href="profile.html">My Profile</a></li>
                            <li><a href="enquiry_details.html">Enquiries</a></li>
                            <li><a href="#">Logout</a></li>
                        </ul>-->
                    </li>
                </ul>
            </div>
            <button type="button" name="button" style="margin-left: 1015px; margin-top: -100px; height: 30px; cursor: pointer;">Change Profile Picture</button>
        </div>
        <div class="addiv">
            <ul class="text_new">
                <li>
                    <a href="dashboard.php"> Enquiries</a>
                </li>
                <li>
                    <a href="engineers.php"> Engineers</a>
                </li>
        </ul>
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