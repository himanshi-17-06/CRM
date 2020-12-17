<!doctype html>
<?php
session_start();
require 'dbconfig/config.php';
if(empty($_SESSION['imglink'])){
header('Location: adminlogin.php');
}
?>
<html>
    <head>
        <title>CRM</title>
        
        <link rel="stylesheet" href="assets/css/userstyle.css" />
        <script type="text/javascript">
			function call(){
				var con;
		    	con = confirm("Do you really want to delete!");
				return con;
			}
		</script>
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
            <a href="change_profile_picture.php"> <button type="button" name="button" style="margin-left: 1015px; margin-top: -100px; height: 30px; cursor: pointer;">Change Profile Picture</button></a>
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

        <div class="login-blockk color query user_profile">
            <h1>ENGINEER DETAILS</h1>
        </div>
         <a href="add_engineer.php"><button class="abc">Add</button></a>
        <?php
        $query = "select * from engineer";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            if(mysqli_num_rows($query_run)>0)
            {
                echo '<table style="width: 100%; line-height: 30px;  margin: 0px 0px; overflow-x:auto; font-size: 20px; color: rgba(0,0,0,0.65);">';
                echo '<tr>';
                echo '<th style="margin: 2px;">Engineer_id</th>';
                echo '<th style="margin: 2px;"> Engineer Name </th>';
                echo '<th style="margin: 2px;"> Email </th>';
                echo '<th style="margin: 2px;"> Phone Number </th>';
                echo '<th style="width: 200px; margin: 2px;"> Address </th>';
                echo '<th style="margin: 2px;"> City </th>';
                echo '<th style="margin: 2px;"> State </th>';
                echo '<th style="margin: 2px;"> Country </th>';
                echo '<th style="margin: 2px;"> Pincode</th>';
                echo '<th style="margin: 2px;"> Action</th>';
                echo '</tr>';
                while($row = mysqli_fetch_array($query_run))
                {
                    $_SESSION['en_id'] = $row['engineer_id'];
                    echo '<tr>';
                    echo '<td style="text-align: center; margin: 2px;">'.$row['engineer_id'].'</td>';
                    echo '<td style="text-align:center; margin: 2px;">'.$row['name'].'</td>';
                    echo '<td style="text-align:center; margin: 2px;">'.$row['email'].'</td>';
                    echo '<td style="text-align:center; margin: 2px;">'.$row['contact_no'].'</td>';
                    echo '<td style="text-align:center; width: 200px; margin: 2px;">'.$row['address'].'</td>';
                    echo '<td style="text-align:center; margin: 2px;">'.$row['city'].'</td>';
                    echo '<td style="text-align:center; margin: 2px;">'.$row['state'].'</td>';
                    echo '<td style="text-align:center; margin: 2px;">'.$row['country'].'</td>';
                    echo '<td style="text-align:center; margin: 2px;">'.$row['pincode'].'</td>';
                    echo '<td style="text-align:center; margin: 2px;"><a href="delete_engineer.php?id='.$row['engineer_id'].'" onsubmit= "call();"><button name="delete" class="abcd">Delete</button></a></td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
        else
        {
            echo '<script type="text/javascript"> alert("Error in query")</script>';
        }
        ?>
    </body>
</html>