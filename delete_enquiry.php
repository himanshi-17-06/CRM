<?php
session_start();
require 'dbconfig/config.php';
//$enq_id = $_SESSION['en_id'];

$id = $_GET['id'];
echo "<script type='text/javascript'>confirm('Do you really want to delete')</script>";
$query = "delete from enquiry_table where enquiry_id = $id";
$query_run = mysqli_query ($con, $query);
if($query_run)
{
    echo "<script type='text/javascript'> alert('Successfully Deleted!')</script>";
    header("location: enquiry_details.php");
}
else
{
    echo '<script type="text/javascript"> alert("Error in query!")</script>'; 
    header("location: enquiry_details.php");
}
?>