<!DOCTYPE html>
<?php
require 'dbconfig/config.php';
session_start();
if(empty($_SESSION['imglink']))
   {
	   header('location: engineerlogin.php');
   }
   $id = $_GET['id'];
   $query2 = "select * from userinfotable where customer_id = $id";
   $qry_run = mysqli_query($con,$query2);
   if($qry_run)
   {
	   $fetch = mysqli_fetch_array($qry_run);
	   $name = $fetch['username'];
	   $email = $fetch['email'];
	   $con_no = $fetch['contact_no'];
	   $add = $fetch['address'];
	   $city = $fetch['city'];
	   $state = $fetch['state'];
	   $country = $fetch['country'];
	   $pin_code = $fetch['pin_code'];
   }
   else
   {
	   echo '<script type="text/javascript"> alert("Error in Query")</script>';
   }
?>
<html>
    <head>
        <title>CRM</title>
		<link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/userstyle.css" />
		<style>
			button:hover{
				cursor: pointer;
			}
		</style>
    </head>
    <body>
        <div class="bar">
            <img src="images/crm%20Logo.png" class="logo" alt="" />
            <div class="box">
                <img src="images/pic.png" class="image" alt="" />
                <ul class="text">
                    <li><a href=""><?php echo $_SESSION['name']; ?></a>
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
		 <div class="login-block color width">
            <h1 style="color: #ff656c;">Customer Details</h1>
            <span class="span1">Name:</span> <span class="span2"><?php echo $name; ?></span><br />
            <span class="span1">Email:</span> <span class="span2"><?php echo $email; ?></span><br />
            <span class="span1">Contact No.:</span> <span class="span2"><?php echo $con_no; ?></span><br />
            <span class="span1">Address:</span> <span class="span2"><?php echo $add; ?></span><br />
            <span class="span1">City:</span> <span class="span2"> <?php echo $city; ?></span><br />
            <span class="span1">State:</span><span class="span2">  <?php echo $state; ?></span><br />
            <span class="span1">Country:</span> <span class="span2"><?php echo $country; ?></span><br />
            <span class="span1">Pincode:</span> <span class="span2"><?php echo $pin_code; ?></span><br />
           <a href="dashboard.php">
             <button name="edit_btn" style="margin-top: 10px;">Back</button>  
           </a>
        </div>
	</body>