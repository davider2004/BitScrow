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
				<h4>LOGIN</h4>
				<p></p>
				<?php
				if ($_GET['checkInbox']){
					echo "<p><b>Check your email! There is your ID!</b></p>";
				}
				?>
				<form method="POST" action="proceed.php">
					<p><i>* Mondadory ; ** One of the two fields</i></p>
					<p><b>seTxID *</b> <input type="text" value="<?php print $_GET['seTxID']; ?>" id="seTxID" name="seTxID"></p>
					<p><b>buyerID **</b> <input type="text" id="buyerID" name="buyerID"></p>
					<p><b>sellerID **</b> <input type="text" id="sellerID" name="sellerID"></p>
					<p><input type="submit" value="Login" name="submit" id="submit"></p>
				</form>
			</center>
		</div>
	</body>
</html>

