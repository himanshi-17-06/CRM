<?php
	$to = 'himanshi.varshney56@gmail.com';
    $subject = 'LOCALHOST SUBJECT';
	$message = 'send from localhost';
	$headers = 'From: onlyfortest17@gmail.com';
if(mail($to, $subject, $message, $headers))
	echo "Email Sent";

else
	echo "email sending failed";

	
?>