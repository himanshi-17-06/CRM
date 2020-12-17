<!doctype html>
<?php 
session_start();
require 'dbconfig/config.php';
if(empty($_SESSION['imglink'])){
header('Location: adminlogin.php');
 }
$id = $_GET['id'];
$query = "select * from enquiry_table where enquiry_id = $id";
$query_run = mysqli_query($con, $query);
$sql = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
$cus_id = $sql['customer_id'];
$query2 = "select * from userinfotable where customer_id = $cus_id";
$run = mysqli_query($con, $query2);
$row = mysqli_fetch_array($run, MYSQLI_ASSOC);
?>
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
         $eng_id = $_POST['engineer'];
         $int = 1;
         $query4 = "update enquiry_table SET engineer_id = $eng_id, status = $int WHERE enquiry_id = $id";
         $run4 = mysqli_query($con, $query4);
         if($run4)
           {
             echo '<script type="text/javascript">alert("Successfully Updated")</script>';
            }
         else
           {
             echo '<script type="text/javascript">alert("Error in query")</script>';         
            }
        }  
        $query = "select * from enquiry_table where enquiry_id = $id";
        $query_run = mysqli_query($con, $query);
        $sql = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
            if( $sql['status'] == 0)
				{
					$status = 'pending'; 
				}
				else if( $sql['status'] == 1)
				{
				    $status = 'processing'; 
				}
				else 
				{
				    $status = 'closed'; 	
				} 
        
    ?>
        
        <div class="login-block">
            
            <form action="" method="post">
                <h1>Edit Enquiry Details</h1>
                 <label style="color: white; font-size: 20px; font-weight: bold;">Email:</label>
                <input type="email" name="email" placeholder="Email*" value="<?php echo $row['email']; ?>" readonly/>
                 <label style="color: white; font-size: 20px; font-weight: bold;">Contact No.:</label>
                <input type="tel" name="contact_no" placeholder="Contact No*" value="<?php echo $row['contact_no']; ?>" readonly/>
                <label style="color: white; font-size: 20px; font-weight: bold;">Description:</label>
                <textarea id = "description" placeholder="Description*" name="description" rows="3" readonly><?php echo $sql['description']; ?></textarea>
                 <label style="color: white; font-size: 20px; font-weight: bold;">Address:</label>
                <input type="text" name="address" placeholder="Address*" value="<?php echo $row['address']; ?>" readonly />
                 <label style="color: white; font-size: 20px; font-weight: bold;">City:</label>
                <input type="text" name="city" placeholder="City*" value="<?php echo $row['city']; ?>" readonly />
                 <label style="color: white; font-size: 20px; font-weight: bold;">State:</label>
                <input type="text" name="state" placeholder="State*" value="<?php echo $row['state']; ?>" readonly />
                 <label style="color: white; font-size: 20px; font-weight: bold;">Country:</label>
                <input type="text" name="country" placeholder="Country" value="<?php echo $row['country']; ?>" readonly />
                 <label style="color: white; font-size: 20px; font-weight: bold;">Pincode:</label>
                <input type="text" name="pincode" placeholder="Pincode*" value= "<?php echo $row['pin_code']; ?>" readonly />
                 <label style="color: white; font-size: 20px; font-weight: bold;">Engineers:</label>
                <select name="engineer">
                    <option>----------------------------SELECT----------------------------</option>
                   
                    <?php
                    $pincode = $row['pin_code'];
                    $query3 = "select * from engineer where pincode = '$pincode'";
                    $run3 = mysqli_query($con, $query3);
                           while ($rows= mysqli_fetch_array($run3))
                            {
                      ?>

                               <option value="<?php echo $rows['engineer_id'];?>" 
                                       <?php
                               if($sql['engineer_id']== $rows['engineer_id'])
                               {
                                   ?>
                                       selected<?php } ?> >
                                   <?php
                                    echo $rows['name'];
                                    ?>
                                </option>
                        <?php
                            }
                         ?>
                    



                </select>
                 <label style="color: white; font-size: 20px; font-weight: bold;">Status:</label>
                <input type="text" name="state" value = "<?php echo $status; ?>" placeholder="Status*" />
                <button type="submit" name="submit">Update</button>
            </form>          
        </div>
        
    </body>
</html>