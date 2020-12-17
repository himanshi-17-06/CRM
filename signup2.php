<?php
session_start();
require 'dbconfig/config.php';
$username ="";
$email = "";
$phone_no = "";
$address = "";
$city = "";
$state= "";
$country = "";
$code = "";
$password= "";
$cpassword="";
?>
<!doctype html>
<html>
    <head> 
        <title> CRM </title>
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <style>
            body{
                background-attachment: fixed;
             /*   background-position: center;*/
                background-repeat: no-repeat;
                background-size: cover;
            }
            .logo{
                position: fixed;
                top: 0px;
                right: 0px;
                left: 0px;
                z-index: 2000;
                margin-top: 30px;
            }
            #mein{
                position: fixed;
                top: 0px;
                right: 0px;
                left: 0px;
                z-index: 2000;
                margin-top: 30px;
            }
			.fa {
	            position: absolute;
				right: 510px;
				font-size: 20px;
				top: 870px;
				cursor: pointer;
				/*bottom: 300px;*/
				color: #999;
				}
			.fa.active{
				color: dodgerblue;
			}
        </style>
		
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
       
        <header id="header" class="alt">
				<div class="logo"><a href="index.html">
                    <img src="images/crm%20Logo.png" />
                    </a></div>
				<a href="#menu" id="mein">Menu</a>
			</header>
        <!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About us</a></li>
					<li><a href="signup.php">Sign Up</a></li>
					<li><a href="login.php">Login</a></li>
                    <li><a href="contact.php">Contact us</a></li>
                    <li><a href="offers.php">Offers</a></li>
                    <li><a href="faq.php">FAQs</a></li>
                    
				</ul>
			</nav>
        <?php
			if(isset($_POST['submit_btn']))
			{
				$username = $_POST['username'];
				$email = $_POST['email'];
				
                $address= $_POST['address'];
				$city= $_POST['city'];
                $state= $_POST['state'];
				$country= $_POST['country'];
				$password = $_POST['password'];
				$cpassword = $_POST ['con_password'];
                $captcha = $_SESSION['captcha'];
                $regx = '/[0-9]{10}/';
                if(preg_match($regx,$_POST['phone_no']))
                {
                    $phone_no=$_POST['phone_no'];
                }
                else
                {
                    $phone_no= "";
                  //  $errorPhone_no= '<span style="color: white; padding-left: 200px;">Enter Valid phone no.</span>';
                }
                $regx2 = '/[0-9]{6}/';
                if(preg_match($regx2,$_POST['code']))
                {
                    $code=$_POST['code'];
                }
                else
                {
                    $code= "";
                   // $errorCode= '<span style="color: white; padding-left: 200px;">Enter Valid Pincode</span>';
                }

				$img_name = $_FILES['imglink']['name'];
				$img_size = $_FILES['imglink']['size'];
				$img_tmp = $_FILES['imglink']['tmp_name'];

				$directory = 'uploads/';
				$target_file = $directory.$img_name;
				if($password==$cpassword && $phone_no!= "" && $code!= "" && $captcha == $_POST['captcha'])
				{
					$query = "select * from userinfotable WHERE email='$email'" ;
					$query_run = mysqli_query($con,$query);
					if($query_run)
					{	
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript"> alert("Email already exist..try another email") </script>' ;
						}
						else if ($img_size>2097152)
						{
							echo '<script type="text/javascript"> alert("Image file size larger than 2MB... Try another image file")</script>';
						}
						else
						{
                            if(file_exists($target_file))
                            {
                                //move_uploaded_file($img_tmp, $target_file);
                                $query = "insert into userinfotable (username, email, password, contact_no, address, city, state, country, pin_code, imglink) values('$username', '$email', '$password', '$phone_no', '$address', '$city', '$state', '$country', '$code', '$target_file')";
                                $query_run = mysqli_query($con,$query);
                                if($query_run)
                                {
									$_SESSION['otp'] = mt_rand(10000, 99999);
									$to = $email;
    					            $subject = 'localhost subject';
						            $message = 'Your OTP is:  '.$_SESSION['otp'];
						            $headers = 'From: onlyfortest17@gmail.com';
									//echo '<script type="text/javascript">confirm("You are going to be registered")</script>';
									 if(mail($to, $subject, $message, $headers))
						 			 {
										// echo '<script type="text/javascript"> alert("You are registered ..Go to login page") </script>' ;
										header('location: otp.php');
										 // $username ="";
										 // $email = "";
	                                     //$phone_no = "";
										 //$address = "";
										 //$city = "";
										 //$state= "";
										 //$country = "";
										 //$code = "";
										 //$password= "";
										 //$cpassword="";
									 }
                                }
                                else
                                {
                                    echo '<script type="text/javascript"> alert("'.mysqli_error($con).'") </script>' ;
                                }
                            }
                            else
                            {
                                move_uploaded_file($img_tmp, $target_file);
                                $query = "insert into userinfotable (username, email, password, contact_no, address, city, state, country, pin_code, imglink) values('$username', '$email', '$password', '$phone_no', '$address', '$city', '$state', '$country', '$code', '$target_file')";
                                $query_run = mysqli_query($con,$query);
                                if($query_run)
                                {
									$_SESSION['otp'] = mt_rand(10000, 99999);
									$to = $email;
    					            $subject = 'localhost subject';
						            $message = 'Your OTP is:  '.$_SESSION['otp'];
						            $headers = 'From: onlyfortest17@gmail.com';
									//echo '<script type="text/javascript">confirm("You are going to be registered")</script>';
									 if(mail($to, $subject, $message, $headers))
						 			 {
                                    	//echo '<script type="text/javascript"> alert("You are registered ..Go to login page") </script>' ;
										 echo "<script type='text/javascript'>
										 alert('OTP IS SUCCESSFULLY MAILED TO YOU')
										 </script>";
										 header('location: otp.php');
									 }
									//header('location: login.php');
                                }
                                else
                                {
                                    echo '<script type="text/javascript"> alert("'.mysqli_error($con).'") </script>' ;
                                }   
                            }
							
						}
					}
				}
				else
				{
					if($phone_no=="" && $code=="")
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
				
					else if($password!= $cpassword)
					{
						echo '<script type="text/javascript"> alert("Password and confirm password does not match") </script>';
					}
                    else
                    {
                        echo '<script type="text/javascript"> alert("Captcha code not matched!")</script>';
                    }
				}
			}
		?>
        
        
        <div class="login-block">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
               <h1>Registration Form</h1> 
                <center><img id="uploadPreview" src="images/user.png" class="avatar" /></center><br />
                <input type="file" id="imglink" name="imglink" accept=".jpg, .jpeg, .png" onchange="PreviewImage();">
                <!--<label style="color: white; font-size: 20px; font-weight: bold;">Name:</label>-->
                <input type ="text" name="username" placeholder="Name*" value="<?php echo $username;?>" autofocus required>
                <input type="email" name="email" placeholder="email*" value="<?php echo $email;?>" required>
                <input type="tel" name="phone_no" placeholder="Contact Number*" value="<?php echo $phone_no;?>" required />
				
                <input type="text" name="address" placeholder="Address*" value="<?php echo $address;?>" required />
               
                <input type="text" name="state" placeholder="State*" value="<?php echo $state;?>" required />
			<!--	<select name = "state">
					<option>Please Select...</option>
					<option value = "Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
					<option value="Andhra Pradesh">Andhra Pradesh</option>
					<option value="Arunachal Pradesh">Arunachal Pradesh</option>
					<option value="Assam">Assam</option>
					<option value="Bihar">Bihar</option>
					<option value ="Chhattisgarh">Chhattisgarh</option>
					<option value = "Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
					<option value = "Daman and Diu">Daman and Diu</option>
					<option value = "Delhi">Delhi</option>
					<option value ="Goa">Goa</option>
					<option value = "Gujarat">Gujarat</option>
					<option value = "Haryana">Haryana</option>
					<option value="Himachal Pradesh">Himachal Pradesh</option>
					<option value="Jammu and Kashmir">Jammu and Kashmir</option>
					<option value="Jharkhand">Jharkhand</option>
					<option value="Karnataka">Karnataka</option>
					<option value="Kerela">Kerela</option>
					<option value="Lakshadweep">Lakshadweep</option>
					<option value="Madhya Pradesh">Madhya Pradesh</option>
					<option value="Maharashtra">Maharashtra</option>
					<option value="Manipur">Manipur</option>
					<option value="Meghalaya">Meghalaya</option>
					<option value="Mizoram">Mizoram</option>
					<option value="Nagaland">Nagaland</option>
					<option value="Orissa">Orissa</option>
					<option value="Pondicherry">Pondicherry</option>
					<option value="Punjab">Punjab</option>
					<option value="Rajasthan">Rajasthan</option>
					<option value="Sikkim">Sikkim</option>
					<option value="Tamil Nadu">Tamil Nadu</option>
					<option value="Telangana">Telangana</option>
					<option value="Tripura" >Tripura</option>
					<option value="Uttar Pradesh">Uttar Pradesh</option>
					<option value="Uttarakhand">Uttarakhand</option>
					<option value="West Bengal">West Bengal</option>
					<option value="Other">Other</option>
				</select>-->
				 <input type="text" name="city" placeholder="City*" value="<?php echo $city;?>" required />
              <input type="text" name="country" placeholder="Country*" value="<?php echo $country;?>" required /> 
                <input type="text" name="code" placeholder="Pincode*" value="<?php echo $code;?>" required />
			    <i class="fa fa-eye" id="eye"></i>
                <input type="password" name="password" placeholder="Password*" value="<?php echo $password;?>" id="pwd" required>
				 <i class="fa fa-eye" id="eye2" style="top: 925px;"></i>
                <input type="password" name="con_password" placeholder="confirm Password*" value="<?php echo $cpassword;?>" id = "pwd2" required>
                <img src="image.php" style="float: left; border-radius: 5px;">
                <input type="text" name="captcha" placeholder="Enter Captcha Code*" style="float: left; width: 202px; !important; margin-left: 5px;" required>
                <button name="submit_btn" type="submit" style="margin-top: 10px;">Signup</button>
				<script type="text/javascript">
					var pwd = document.getElementById('pwd');
			        var eye = document.getElementById('eye');
					var eye2 = document.getElementById('eye2');
			        eye.addEventListener('click', togglePass);
					 eye2.addEventListener('click', togglePass2);
			        function togglePass() {
				       eye.classList.toggle('active');
					   (pwd.type == 'password') ? pwd.type = 'text' : pwd.type ='password';
			        }
					function togglePass2() {
						eye2.classList.toggle('active');
						(pwd2.type == 'password') ? pwd2.type = 'text' : pwd2.type ='password';
					}
				</script>
                <a href="login.php" class="link">If you are already a user</a>
            </form>
            
        </div>
		
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script> 
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
    </body>
</html>