<?php
require 'dbconfig/config.php';
session_start();
if(empty($_SESSION['imglink']))
{
	header('location: engineerlogin.php');
}

?>
<!doctype html>
<html>
    <head>
        <title>CRM</title>
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
                    <li><a href=""><?php echo $_SESSION['name']; ?></a>
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
		<div class="login-blockk color query user_profile">
            <h1>ENQUIRY DETAILS</h1>
        </div>
		<?php
		$eng_id = $_SESSION['eng_id'];
		$query = "select * from enquiry_table where engineer_id = $eng_id ";
		$query_run = mysqli_query($con, $query);
		if($query_run)
		{
			if(mysqli_num_rows($query_run)>0)
			{
				 echo '<table style="width: 100%; line-height: 30px;  margin: 0px 0px; overflow-x:auto; font-size: 20px; color: rgba(0,0,0,0.65);">';
                echo '<tr>';
                echo '<th style="margin: 2px;">Enquiry_id</th>';
                echo '<th style="margin: 2px;"> Customer Name </th>';
             //   echo '<th style="margin: 2px;"> Email </th>';
                echo '<th style="margin: 2px; width: 400px;"> Description </th>';
               // echo '<th style="margin: 2px; width: 250px;"> Address </th>';
         //       echo '<th style="margin: 2px;"> Phone Number </th>';
          //      echo '<th style="margin: 2px;"> Engineer Name </th>';
                echo '<th style="margin: 2px;"> Code Verification</th>';
                echo '<th style="margin: 2px; width: 150px;"> Status </th>';
                //echo '<th style="margin: 2px;"> Pincode</th>';
                echo '<th style="margin: 2px; width: 250px;"> Customer Details</th>';
                echo '</tr>';
				while($rows = mysqli_fetch_array($query_run))
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
					$enq_id = $rows['enquiry_id'];
					//$_SESSION['enq_id'] = $rows['enquiry_id'];
					$desc = $rows['description'];
					$cus_id = $rows['customer_id'];
					$qry = "select * from userinfotable where customer_id = $cus_id";
					$run = mysqli_query($con, $qry);
					if($run)
					{
						$row = mysqli_fetch_array( $run);
						$name = $row['username'];
					}
					else
                    {
                        echo '<script type="text/javascript"> alert("Error in query 2!")</script>';
                    }
					echo '</tr>';
					echo '<td style="text-align: center; margin: 2px;">'.$enq_id.'</td>';
                    echo'<td style="text-align: center; margin: 2px;">'.$name.'</td>';
                    echo '<td style="margin: 2px; text-align: center; width: 400px;">'.$desc.'</td>';
					if($rows['status']==1)
					{
						echo '<td style="margin: 2px; ">'?>
						<form  action="verify.php?id=<?php echo $enq_id;?>" method="post">
						<input type="text" style="width:120px; border-radius: 5px;" name="veri_code" />
					<!--	<a href="verify.php?id=<?php// echo $enq_id; ?>&veri_code=<?php //if(isset($_POST['verify']))
						//{
						//$co = $_POST['veri_code'];
						//echo $co;
				   	 //   }
					   ?>">-->
					   	<input type="submit" style="width: 100px; border-radius: 5px; margin-left: 5px; font-size: 15px; text-decoration: none; cursor: pointer;" name="verify" value="Verify"><!--</a>-->
						</form>
						<?php echo '</td>';
						//$_SESSION['ver_code'] = $_POST['veri_code'];
					}
					else
					{
						echo '<td style="margin: 2px; color: red; text-align: center;">Enquiry is closed</td>';
					}
                    echo '<td style="text-align:center; margin: 2px; color: red; width: 150px;">'.$status.'</td>';
                     echo '<td style="text-align:center; margin: 2px; width: 250px;"><a href="customer_detail.php?id= '.$cus_id.'"><button name="edit" class="abcd" style="width: 100px;">Click Here</button></a>
                    </td>';
                    echo '</tr>';       
				}
				 echo '</table>';
			}
			
		}
		else
		{
			echo '<script type="text/javascript">alert("Error in query")</script>';
		}
		?>
   
	
    </body>
</html>