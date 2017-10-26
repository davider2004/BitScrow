							<form method="post" action="?form=1">
								<?php
								//session_start();
								
								//if ($_SESSION['err'] and $_SESSION['MsgColor']){
									//$msgError = str_replace("+", " ", $_GET['err']);
									//$writeLine = "<p><font color=". $MsgColor ."><b>". $msgError ."</b></font></p>";
									
									//echo $writeLine;
									
									//unset($_SESSION['err']);
									//unset($_SESSION['MsgColor']);
								//}
								?>
								<div class="field">
									<label for="name">Full name</label>
									<input type="text" name="name" id="name" />
								</div>
								<div class="field">
									<label for="email">Email</label>
									<input type="text" name="email" id="email" />
								</div>
								<div class="field">
									<label for="message">Message</label>
									<textarea name="message" id="message" rows="3"></textarea>
								</div>
								<ul class="actions">
									<li><input type="submit" value="Send Message" name="submit_cf" id="submit_cf" /></li>
								</ul>
							</form>
