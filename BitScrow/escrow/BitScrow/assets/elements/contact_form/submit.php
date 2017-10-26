<?php
session_start();

date_default_timezone_set('Europe/Rome'); // <-- My timezone

$refURI = $_SERVER['HTTP_REFERER'];
$ip = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$today = date('Y-m-d H:i:s');

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

if (!$name or !$email or !$message){
	echo "<font color=red><b>Message cannot be empty.</b></font> <a href=?form=show>Retry</a>.";
}else{
	if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		$_SESSION['err'] = "Only letters and white space allowed!";
		$_SESSION['MsgColor'] = "red";
		
		header("Location: ?form=print_msg");
		
		echo "<font color=red><b>Only letters and white space allowed!</b></font> <a href=?form=show>Retry</a>.";
	}else{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['err'] = "Invalid email format!";
			$_SESSION['MsgColor'] = "red";
		
			header("Location: ?form=print_msg");
		
			echo "<font color=red><b>Invalid email format!</b></font> <a href=?form=show>Retry</a>.";
		}else{
			$message1line = "Hi ". $name .",\r\nWe have received your support request you sent from our form on BitScrow.org. \r\nWe will reply to you ASAP in average 24-48 hours. \r\n \r\nBye,\r\nBitScrow.org \r\n\r\n\r\nIF YOU HAVE NOT SENT THIS EMAIL OR YOU ALREADY FIND THE SOLUTION YOURSELF REPLY TO THIS EMAIL WITH -- STOP_TICKET -- AND WE STOP YOUR TICKET.";
			$message2line = "-- RECEIVED SUPPORT REQUEST --\r\n\r\n From: ". $name ."<". $email .">\r\nDate: ". $today ."\r\nIP: ". $ip ."\r\nUseragent: ". $useragent ."\r\n\r\n". $message;
			
			$mail1 = mail($email, "We have received your request", $message1line,
			"From: BitScrow Escrow Services <no-reply@bitscrow.one>\r\n" .
			"Reply-To: BitScrow Escrow Services - Support Team <support@bitscrow.one>\r\n" .
			"X-Mailer: PHP/" . phpversion());
			
			$mail2 = mail("support@bitscrow.one", "SUPPORT REQUEST", $message2line,
			"From: BitScrow SUPPORT REQUEST <no-reply@bitscrow.one>\r\n" .
			"Reply-To: ". $name ."<". $email .">\r\n" .
			"X-Mailer: PHP/" . phpversion());
			
			if ($mail1 and $mail2){
				$_SESSION['err'] = "Email sent with success!";
				$_SESSION['MsgColor'] = "green";
		
				header("Location: ?form=print_msg");
		
				echo "<font color=green><b>Email sent with success!</b></font> <a href=?form=show>Go back</a>.";
			}else{
				$_SESSION['err'] = "Unable to deliver the message.";
				$_SESSION['MsgColor'] = "red";
		
				header("Location: ?form=print_msg");
		
				echo "<font color=red><b>Unable to deliver the message.</b></font> <a href=?form=show>Retry</a>.";
			}
		}
	}
}
