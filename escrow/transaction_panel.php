<?php
session_start();

include "check.php";
include "api/coinpayments_out.php";
include "api/coinpayments_in.php";

$seTxID = $_SESSION['seTxID'];
$seTxID_status = $_SESSION[$seTxID];

$buyerID = $_SESSION[$seTxID."-buyer"];
$sellerID = $_SESSION[$seTxID."-seller"];

$buyer_email = file_get_contents("transactions/".$seTxID."/buyer_email.txt");
$seller_email = file_get_contents("transactions/".$seTxID."/seller_email.txt");

if ($seTxID_status){
	if (file_exists("transactions/".$seTxID."/deleted.txt")){
		exit ( "Error -> Transaction deleted" );
	}
	
	if (!$buyerID and !$seTxID){
		exit( "Login failed -> BuyerID and seTxID missing");
	}else{
		if (!CheckTxData_BUYER($seTxID, $buyerID) and !CheckTxData_SELLER($seTxID, $sellerID)){
			exit ( "Login failed -> BuyerID or seTxID not valid" );
		}elseif (CheckTxData_BUYER($seTxID, $buyerID) and !CheckTxData_SELLER($seTxID, $sellerID)){
			$fees = file_get_contents("transactions/".$seTxID."/fees.txt");
			
			if (!CheckTxData_FEESPAID($seTxID)){
				if ($_POST['proceed_pay'] == "fees_pay"){
					if ($fees == "both"){
						$buyer_email = explode("-",file_get_contents("transactions/".$seTxID."/".$seTxID."-".$buyerID.".txt"));
						$buyer_email = $buyer_email[0];
						
						$req['amount'] = (0.0004+0.00002)/2;
						$req['currency1'] = "BTC";
						$req['currency2'] = "BTC";
						$req['buyer_email'] = $buyer_email;
						$req['buyer_name'] = "escrow_transaction_fees_".$seTxID;
						$req['item_name'] = "Escrow Transaction Fees";
						$req['item_number'] = "0001";
						$req['invoice'] = rand(5012,45867983240944695802);
						$req['custom'] = $seTxID."-buyer-".$buyerID."-".$buyer_email;
						$req['ipn_url'] = "http://bitscrow.one/BitScrow/escrow/executor/ipn.php?for=fees&pay=both_buyer";
						
					}elseif ($fees == "buyer"){
						$buyer_email = explode("-",file_get_contents("transactions/".$seTxID."/".$seTxID."-".$sellerID.".txt"));
						$buyer_email = $buyer_email[0];
						
						$req['amount'] = 0.0004+0.00002;
						$req['currency1'] = "BTC";
						$req['currency2'] = "BTC";
						$req['buyer_email'] = $buyerID;
						$req['buyer_name'] = "escrow_transaction_fees_".$seTxID;
						$req['item_name'] = "Escrow Transaction Fees";
						$req['item_number'] = "0001";
						$req['invoice'] = rand(5012,45867983240944695802);
						$req['custom'] = $seTxID."-buyer-".$buyerID."-".$buyer_email;
						$req['ipn_url'] = "http://bitscrow.one/executor/ipn.php?for=fees&pay=buyer";
					}
					
					$payment_link = coinpayments_api_princ("create_transaction",$req);
					
					echo "<center><h1>Now we will redirect you to the payment page..</h1></center>";
					echo "<center><h3><b>AFTER THE PAYMENT WILL BE SENT AND IT REACH SOME CONFIRMATIONS BY THE NETWORK, You will receive an email that says you need to re-login to the page to start the escrow transaction.</b></h3></center>";
					echo "<center><p>Please wait.. We are redirecting you..</p></center>";
					
					header("Refresh: 8; URL=".$payment_link['result']['status_url']);
					
				}else{
				
					if ($fees == "both" or $fees == "buyer" and file_get_contents("transactions/".$seTxID."/paid_fees.txt") == "b"){
						include "executor/wait_fees.php";
					}else{
						include "executor/pay_fees.php";
					}
					
				}
			}else{
				include "buyer_panel.php";
			}
		}elseif (CheckTxData_SELLER($seTxID, $sellerID) and !CheckTxData_BUYER($seTxID, $buyerID)){
				$fees = file_get_contents("transactions/".$seTxID."/fees.txt");
				
				if (!CheckTxData_FEESPAID($seTxID)){
					if ($_POST['proceed_pay'] == "fees_pay"){
						if ($fees == "both"){
							$seller_email = explode("-",file_get_contents("transactions/".$seTxID."/".$seTxID."-".$buyerID.".txt"));
							$seller_email = $seller_email[0];
							
							$req['amount'] = (0.0004+0.00002)/2;
							$req['currency1'] = "BTC";
							$req['currency2'] = "BTC";
							$req['buyer_email'] = $buyer_email;
							$req['buyer_name'] = "escrow_transaction_fees_".$seTxID;
							$req['item_name'] = "Escrow Transaction Fees";
							$req['item_number'] = "0001";
							$req['invoice'] = rand(5012,45867983240944695802);
							$req['custom'] = $seTxID."-seller-".$sellerID."-".$seller_email;
							$req['ipn_url'] = "http://bitscrow.one/BitScrow/escrow/executor/ipn.php?for=fees&pay=both_seller";
							
						}elseif ($fees == "buyer"){
							$buyer_email = explode("-",file_get_contents("transactions/".$seTxID."/".$seTxID."-".$sellerID.".txt"));
							$buyer_email = $buyer_email[0];
							
							$req['amount'] = 0.0004+0.00002;
							$req['currency1'] = "BTC";
							$req['currency2'] = "BTC";
							$req['buyer_email'] = $buyerID;
							$req['buyer_name'] = "escrow_transaction_fees_".$seTxID;
							$req['item_name'] = "Escrow Transaction Fees";
							$req['item_number'] = "0001";
							$req['invoice'] = rand(5012,45867983240944695802);
							$req['custom'] = $seTxID."-seller-".$sellerID."-".$sellerEmail;
							$req['ipn_url'] = "http://bitscrow.one/executor/ipn.php?for=fees&pay=seller";
						}
						
						$payment_link = coinpayments_api_princ("create_transaction",$req);
						
						echo "<center><h1>Now we will redirect you to the payment page..</h1></center>";
						echo "<center><h3><b>AFTER THE PAYMENT WILL BE SENT AND IT REACH SOME CONFIRMATIONS BY THE NETWORK, You will receive an email that says you need to re-login to the page to start the escrow transaction.</b></h3></center>";
						echo "<center><p>Please wait.. We are redirecting you..</p></center>";
						
						header("Refresh: 8; URL=".$payment_link);
						
					}else{
					
						if ($fees == "both" or $fees == "seller" or file_get_contents("transactions/".$seTxID."/paid_fees.txt") == "s"){
							include "executor/wait_fees.php";
						}else{
							include "executor/pay_fees.php";
						}
						
					}
				}else{
					include "seller_panel.php";
				}
			}else{
					exit ( "Error -> UKNERR#001 - contact support" );
			}
		}
}else{
	exit ( "Error -> Missing session" );
}
