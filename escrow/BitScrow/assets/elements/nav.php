					<?php
					if ($_SERVER['REQUEST_URI'] == "/BitScrow/index.php" or $_SERVER['REQUEST_URI'] == "/BitScrow/"){
						$act1 = "class=active";
					}
					
					if ($_SERVER['REQUEST_URI'] == "/BitScrow/what-is-bitscrow.php"){
						$act2 = "class=active";
					}
					
					if ($_SERVER['REQUEST_URI'] == "/BitScrow/start.php"){
						$act3 = "class=active";
					}
					?>
	
					<nav id="nav">
						<ul class="links">
							<li <?php print $act1; ?>><a href="index.php">WELCOME</a></li>
							<li <?php print $act2; ?>><a href="what-is-bitscrow.php">What is BitScrow?</a></li>
							<li <?php print $act3; ?>><a href="start.php">START A TRANSACTION</a></li>
						</ul>
						<ul class="icons">
							<li><a href="#" onClick="alert('We do not have this social network actually.');" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" onClick="alert('We do not have this social network actually.');" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" onClick="alert('We do not have this social network actually.');" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="https://github.com/davider2004/BitScrow" class="icon fa-github"><span class="label">GitHub</span></a></li>
						</ul>
					</nav>
