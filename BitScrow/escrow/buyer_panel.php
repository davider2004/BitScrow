<?php
if (!$seTxID or !$buyerID){
	exit();
}

$page = $_GET['page'];

if (!$page or $page == "home"){
?>

<html>
	<head>
		<title>BitScrow Escrow Services</title>
		
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet" type="text/css" href="/BitScrow/assets/css/escrow.css">
		
		<script type="text/javascript" src="js/cookie.js">
			var expdate = new Date();
			var done = alert("Make sure that you have enabled the popup window!");
			expdate.setTime(expdate.getTime() +  (24 * 60 * 60)); 
			SetCookie("verify", done, expdate, "/", null, false);
		</script>
		<script type="text/javascript" src="js/popup.js"></script>
	</head>
	<body>
		<div id="bitscrow.index" class="bitscrow.index.div">
			<center>
				<h1>BitScrow</h1>
				<h4>BUYER PANEL</h4>
				<p><b>WHERE YOU WANT TO GO?</b></p>
				
				<?php if (file_exists("transactions/".$seTxID."/human.txt")){
				?>
				
				<p><b><font color="red">THERE IS AN ADMIN INTERVETION ACTIVE!</font></b></p>
				<p><i>Please wait since the checking is completed. You will receive an email if it is done. Your money is safe in our escrow.</i></p>
				<p></p>
				<p><i><b>Reason:</b> <?php print file_get_contents("human.txt"); ?></i></p>
				
				<?php exit(); } ?>
				
				<p>(raccomanded to open) <a href="javascript:alert('Make sure you have popup enabled or you cannot see the chat!')" onClick="popup('http://escrow.bitscrow.one/transaction_panel.php?page=chat');">CHAT</a></p>
				<?php
				if (!file_get_contents("transactions/".$seTxID."/deposit_status.txt")){
				?>
				
				<p>(open) <a href="?page=deposit">Buy the product</a></p>
				<p><i>REMEMBER -> You need to deposit first the money to the escrow, after you verified that the product works, we send the money to the seller.</i></p>
				<p><i>THE SELLER NEVER GIVES YOU THE PRODUCT IF YOU DO NOT DEPOSIT TO THE ESCROW.</i></p>
				
				<?php
				}elseif (file_get_contents("transactions/".$seTxID."/deposit_status.txt") and !file_get_contents("transactions/".$seTxID."/deposit_ready.txt") and !file_get_contents("transactions/".$seTxID."/product_upload.txt")){
					header("Refresh: 5; URL=&rt=1");
				?>
				
				<p><b>Waiting for deposit confirmation</b></p>
				<p><i>You will receive an email when your deposit reach confirmations..</i></p>
				
				
				<?php
				}elseif (file_get_contents("transactions/".$seTxID."/deposit_status.txt") and file_get_contents("transactions/".$seTxID."/deposit_ready.txt") and !file_get_contents("transactions/".$seTxID."/product_upload.txt")){
				?>
				
				<p><b>PROCESS DONE. Now we are going to wait the seller for uploading the product (or in case of shipping, tracking details)</b></p>
				<p>If you are seeing this for more than 24 hours, <a href="?page=report_seller">click here</a> and we will give you the money back</p>
				
				<?php
				}elseif (file_get_contents("transactions/".$seTxID."/deposit_status.txt") and file_get_contents("transactions/".$seTxID."/product_upload.txt") and !file_get_contents("review.txt")) {
				?>
				
				<p><b>It's time for you to <a href="?page=review">review the product</a>.</b></p>
				<p><i>If you haven't the product yet, <a href="?page=download" target="_blank">click here to download</a></i></p>
				
				<?php
				}elseif (file_get_contents("transactions/".$seTxID."/deposit_status.txt") and file_get_contents("transactions/".$seTxID."/product_upload.txt") and file_get_contents("review.txt") and !file_get_contents("human.txt")) {
				?>
				
				<p><b>You finished the transaction. Now you are done. </b></p>
				<p><i><b>Your review: </b> <?php print file_get_contents("transactions/".$seTxID."/review.txt"); ?></i></p>
				<p><i>You can now only <a href="?page=download">download the files</a>.</i></p>
				
				<?php
				}elseif (file_get_contents("transactions/".$seTxID."/deposit_status.txt") and file_get_contents("transactions/".$seTxID."/product_upload.txt") and file_get_contents("review.txt") and file_get_contents("human.txt")) {
				?>
				
				<p><b><font color="red">THERE IS AN ADMIN INTERVETION ACTIVE!</font></b></p>
				<p><i>Please wait since the checking is completed. You will receive an email if it is done. Your money is safe in our escrow.</i></p>
				<p></p>
				<p><i><b>Reason:</b> <?php print file_get_contents("human.txt"); ?></i></p>
				
				<?php
				}
				?>
			</center>
		</div>
	</body>
</html>

<?php
} elseif ($page == "chat") {
	include "buyer_tools/chat.php";
} elseif ($page == "deposit") {
	include "buyer_tools/deposit.php";
} elseif ($page == "proceed_pay") {
	include "buyer_tools/pay.php";
} elseif ($page == "report_seller") {
	include "buyer_tools/report_seller.php";
} elseif ($page == "confirm_report") {
	include "buyer_tools/confirm_report.php";
} elseif ($page == "download") {
	include "buyer_tools/download.php";
} elseif ($page == "review") {
	include "buyer_tools/review.php";
}
?>
