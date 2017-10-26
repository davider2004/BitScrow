<?php
session_start();

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
}

if ($fees == "both"){
	$s_fees = "Yes";
	$b_fees = "Yes";
	
	$s_fees_pay = (0.0004+0.00002)/2;
	$b_fees_pay = (0.0004+0.00002)/2;
}

if ($fees == "seller"){
	$s_fees = "Yes";
	$b_fees = "No";
	
	$s_fees_pay = 0.0004+0.00002;
	$b_fees_pay = 0;
}

if ($fees == "buyer"){
	$s_fees = "No";
	$b_fees = "Yes";
	
	$s_fees_pay = 0;
	$b_fees_pay = 0.0004+0.00002;
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
				<h3>PLEASE CHECK THE INFORMATIONS!</h3>
				<p><b>USERS INFORMATIONS</b></p>
				<table class="alt">
					<thead>
						<tr>
							<th>User</th>
							<th>Email</th>
							<th>Pay fees?</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td>Seller</td>
						<td><?php print $seller_email; ?></td>
						<td><?php print $s_fees; ?></td>
					</tr>
					<tr>
						<td>Buyer</td>
						<td><?php print $buyer_email; ?></td>
						<td><?php print $b_fees; ?></td>
					</tr>
					</tbody>
				</table>
				<p></p>
				<p><b>PRODUCT INFORMATIONS</b></p>
				<table class="alt">
					<thead>
						<tr>
							<th>Product Name</th>
							<th>Product Description</th>
							<th>Product price (In BTC)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php print $product_name; ?></td>
							<td><?php print $product_desc; ?></td>
							<td><?php print $product_price; ?></td>
						</tr>
					</tbody>
				</table>
				<p></p>
				<b>PAYOUT INFORMATIONS</b>
				<table class="alt">
					<thead>
						<tr>
							<th>Payout to</th>
							<th>Payout Bitcoin Address</th>
							<th>Payout Amount (In BTC)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Seller</td>
							<td><?php print $btc_address; ?></td>
							<td><?php print $product_price; ?></td>
						</tr>
					</tbody>
				</table>
				<p></p>
				<p><b>FEES</b></p>
				<p><b>1. BUYER</b></p>
				<table class="alt">
					<thead>
						<tr>
							<th>Fee for</th>
							<th>Pay it?</th>
							<th>Amount (in BTC)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>BitScrow</td>
							<td><?php print $b_fees; ?></td>
							<td>0.0004 BTC</td>
						</tr>
						<tr>
							<td>Mining fees</td>
							<td><?php print $b_fees; ?></td>
							<td>0.00002 BTC</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2"></td>
							<td><?php print $b_fees_pay; ?></td>
						</tr>
					</tfoot>
				</table>
				<p><i>REMEMBER: If you choose "Both" as fees payment method, the price will be divided in 2!</i></p>
				<p></p>
				<p><b>2. SELLER</b></p>
				<table class="alt">
					<thead>
						<tr>
							<th>Fee for</th>
							<th>Pay it?</th>
							<th>Amount (in BTC)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>BitScrow</td>
							<td><?php print $s_fees; ?></td>
							<td>0.0004 BTC</td>
						</tr>
						<tr>
							<td>Mining fees</td>
							<td><?php print $s_fees; ?></td>
							<td>0.00002 BTC</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2"></td>
							<td><?php print $s_fees_pay; ?></td>
						</tr>
					</tfoot>
				</table>
				<p><i>REMEMBER: If you choose "Both" as fees payment method, the price will be divided in 2!</i></p>
				<p></p>
				<h1>
					<a href="complete.php" onClick="all.submit();">
						<button>
							ALL OK, PROCEED!
						</button>
					</a>
				</h1>
				<p>
					<a href="reset.php" onClick="all.reset();">
						<button>
							NO, RESET ALL!
						</button>
					</a>
				</p>
			</center>
		</div>
	</body>
</html>

