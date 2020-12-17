<?php
session_start();
require 'dbconfig/config.php';
$id = $_GET['id']; 
$veri_code = $_POST['veri_code'];
$query4 = "select * from enquiry_table where enquiry_id = $id";
$run = mysqli_query($con, $query4);
if($run)
{
	$fetch = mysqli_fetch_array($run, MYSQLI_ASSOC);
	$code = $fetch['code'];
	if($veri_code == $code)
	{
		$int =2;
		$qry1 = "update enquiry_table set status = $int where enquiry_id = $id";
		$qry_run1 = mysqli_query($con, $qry1);
		if($qry_run1)
		{
			header('location: dashboard.php');
		}
		else
		{
			echo 'jh';
		}
	}
}
?>