<?php
$errors = array(
	"1" => "ERROR: Mondadory+field+empty;color:red"
);

function getErrorMsg($errID){
	if (in_array($errID,$errors)){
		$generalRaw = explode(";",$errors[$errID]);
		
		$msgColorRaw = explode(":",$generalRaw[1]);
		$msgColor = $msgColorRaw[1];
		
		$ErrMsg = str_replace("+"," ",$generalRaw[0]);
		
		$finalMsg = "<font color=". $msgColor ."><b>". $ErrMsg ."</b></font>";
		return $finalMsg;
	}else{
		if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
			$thisProtocol = "http";
		}else{
			$thisProtocol = "https";
		}
		
		$thisPage = $_SERVER['REQUEST_URI'];
		$thisHost = $_SERVER['HTTP_HOST'];
		$thisURL = $thisProtocol."://". $thisHost . $thisPage ."?errorLoading=failed#!failed_err_msg_loading/errors.php";
		
		$headerRedirect = "Location: ".str_replace("?err=1","",$thisURL);
		
		header($headerRedirect);
	}
}

function lookForErrors(){
	if ($_GET['err']){
		include 'errors.php';
		echo "<p>". getErrorMsg($_GET['err']) ."</p>";
	}
}

