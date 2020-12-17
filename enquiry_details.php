<?php
session_start();
if(empty($_SESSION['username'])){
header('Location: login.php');
}

require 'dbconfig/config.php';
?>
<!doctype html>
<html>
    <head>
        <title>CRM</title>
        <link rel="stylesheet" href="assets/css/userstyle.css" />
        <script type="text/javascript">
			function call(){
			confirm("Do you really want to delete!");
				return false;
			}
		</script>
    </head>
    <body>
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
                    <li><a href=""><?php echo $_SESSION['username'] ?>  </a>
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
        <a href="enquiry_form.php"><button class="abc">New Enquiry</button></a>
        <div class="login-blockk color query user_profile">
            <h1>ENQUIRY DETAILS </h1>
     
        
        <?php
            $email= $_SESSION['email'];
            $query = "select * from userinfotable where email='$email'";
            $query_run = mysqli_query($con, $query);            
            if($query_run)
            {
                if(mysqli_num_rows($query_run)>0)
                {
                    $row = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
                    $customer_id = $row['customer_id'];
                }
                else
                {
                    echo '<script type="text/javascript"> alert("No record found!")</script>';
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("Error in query")</script>';
            }
            $query = "select * from enquiry_table where customer_id = $customer_id";
            $query_run = mysqli_query($con,$query);
            if($query_run)
            {
                if(mysqli_num_rows($query_run)>0)
                { 
                    echo '<table>
            <tr>
                <th>Enquiry_id</th>
                <th class="desc" style="padding-left:15px; ">Description</th>
                <th style="padding-left: 15px; width: 100px;">Status</th>
                <th style="padding-left: 15px;">Engineer Name</th>
                <th style="padding-left:15px;">Code</th>
                <th style="padding-left: 15px;">Action</th>
            </tr>';
                    while($row= mysqli_fetch_array($query_run))
                    {
                        
                        if($row['status']==0)
                        {
                            $status = "pending";
                        }
                        else if($row['status']==1)
                        {
                            $status = "processing";
                        }
                        else
                        {
                            $status = "closed";
                        }
                        $eng_id = $row['engineer_id'];
                        if($eng_id == 0)
                        {
                            $eng_name = "-";
                        }
                        else
                        {
                            $qry = "select * from engineer where engineer_id = $eng_id";
                            $qry_run = mysqli_query($con, $qry);
                            if($qry_run)
                            {
                                $fetch = mysqli_fetch_array($qry_run, MYSQLI_ASSOC);
                                $eng_name = $fetch['name'];
                            }
                        }
                        echo '<tr>';
                        echo '<td style="text-align: center;">'.$row['enquiry_id'].'</td>';
                        echo '<td class="desc" style="padding-left: 15px; text-align: center;">'.$row['description'].'</td>';
                        echo '<td style="text-align: center; padding-left: 15px; color: red; width: 100px;">'.$status.'</td>';
                        echo '<td style="text-align: center; padding-left: 15px;">'.$eng_name.'</td>';
                        echo '<td style="text-align: center; padding-left: 15px;">'.$row['code'].'</td>';
                        echo '<td style="text-align:center; padding-left= 15px;"><a href="delete_enquiry.php?id='.$row['enquiry_id'].'"><button name="delete" class="abcd">Delete</button></a></td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } 
            }
            else
            {
                 echo '<script type="text/javascript">alert("ERROR IN QUERY!")</script>';
            }
                            
        ?>
        </div>
    </body>
</html>