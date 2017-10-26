<?php
function getErrorMsg($errID){
	if (in_array($errID,$errors){
		$generalRaw = explode(";",$errors[$errID]);
		
		$msgColorRaw = explode(":",$generalRaw[1]);
		$msgColor = $msgColorRaw[1];
		
		$ErrMsg = str_replace("+"," ",$generalRaw[0]);
		
		$finalMsg = "<font color=\"". $msgColor ."\"><b>". $ErrMsg ."</b></font>";
		return $finalMsg;
	}else{
		header("Location: #!failed_err_msg_loading");
	}
}

function lookForErrors(){
	if ($_GET['err']){
		include 'errors.php';
		echo "<p>". getErrorMsg($_GET['err']) ."</p>";
	}
}
