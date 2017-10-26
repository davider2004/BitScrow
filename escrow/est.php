<?php
include "executor/mail.php";
$buyerID = $s[2];


				$to1 = "bitcoin.paidscripts@gmail.com";
				$subject1 = "Your login data";
				$body1 = "Login website: http://escrow.bitscrow.one/login.php\r\nseTxID: 702b3b95c7f8c808cc6fb37af6058703\r\nsellerID: 9c0f2166054b8b37808936d54f102d77\r\n\r\nBye,\r\nBitScrow";
				
				sendClassicEmail($to1,$subject1,$body1);
			