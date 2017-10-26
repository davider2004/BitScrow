<?php
session_start();
session_destroy();

header("Refresh: 4.2; URL=/BitScrow");
?>

<html>
	<head>
		<title>BitScrow | Resetting data</title>
		
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet" type="text/css" href="/BitScrow/assets/css/escrow.css">
	</head>
	<body>
		<div id="bitscrow.index" class="bitscrow.index.div">
			<center>
				<h1>BitScrow</h1>
				<h4>Resetting data</h4>
				<p></p>
				<img src="/BitScrow/images/loading.gif">
				<p>We are removing all data.. Please wait..</p>
			</center>
		</div>
	</body>
</html>

