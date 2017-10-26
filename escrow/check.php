<?php
function CheckTxData_BUYER($seTxID, $buyerID){
	$fileName = "transactions/".$seTxID."/".$seTxID."-".$buyerID.".txt";
	
	if (!file_exists($fileName)){
		return false;
	}else{
		return true;
	}
}

function CheckTxData_SELLER($seTxID, $sellerID){
	$fileName = "transactions/".$seTxID."/".$seTxID."-".$buyerID.".txt";
	
	if (!file_exists($fileName)){
		return false;
	}else{
		return true;
	}
}

function CheckTxData_FEESPAID($seTxID){
	$fileName = "transactions/".$seTxID."/paid_fees.txt";
	
	if (!file_exists($fileName)){
		return false;
	}else{
		if (file_get_contents($fileName) == "OK"){
			return true;
		}else{
			return false;
		}
	}
}
