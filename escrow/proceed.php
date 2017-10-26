<?php
session_start();

$submit = $_POST['submit'];

$seTxID = $_POST['seTxID'];

$buyerID = $_POST['buyerID'];
$sellerID = $_POST['sellerID'];

$a = 1;

if (!$a){
	exit ( "System failure -> auth.bitscrow.org do not found a proper request from the service. Please retry." );
}else{
	if (!$seTxID){
		exit ( "System failure -> No seTxID found. Retry. (you can find it in your email)" );
	}else{
		if (!$buyerID and !$sellerID){
			exit ( "System failure -> Missing BuyerID or SellerID. Check your inbox for this data!" );
		}else{
			$folderName = "transactions/".$seTxID;
			
			if (!file_exists($folderName)){
				exit ( "Login failed -> The SeTxID is not valid!" );
			}else{
				if ($buyerID and !$sellerID){
					$buyerID_file = $folderName."/".$seTxID."-".$buyerID.".txt";
					
					if (!file_exists($buyerID_file)){
						exit ( "Login failed -> Invalid buyerID" );
					}else{
						$_SESSION['seTxID'] = $seTxID;
						$_SESSION[$seTxID] = "ready_buyer";
						$_SESSION[$seTxID."-buyer"] = $buyerID;
						
						header("Refresh: 3; URL=transaction_panel.php");
					}
				}elseif (!$buyerID and $sellerID){
					$sellerID_file = $folderName."/".$seTxID."-".$sellerID.".txt";
					
					if (!file_exists($sellerID_file)){
						exit ( "Login failed -> Invalid buyerID" );
					}else{
						$_SESSION['seTxID'] = $seTxID;
						$_SESSION[$seTxID] = "ready_seller";
						$_SESSION[$seTxID."-seller"] = $sellerID;
						
						header("Refresh: 3; URL=transaction_panel.php");
					}
				}
			}
		}
	}
}

?>

<html>
	<head>
		<title>BitScrow | Login</title>
		
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet" type="text/css" href="/BitScrow/assets/css/escrow.css">
	</head>
	<body>
		<div id="bitscrow.index" class="bitscrow.index.div">
			<center>
				<h1>BitScrow</h1>
				<h4>Please wait..</h4>
				<img src="/BitScrow/images/loading.gif">
				<p><b>We are logging you into the system.. Please wait..</b></p>
			</center>
		</div>
	</body>
</html>

