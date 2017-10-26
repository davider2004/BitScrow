<?php
session_start();
session_destroy();

date_default_timezone_set('GMT'); 

function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
    
}

$seTxID = $_GET['seTxID'];
$buyerID = $_GET['buyerID'];
$sellerID = $_GET['sellerID'];

if (!$seTxID){
	exit ( "<h1>Process failed.</h1>Missing <b><i>seTxID</i></b> (showed_escrow_transaction_id)." );
}else{
	if (!$buyerID and !$sellerID){
		exit ( "<h1>Process failed.</h1>Missing <b><i>buyerID</i></b> (buyerID) or <b><i>sellerID</i></b> (sellerID)." );
	}else{
		$folderName = "transactions/".$seTxID;
		
		if (!file_exists($folderName)){
			exit ( "<h1>Process failed.</h1>Errated <b><i>seTxID</i></b> (showed_escrow_transaction_id)." );
		}else{
			if (file_exists($folderName."/paid.txt") or file_exists($folderName."/file_ok.txt")){
				exit ( "<h1>Process failed.</h1>The buyer had already paid or the seller had already uploaded the file. You cannot delete the transaction." );
			}
			
			if (dateDifference ( file_get_contents ( $folderName."/time_d.txt" ) , date('Y-m-d') ) > 1){
				exit ( "<h1>Process failed.</h1>This transaction was opened more than 24 hours ago! Now you need to contact the support at support@bitscrow.org to delete." );
			}else{
				if (file_exists($folderName."/closed.txt")){
					exit ( "<h1>Process failed.</h1>Transaction already closed. A closed or completed transaction cannot be deleted. We need to store all transaction for safety reasons." );
				}else{
					$f = fopen ( $folderName."/deleted.txt", "a+" );
					$d = fwrite ( $d , "deleted");
					fclose($f);
					
					if ($d){
						$status = "COMPLETED";
					}else{
						$status = "ERROR";
					}
				}
			}
		}
	}
}
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
				<h4>Removing transaction</h4>
				<p></p>
				<?php
				if ($status == "COMPLETED") {
				?>
				<?php header("Refresh: 5; URL=/BitScrow"); ?>
				<img src="/BitScrow/images/loading.gif">
				<p>We are closing the transaction.. Please wait..</p>
				<?php } else { ?>
				<p><font color="red"><b>FAILED!</b></font></p>
				<?php } ?>
			</center>
		</div>
	</body>
</html>


