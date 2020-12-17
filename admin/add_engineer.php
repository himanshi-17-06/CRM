<?php
require 'dbconfig/config.php';
//require 'PHPMailer-master/phpmy.php';
session_start();
if(empty($_SESSION['imglink'])){
header('Location: adminlogin.php');
}
$name ="";
$email = "";
$phone_no = "";
$address = "";
$city = "";
$state = "";
$country = "";
$code ="";
?>
<!doctype html>
<html>
    <head>
        <title>CRM</title>
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/userstyle.css" />
    </head>
    <body>
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
            <a href="change_profile_picture.php">
            <button type="button" name="button" style="margin-left: 1015px; margin-top: -100px; height: 30px; cursor: pointer;">Change Profile Picture</button></a>
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
           <!--  <a href="enquiry_form.html"><button class="abc">New Enquiry</button></a>
        <div class="login-blockk color query user_profile">
            <h1>ENQUIRY DETAILS</h1>
        </div>-->
        <?php
        if(isset($_POST['submit']))
        {
            $name= $_POST['name'];
            $email= $_POST['email'];
            $address = $_POST['address'];
            $city= $_POST['city'];
            $state = $_POST['state'];
            $country = $_POST['country'];
		//	$password= $_POST['password'];
			//$con_password = $_POST['con_password'];
		//	$username = $_POST['eng_username'];
            $regx = '/[0-9]{10}/';
            if(preg_match($regx,$_POST['contact_no']))
            {
                $phone_no=$_POST['contact_no'];
            }
            else
            {
                $phone_no= "";
                  //  $errorPhone_no= '<span style="color: white; padding-left: 200px;">Enter Valid phone no.</span>';
            }
            $regx2 = '/[0-9]{6}/';
            if(preg_match($regx2,$_POST['pincode']))
            {
                $code= $_POST['pincode'];
            }
            else
            {
                $code= "";
                   // $errorCode= '<span style="color: white; padding-left: 200px;">Enter Valid Pincode</span>';
            }
            //if($phone_no!= "" && $code!="" && $password == $con_password)
			if($phone_no!= "" && $code!="")
            {
				$query2 = "select * from engineer where email = '$email'";
				$run = mysqli_query($con, $query2);
				if($run)
				{
					if(mysqli_num_rows($run)>0)
					{
						echo '<script type="text/javascript"> alert("Engineer Email already exist")</script>';
					}
					else
					{
						$query = "insert into engineer(name, email, contact_no, address, city, state, country, pincode, engineer_username, password, imglink) values('$name', '$email', '$phone_no', '$address', '$city', '$state', '$country', '$code', '', '', 'uploads/')";
						$query_run = mysqli_query($con, $query);
						if($query_run)
						{
						 $query3 = "select * from engineer where email= '$email'";
					//	 echo "<script type='text/javascript'>alert($email)</script>";
						 $run3 = mysqli_query($con, $query3);
						 $row = mysqli_fetch_assoc($run3);
						 $eng_id = $row['engineer_id'];
						 $to = $email;
    					 $subject = 'localhost subject';
					//	 $message = 'Username:  '.$username.'   Password:  '.$password;
						 $message = "You are successfully added. Set Your Username and password Click on the link 
						 http://localhost/CRM/engineer/set_username_pass.php?id=$eng_id"; 
						 $headers = 'From: onlyfortest17@gmail.com';
						 if(mail($to, $subject, $message, $headers))
						 {
							echo '<script type="text/javascript"> alert("Engineer Successfully Added")</script>';   
							$name ="";
							$email = "";
							$phone_no = "";
							$address = "";
							$city = "";
							$state = "";
							$country = "";
							$code ="";
						 }
							else
							{
								echo '<script type="text/javascript"> alert("Engineer not Successfully Added")</script>';   
							}
						}
						else
						{
							echo '<script type="text/javascript"> alert("Check all the entries again carefully")</script>';
						}
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Error in query")</script>';
				}
            }
            else if($phone_no =="" && $code=="")
            {
                echo '<script type="text/javascript"> alert("Enter valid contact number and valid pincode")</script>';
            }
            else if($phone_no=="")
				{
				    echo '<script type="text/javascript"> alert("Enter valid contact number")</script>';
				}
            else if($code=="")
				{
				    echo '<script type="text/javascript"> alert("Enter valid pincode")</script>';
				}
		/*	else if($password != $con_password)
			{
				echo '<script type="text/javascript"> alert("Password and Confirm password not matched!")</script>';
			}*/
		}
        
        ?>
        <div class="login-block">
            <form action="" method="post">
                <h1>Add a new Engineer</h1>
                 <label style="color: white; font-size: 20px; font-weight: bold;">Name:</label>
                <input type="text" name="name" placeholder="Name*" value="<?php echo $name; ?>" />
                 <label style="color: white; font-size: 20px; font-weight: bold;">Email:</label>
                <input type="email" name="email" placeholder="Email*"  value="<?php echo $email; ?>" />
                 <label style="color: white; font-size: 20px; font-weight: bold;">Contact No.:</label>
                <input type="tel" name="contact_no" placeholder="Contact No*"  value="<?php echo $phone_no; ?>"/>
                 <label style="color: white; font-size: 20px; font-weight: bold;">Address:</label>
                <input type="text" name="address" placeholder="Address*"  value="<?php echo $address; ?>"/>
                 <label style="color: white; font-size: 20px; font-weight: bold;">City:</label>
                <input type="text" name="city" placeholder="City*"  value="<?php echo $city; ?>" />
                 <label style="color: white; font-size: 20px; font-weight: bold;"  value="<?php echo $state; ?>">State:</label>
                <input type="text" name="state" placeholder="State*" value="<?php echo $state; ?>"  />
                 <label style="color: white; font-size: 20px; font-weight: bold;">Country:</label>
                <input type="text" name="country" placeholder="Country"  value="<?php echo $country; ?>" />  
                 <label style="color: white; font-size: 20px; font-weight: bold;">Pincode:</label>
                <input type="text" name="pincode" placeholder="Pincode*"  value="<?php echo $code; ?>" />
			<!--	<label style="color: white; font-size: 20px; font-weight: bold;">
				Assign Username:
				</label>
				<input type="text" name="eng_username" placeholder="Username*" />
				<label style="color: white; font-size: 20px; font-weight: bold;">
				Assign Password:
				</label>
				<input type="password" name = "password" placeholder="Password*" />
				<label style="color: white; font-size: 20px; font-weight: bold;">
				Confirm Password:
				</label>
				<input type="password" name = "con_password" placeholder="Confirm Password*" />-->
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </body>
</html>