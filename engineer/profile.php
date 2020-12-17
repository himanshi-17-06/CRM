<?php
require 'dbconfig/config.php';
session_start();
if(empty($_SESSION['imglink'])){
header('Location: engineerlogin.php');
}

?>
<!doctype html>
<html>
    <head>
        <title> CRM </title>
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/userstyle.css" />
     <!--   <style>
            .bar{
                position: fixed;
                top: 0px;
                right: 0px;
                left: 0px;
                z-index: 2000;
                margin-top: 30px;
            }
        </style>-->
    </head>
    <body>
        <div class="bar">
            <img src="images/crm%20Logo.png" class="logo" alt="" />
            <div class="box">
                <?php
                    $email = $_SESSION['email'];
                    $name=$_SESSION['name'];
                    $query = "select * from engineer where email= '$email'";
                    $query_run = mysqli_query($con, $query);
                    if($query_run)
                    {
                        if(mysqli_num_rows($query_run)>0)
                        {
                            $rows = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
                            $phone_no = $rows['contact_no'];
                            $address = $rows['address'];
                            $city = $rows['city'];
                            $state= $rows['state'];
                            $country = $rows['country'];
                            $code = $rows['pincode'];
                        }
                        else
                        {
                            echo '<script type="text/javascript"> alert("No record found")!</script>';
                        }
                        
                    }
                    else
                    {
                        echo'<script type="text/javascript"> alert("Error in query!")</script>';
                    }
                ?>
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
						<?php echo $_SESSION['name']; ?> 
						</a>
                        <ul>
                            <li><a href="profile.php">My Profile</a></li>
                            <li><a href="dashboard.php">Enquiries</a></li>
                            <li><a href="change_profile_picture.php">Change Profile Picture</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="login-block color width">
            <h1 style="color: #ff656c;">Profile</h1>
            <span class="span1">Name:</span> <span class="span2"><?php echo $name; ?></span><br />
            <span class="span1">Email:</span> <span class="span2"><?php echo $email; ?></span><br />
            <span class="span1">Contact No.:</span> <span class="span2"><?php echo $phone_no; ?></span><br />
            <span class="span1">Address:</span> <span class="span2"><?php echo $address; ?></span><br />
            <span class="span1">City:</span> <span class="span2"> <?php echo $city; ?></span><br />
            <span class="span1">State:</span><span class="span2">  <?php echo $state; ?></span><br />
            <span class="span1">Country:</span> <span class="span2"><?php echo $country; ?></span><br />
            <span class="span1">Pincode:</span> <span class="span2"><?php echo $code; ?></span><br />
           <a href="edit_profile.php">
             <button name="edit_btn" style="margin-top: 10px;">Edit Profile</button>  
           </a> 
        </div>
    </body>
</html>