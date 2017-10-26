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
				<h4>Run a transaction</h4>
				<p></p>
				<?php
				if ($_GET['err']){
					include 'errors.php';
					echo "<p>". getErrorMsg($_GET['err']) ."</p>";
				}
				?>
				<form method="POST" action="step2.php">
					<p><b>Who are you?</b></p>
					<select id="who" name="who">
						<option value="seller">Seller</option>
						<option value="buyer">Buyer</option>
					</select>
					<p><input type="submit" value="Proceed" name="submit" id="submit"></p>
				</form>
			</center>
		</div>
	</body>
</html>
