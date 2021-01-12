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
					<input type="text" name="text" data-role="input" placeholder="IPv4/v6, FAI, ...">
				</div>
			</div>
		</div>
		<input class="button success" type="submit" value="Rechercher">
	</form>
	
	<!--<div class="grid flex-align-center buttons">
		<div class="row">
			<div class="cell-lg-4 cell-12">
				<div class="tile-large bg-red" data-role="tile" data-role-tile="true">
					<span class="mif-earth icon"></span>
					<span class="branding-bar">GeoIP</span>
				</div>
			</div>
			
			<div class="cell-lg-4 cell-12">
				<div class="tile-large bg-orange" data-role="tile" data-role-tile="true">
					<span class="mif-http icon"></span>
					<span class="branding-bar">Hébergement web</span>
				</div>
			</div>
			
			<div class="cell-lg-4 cell-12">
				<div class="tile-large bg-green" data-role="tile" data-role-tile="true">
					<span class="mif-server icon"></span>
					<span class="branding-bar">VPS</span>
				</div>
			</div>
		</div>
	</div>-->
</div>
<?php
require "Pages/Website/Layout/End.php";