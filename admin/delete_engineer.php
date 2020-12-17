<?php
session_start();
require 'dbconfig/config.php';
$id = $_GET['id']; 
$query = "delete from engineer where engineer_id = $id";
$query_run = mysqli_query ($con, $query);
if($query_run)
{
    echo '<script type="text/javascript"> alert("Successfully Deleted!")</script>';
    header("location: engineers.php");
}
else
{
  echo '<script type="text/javascript"> alert("Error in query!")</script>'; 
    header("location: engineers.php");
}
?>