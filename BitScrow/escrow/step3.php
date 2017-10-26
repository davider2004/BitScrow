<?php
session_start();

$who = $_SESSION['who'];

$seller_email = $_POST['email'];
$buyer_email = $_POST['buyer_email'];

$product_name = $_POST['product_name'];
$product_desc = $_POST['product_desc'];
$product_price = $_POST['product_price'];

$btc_address = $_POST['btc_address'];

$fees = $_POST['fees'];

if (!$who or !$seller_email or !$buyer_email or !$product_name or !$product_desc or !$product_price or !$btc_address or !$fees){
	exit("<h1>MISSING FIELDS. <a href=index.php>Retry</a></h1>");
}else{
	if (!$who == "buyer" and !$who == "seller"){
		exit("<h1>ERROR. <a href=index.php>Retry</a></h1>");
	}else{
		$_SESSION['who'] = $who;
	}
	
	if (!filter_var($seller_email, FILTER_VALIDATE_EMAIL) or !filter_var($buyer_email, FILTER_VALIDATE_EMAIL)){
		exit("<h1>INVALID EMAIL FORMAT. <a href=index.php>Retry</a></h1>");
	}else{
		$_SESSION['seller_email'] = $seller_email;
		$_SESSION['buyer_email'] = $buyer_email;
	}
	
	if (!$product_name or !$product_desc or !is_numeric($product_price)){
		exit("<h1>INVALID PRODUCT DATA. <a href=index.php>Retry</a></h1>");
	}else{
		$_SESSION['product_name'] = $product_name;
		$_SESSION['product_desc'] = $product_desc;
		$_SESSION['product_price'] = str_replace(",",".",$product_price);
	}
	
	$_SESSION['btc_address'] = $btc_address;
	
	if (!$fees == "buyer" or !$fees == "seller" or !$fees == "both"){
		exit("<h1>ERROR. <a href=index.php>Retry</a></h1>");
	}else{
		$_SESSION['fees'] = $fees;
	}
	
	if ($seller_email == $buyer_email){
		exit("<h1>SCAM TRY. <a href=index.php>Retry</a></h1>");
	}
	
	header ("Refresh: 4.5; URL=confirm.php");
}
?>

<html>
	<head>
		<title>BitScrow | Start escrow</title>
		
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet" type="text/css" href="/BitScrow/assets/css/escrow.css">
	</head>
	<body>
		<div id="bitscrow.index" class="bitscrow.index.div">
			<center>
				<h1>BitScrow</h1>
				<h4>Run a transaction [STEP 3]</h4>
				<p></p>
				<img src="/BitScrow/images/loading.gif">
				<p><b>We are checking your informations.. Please wait a while..</b></p>
			</center>
		</div>
	</body>
</html>

