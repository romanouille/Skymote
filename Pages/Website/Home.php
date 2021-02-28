<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="home">
	<h1>Skymote</h1>
	<h2>Accédez aux informations sur une IP</h2>
	
	<form method="get" action="/search">
		<div class="grid">
			<div class="row">
				<div class="cell-lg-2 cell-12 offset-5">
					<input type="text" name="text" data-role="input" placeholder="IPv4/v6, FAI, ..." value="<?=$_SERVER["REMOTE_ADDR"]?>">
				</div>
			</div>
		</div>
		<input class="button success" type="submit" value="Rechercher">
	</form>
	
	<div class="grid flex-align-center buttons">
		<div class="row">
			<div class="cell-lg-6 cell-12">
				<a href="#" title="GeoIP">
					<div class="tile-large bg-red" data-role="tile" data-role-tile="true">
						<span class="mif-earth icon"></span>
						<span class="branding-bar">GeoIP</span>
					</div>
				</a>
			</div>
			
			<!--<div class="cell-lg-6 cell-12">
				<a href="https://monespaceweb.io/" title="Hébergement web" target="_blank">
					<div class="tile-large bg-orange" data-role="tile" data-role-tile="true">
						<span class="mif-http icon"></span>
						<span class="branding-bar">Hébergement web</span>
					</div>
				</a>
			</div>-->
			
			<div class="cell-lg-6 cell-12">
				<a href="/minecraft" title="Minecraft">
					<div class="tile-large bg-green" data-role="tile" data-role-tile="true">
						<span class="mif-server icon"></span>
						<span class="branding-bar">Minecraft</span>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
<?php
require "Pages/Website/Layout/End.php";