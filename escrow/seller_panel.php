<?php
if (!$seTxID or !$sellerID){
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
				<p><i>Please wait since the checking is completed. You will receive an email if it is done. </i></p>
				<p></p>
				<p><i><b>Reason:</b> <?php print file_get_contents("human.txt"); ?></i></p>
				
				<?php exit(); } ?>
				
				<p>(raccomanded to open) <a href="javascript:alert('Make sure you have popup enabled or you cannot see the chat!')" onClick="popup('http://escrow.bitscrow.one/transaction_panel.php?page=chat');">CHAT</a></p>
				
				<?php if (!file_get_contents("transactions/".$seTxID."/deposit_ready.txt")){ header ("Refresh: 3; URL=?page=home"); ?>
				
				<p><b><font color="red">Do not upload anything</font></b></p>
				<p><i>The buyer hasn't deposited or the deposit has not enought confirmations. You will receive an email once the deposit is done.</i></p>
				
				<?php
				} elseif (file_get_contents("transactions/".$seTxID."/deposit_ready.txt") and !file_get_contents("transactions/".$seTxID."/product_upload.txt")){
				?>
				
				<p><b>DEPOSIT READY. NEED TO UPLOAD THE PRODUCT.</b></p>
				<p><i>The user's deposit completed. Now you need to upload your product, then the escrow will be released.</i></p>
				<p><a href="?page=upload">Upload!</a></p>
				<p><i>YOU HAVE 48 HOURS TO UPLOAD TRACKING INFORMATIONS (IN CASE OF SHIPPING) OR THE PRODUCT (IN CASE OF A FILE OR SOFTWARE), after that we give the money back to the user and the transaction ends.</i></p>
				
				<?php } elseif (file_get_contents("transactions/".$seTxID."/deposit_ready.txt") and file_get_contents("transactions/".$seTxID."/product_upload.txt") and !file_get_contents("transactions/".$seTxID."/review.txt") { ?>
					
				<p><b>WAITING FOR THE BUYER'S REVIEW</b></p>
				<p><i>Now we are going to wait that the buyer reviews your product. In case of a digital file or software, the user has 24 hours to review, if it does not review we will release the money instantly. Instead, if it is a product that needs shipping, we release the money once the courier confirms the delivery.</i></p>
				<p>Now wait for the email that confirms that the review is gived.</p>
					
				<?php } elseif (file_get_contents("transactions/".$seTxID."/deposit_ready.txt") and file_get_contents("transactions/".$seTxID."/product_upload.txt") and file_get_contents("transactions/".$seTxID."/review.txt") == "This product works fine." and !file_get_contents("transactions/".$seTxID."/escrowed.txt") { ?>
					
				<p><b>YOU CAN GET THE ESCROW!</b></p>
				<p><i>The user gived a positive review. You can get the escrow.</i></p>
				<p><a href="?page=withdraw">WITHDRAW!</a></p>
					
				<?php }elseif (file_get_contents("transactions/".$seTxID."/deposit_ready.txt") and file_get_contents("transactions/".$seTxID."/product_upload.txt") and file_get_contents("transactions/".$seTxID."/review.txt") == "This product works fine." and file_get_contents("transactions/".$seTxID."/escrowed.txt") { ?>
					
				<p><b>TRANSACTION FINISHED</b></p>
				<p>Thanks for using BitScrow!</p>
				<a href="https://bitscrow.one/">Homepage</a>
					
				<?php } ?>
			</center>
		</div>
	</body>
</html>

<?php
} elseif ($page == "chat") {
	include "seller_tools/chat.php";
} elseif ($page == "upload") {
	include "seller_tools/upload.php";
} elseif ($page == "start_upload") {
	include "seller_tools/start_upload.php";
} elseif ($page == "withdraw") {
	include "seller_tools/withdraw.php";
}
?>
