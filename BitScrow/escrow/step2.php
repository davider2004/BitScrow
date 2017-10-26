<?php
session_start();

$who = $_POST['who'];

if (!$who){
	header("Location: index.php?err=1");
}else{
	$_SESSION['who'] = $who;
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
				<h4>Run a transaction [STEP 2]</h4>
				<p></p>
				<form method="POST" action="step3.php">
				<?php
				if ($who == "seller"){
				?>
				<p><b>Your email address</b> <input type="text" name="email" id="email"></p>
				<p><b>Buyer email address</b> <input type="text" name="buyer_email" id="buyer_email"</p>
				<br />
				<p><b>Product name</b> <input type="text" name="product_name" id="product_name"></p>
				<p><b>Product description</b> <textarea name="product_desc" id="product_desc"></textarea></p>
				<p><b>Product price (in BTC)</b> <input type="text" name="product_price" id="product_price"> BTC</p>
				<br />
				<p><b>Payout Bitcoin Address</b> <input type="text" name="btc_address" id="btc_address"></p>
				<br />
				<p><b>Who is going to pay the BitScrow fees?</b></p>
				<select name="fees" id="fees">
					<option value="both">
						Both (most used)
					</option>
					<option value="seller">
						Seller
					</option>
					<option value="buyer">
						Buyer
					</option>
				</select>
				<br />
				<input type="submit" value="Next" id="submit" name="submit">
				<?php } elseif ($who == "buyer") { ?>
				<p><b>WARNING: The seller needs to complete the escrow transaction informations.</b></p>
				<p><b>SO GIVE TO THE SELLER THIS LINK: </b></p>
				<p><i><a href="/BitScrow/start.php">https://bitscrow.one/BitScrow/start.php</a></i></p>
				<p><b>AND LEAVE IT FILLING THE INFORMATIONS.</b></p>
				<p></p>
				<p><a href="/BitScrow">Go back to BitScrow</a></p>
				<?php } ?>
				</form>
			</center>
		</div>
	</body>
</html>
