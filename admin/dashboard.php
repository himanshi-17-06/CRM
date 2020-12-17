<!doctype html>
<?php
require 'dbconfig/config.php';
session_start();
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
			confirm("Do you really want to delete!")
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
           <!--  <a href="enquiry_form.html"><button class="abc">New Enquiry</button></a>-->
        <div class="login-blockk color query user_profile">
            <h1>ENQUIRY DETAILS</h1>
        </div>
        <?php
        $query= "select * from enquiry_table";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            if(mysqli_num_rows($query_run)>0)
            {
                echo '<table style="width: 100%; line-height: 30px;  margin: 0px 0px; overflow-x:auto; font-size: 20px; color: rgba(0,0,0,0.65);">';
                echo '<tr>';
                echo '<th style="margin: 2px;">Enquiry_id</th>';
                echo '<th style="margin: 2px;"> Customer Name </th>';
                echo '<th style="margin: 2px;"> Email </th>';
                echo '<th style="margin: 2px; width: 200px;"> Description </th>';
               // echo '<th style="margin: 2px; width: 250px;"> Address </th>';
                echo '<th style="margin: 2px;"> Phone Number </th>';
                echo '<th style="margin: 2px;"> Engineer Name </th>';
                echo '<th style="margin: 2px;"> Code</th>';
                echo '<th style="margin: 2px; width: 100px;"> Status </th>';
                //echo '<th style="margin: 2px;"> Pincode</th>';
                echo '<th style="margin: 2px; width: 150px;"> Action</th>';
                echo '</tr>';
                while($rows=mysqli_fetch_array($query_run))
                {
                    if($rows['status']==0)
                        {
                            $status = "pending";
                        }
                    else if($rows['status']==1)
                        {
                            $status = "processing";
                        }
                    else
                        {
                            $status = "closed";
                        }
                    $eng_id = $rows['engineer_id'];
                    if($eng_id ==0)
                    {
                        $eng_name ="-";
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
                    $cus_id = $rows['customer_id'];
                    $query2 = "select * from userinfotable where customer_id = $cus_id";
                    $run = mysqli_query($con, $query2);
                    if($run)
                    {
                        if(mysqli_num_rows($run)>0)
                        {
                            $row = mysqli_fetch_array($run, MYSQLI_ASSOC);
                        }
                    }
                    else
                    {
                        echo '<script type="text/javascript"> alert("Error in query 2!")</script>';
                    }
                    echo '<tr>';
                    echo '<td style="text-align: center; margin: 2px;">'.$rows['enquiry_id'].'</td>';
                    echo'<td style="text-align: center; margin: 2px;">'.$row['username'].'</td>';
                    echo'<td style="text-align: center; margin: 2px;">'.$row['email'].'</td>';
                    echo '<td style="margin: 2px; text-align: center; width: 200px;">'.$rows['description'].'</td>';
                    echo '<td style="text-align: center; margin: 2px;">'.$row['contact_no'].'</td>';
                    
                    echo '<td style="text-align:center; margin: 2px;">'.$eng_name.'</td>';
                    echo '<td style=" text-align: center; margin: 2px;">'.$rows['code'].'</td>';
                    echo '<td style="text-align:center; margin: 2px; color: red; width: 100px;">'.$status.'</td>';
                    echo '<td style="text-align:center; margin: 2px;"><a href="edit_enquiry.php?id= '.$rows['enquiry_id'].'"><button name="edit" class="abcd" style="width: 60px;">Edit</button></a>
                    <a href="delete_enquiry.php?id= '.$rows['enquiry_id'].'"><button name="delete" class="abcd" style="width: 70px;">Delete</button></a>
                    </td>';
                    echo '</tr>';
                    
                }
                echo '</table>';
            }
        }
        else
        {
            echo '<script type="text/javascript"> alert("Error in Query!")</script>';
        }  
        ?>
    </body>
</html>