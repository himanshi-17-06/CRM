<?php
session_start();
if(empty($_SESSION['imglink'])){
header('Location: engineerlogin.php');
}

require 'dbconfig/config.php';
$email= $_SESSION['email'];
$query= "select * from engineer where email= '$email'" ;
$query_run= mysqli_query($con,$query);
if($query_run)
{
	if(mysqli_num_rows($query_run)>0)
	{
		$rows = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
		//if($rows['contact_no']=="" AND $rows['address']=="")
		//{
		//	$phone_no= "";
		//	$address= "";
		//	$city= "";
          //  $state="";
			/*$country= "";
			$code= "";
		}
		else
		{*/
			$phone_no=$rows['contact_no'];
			$address= $rows['address'];
			$city= $rows['city'];
            $state= $rows['state'];
			$country= $rows['country'];
			$code= $rows['pincode'];
		//}
	}
    else
    {
        echo '<script type="text/javascript"> alert("No record found!")</script>';
    }
}
else
{
	echo '<script type="text/javascript"> alert("Error in first query")</script>';
}
?>
<!doctype html>
<html>
    <head>
        <title> CRM </title>
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/userstyle.css" />
    </head>
    <body>
        <div class="bar">
            <img src="images/crm%20Logo.png" class="logo" alt="" />
            <div class="box">
			<?php
			if(isset($_POST['update_btn']))
			{
				//$phone_no=$_POST['phone_no'];
				$address= $_POST['address'];
				$city= $_POST['city'];
                $state= $_POST['state'];
				$country= $_POST['country'];
				//$code= $_POST['code'];
                $regx = '/[0-9]{10}/';
                if(preg_match($regx,$_POST['phone_no']))
                {
                    $phone_no=$_POST['phone_no'];
                }
                else
                {
                    $phone_no= "";
                    $errorPhone_no= '<span style="color: white; padding-left: 250px;">Enter Valid phone no.</span>';
                }
                $regx2 = '/[0-9]{6}/';
                if(preg_match($regx2,$_POST['code']))
                {
                    $code=$_POST['code'];
                }
                else
                {
                    $code= "";
                    $errorCode= '<span style="color: white; padding-left: 250px;">Enter Valid Pincode</span>';
                }
                    $query = "update userinfotable SET contact_no= '$phone_no', address= '$address', city= '$city', state= '$state', country= '$country', pin_code= $code WHERE email= '$email'" ;
                    $query_run= mysqli_query($con,$query);
                    if($query_run)
                    {
                        echo '<script type="text/javascript"> alert("Upadation Successful")</script>';
                    }
                    else
                    {
                        echo '<script type="text/javascript"> alert("Error check all the entries carefully")</script>"';
                    }
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
                            <li><a href="enquiry_details.php">Enquiries</a></li>
                            <li><a href="change_profile_picture.php">Change Profile Picture</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="login-block color">
            <h1>Profile</h1>
            <form action="" method="post">
                <label style="color: white; font-size: 20px; font-weight: bold;">Name:</label>
                <input type="text" name="username" placeholder="Name*" value="<?php echo $_SESSION['name'];?>" required readonly />
                <label style="color: white; font-size: 20px; font-weight: bold;">Email:</label>
                <input type="email" name="email" placeholder="Email*" value="<?php echo $_SESSION['email'] ;?>" required readonly />
                <label style="color: white; font-size: 20px; font-weight: bold;">Contact No.:</label>
                
                <input type="tel" name="phone_no" placeholder="Contact Number*" value= "<?php echo $phone_no;?>" required />
                <?php if(isset($errorPhone_no)){ echo $errorPhone_no; } ?>
                <label style="color: white; font-size: 20px; font-weight: bold;">Address:</label>
                <input type="text" name="address" placeholder="Address*" value= "<?php echo $address;?>" required />
                <label style="color: white; font-size: 20px; font-weight: bold;">City:</label>
                <input type="text" name="city" placeholder="City*" value= "<?php echo $city;?>" required />
                <label style="color: white; font-size: 20px; font-weight: bold;">State:</label>
                <input type="text" name="state" placeholder="State*" value= "<?php echo $state;?>" required />
                <label style="color: white; font-size: 20px; font-weight: bold;">Country:</label>
                <input type="text" name="country" placeholder="Country*" value= "<?php echo $country;?>" required />
                <label style="color: white; font-size: 20px; font-weight: bold;">Pincode:</label>
                
                <input type="text" name="code" placeholder="Pincode*" value= "<?php echo $code;?>" required />
                <?php if(isset($errorCode)){ echo $errorCode; } ?>
                <a href="forgotpassword2.php" class="forgot">Change Password</a>
                <button type="submit" name="update_btn" >Update</button>
            </form>
			
        </div>
    </body>
</html>