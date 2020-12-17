<?php
	
	$mailto = $_POST['mail_to'];
	$mailsub = $_POST['mail_sub'];
	$mailmsg = $_POST['mail_msg'];
	//require 'dbconfig/config.php';
	//require 'PHPMailer-5.2.21/class.phpmailer.php';
	require 'PHPMailer-5.2.21/PHPMailerAutoload.php';
	
	$mail = new PHPMailer();
	$mail ->IsSmtp();
	$mail ->SMTPDebug = 1;
	$mail ->SMTPAuth = true;
	$mail ->SMTPSecure = 'ssl';
	$mail ->Host ="smtp.gmail.com";
	$mail ->Port = 465; //or 587 
	$mail ->IsHTML(true);
	$mail ->Username ="varshneyhimanshi53@gmail.com";
	$mail ->Password = "yourpassword";
	$mail ->SetFrom("varshneyhimanshi53@gmail.com");
	$mail ->Subject = $mailsub;
	$mail ->Body = $mailmsg;
	$mail ->AddAddress($mailto);
	if(!$mail->Send())
	{
		echo "mail not sent";	
	}
	else
	{
		echo "mail sent";
	}
?>