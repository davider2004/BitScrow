<?php
session_start();

date_default_timezone_set('GMT'); 
$today = date('Y-m-d H:i:s');
$today1 = date('Y-m-d');

$who = $_SESSION['who'];

$seller_email = $_SESSION['seller_email'];
$buyer_email = $_SESSION['buyer_email'];

$product_name = $_SESSION['product_name'];
$product_desc = $_SESSION['product_desc'];
$product_price = $_SESSION['product_price'];

$btc_address = $_SESSION['btc_address'];

$fees = $_SESSION['fees'];

if (!$who or !$seller_email or !$buyer_email or !$product_name or !$product_desc or !$product_price or !$btc_address or !$fees) {
	exit ("Missing Fields. <a href=index.php>Retry</a>");
}else{
	$rand = rand(1,503384675896758293074563789370934675946793407);
	
	$heTxID = md5(hash('sha512', md5(uniqid(rand))));
	$seTxID = md5(hash('sha512', md5(uniqid(rand))));
	$buyerID = md5(hash('sha512', md5($heTxID-$rand)));
	$sellerID = md5(hash('sha512', md5($heTxID-$rand*$rand-2)));
	
	$folderName = "transactions/".$seTxID;
	
	$mdir = mkdir($folderName,0777,true);
	
	if (!$mdir){
		exit ("<h1>UNABLE TO CREATE TRANSACTION FOLDER. <a href=reset.php>Reset and retry</a></h1>");
	}else{
		$x = fopen ( $folderName."/index.php" , "a+" );
		$xw = fwrite ( $x , "403 Forbidden" );
		fclose( $x );
		
		$f = fopen ( $folderName."/".$heTxID.".txt" , "a+" );
		$fw = fwrite ( $f , $heTxID."-".$seTxId );
		fclose( $f );
		
		$q = fopen ( $folderName."/".$seTxID."-".$buyerID.".txt" , "a+" );
		$qw = fwrite ( $q , $buyerID."-".$buyer_email );
		fclose( $q );
		
		$w = fopen ( $folderName."/".$seTxID."-".$sellerID.".txt" , "a+" );
		$ww = fwrite ( $w , $sellerID."-".$seller_email );
		fclose( $w );
		
		$p = fopen ( $folderName."/product_name.txt" , "a+" );
		$pw = fwrite ( $p , $product_name );
		fclose ( $p );
		
		$c = fopen ( $folderName."/product_desc.txt" , "a+" );
		$cw = fwrite ( $c , $product_desc );
		fclose ( $c );
		
		$a = fopen ( $folderName."/product_price.txt" , "a+" );
		fwrite ( $a , $product_price );
		fclose ( $a );
		
		$d = fopen ( $folderName."/payout_addr.txt" , "a+" );
		$dw = fwrite ( $d , $btc_address );
		fclose ( $d );
		
		$s = fopen ( $folderName."/fees.txt" , "a+" );
		$sw = fwrite ( $s , $fees );
		fclose ( $s );
		
		$r = fopen ( $folderName."/chat.txt" , "a+" );
		$rw = fwrite ( $r , "[CHAT STARTED]\r\n" );
		fclose ( $r );
		
		$h = fopen ( $folderName."/time.txt" , "a+" );
		$hw = fwrite ( $h, $today );
		fclose ( $h );
		
		$j = fopen ( $folderName."/time_d.txt" , "a+" );
		$jw = fwrite ( $j, $today1 );
		fclose ( $j );
		
		$k = fopen ( $folderName."/seller_email.txt" , "a+" );
		$kw = fwrite ( $k, $seller_email );
		fclose ( $kw );
		
		$s = fopen ( $folderName."/buyer_email.txt" , "a+" );
		$sw = fwrite ( $s, $buyer_email );
		fclose ( $sw );
		
		// $f and $q and $w and $p and $c and $a and $d and $s and $r and $h and //$j and $fw and $qw and $ww and $pw and $cw and $aw and $dw and $sw //and $rw and $hw and $jw and $x and $xw and $k and $kw and $s and $sw
		if ( true ){
			$message1line = "Hi ". $buyer_email .",\r\nThe seller ". $seller_email ." started an escrow transaction with you. Please login to the transaction using this data:\r\n\r\nLogin on: https://escrow.bitscrow.one/login.php\r\nShowed eTXID: ". $seTxID ."\r\nBuyer ID: ". $buyerID ."\r\n\r\nIf you have not done this transaction go to https://escrow.bitscrow.one/delete.php?seTxID=". $seTxID ."&buyerID=". $buyerID."\r\nBye, \r\nBitScrow Team\r\n\r\n-- THIS EMAIL IS REAL --\r\nBID: ". $buyerID ."\r\nSETXID: ". $seTxID;
			$message2line = "Hi ". $seller_email .", \r\nyou have created a transaction with the buyer ". $buyerID ." on BitScrow. Please login in the transaction:\r\n\r\nLogin on: https://escrow.bitscrow.one/login.php\r\nShowed eTXID: ". $seTxID ."\r\nSeller ID: ". $sellerID ."\r\n\r\nIf you have not done this transaction go to https://escrow.bitscrow.one/delete.php?seTxID=". $seTxID ."&sellerID=". $sellerID ."\r\nBye, \r\nBitScrow Team\r\n\r\n-- THIS EMAIL IS REAL --\r\nSID: ". $sellerID ."\r\nSETXID: ". $seTxID;
			
			$mail_buyer = mail($buyer_email, "Your escrow transaction details", $message1line,
			"From: BitScrow Escrow Services <no-reply@bitscrow.one>\r\n" .
			"Reply-To: BitScrow Escrow Services - EscrowTX Support Team <support@bitscrow.one>\r\n" .
			"X-Mailer: PHP/" . phpversion());
			
			$mail_seller = mail($seller_email, "Your escrow transaction details", $message2line,
			"From: BitScrow Escrow Services <no-reply@bitscrow.one>\r\n" .
			"Reply-To: BitScrow Escrow Services - EscrowTX Support Team <support@bitscrow.one>\r\n" .
			"X-Mailer: PHP/" . phpversion());
			
			if ($mail_buyer and $mail_seller){
				header("Refresh: 4.5; URL=login.php?seTxID=".$seTxID."&checkInbox=1");
			}else{
				exit ( "<h1>Process failed <a href=reset.php>Retry</a></h1>" );
			}
		}else{
			
		}
	}
}
?>

<html>
	<head>
		<title>BitScrow | ESCROW TRANSACTION</title>
		
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet" type="text/css" href="/BitScrow/assets/css/escrow.css">
	</head>
	<body>
		<div id="bitscrow.index" class="bitscrow.index.div">
			<center>
				<h1>BitScrow</h1>
				<h4>Creating transaction..</h4>
				<p></p>
				<img src="/BitScrow/images/loading.gif">
				<p>Creating the transaction.. Please wait..</p>
			</center>
		</div>
	</body>
</html>

