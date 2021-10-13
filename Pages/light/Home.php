<?php
require "Pages/$version/Layout/Start.php";
?>
<div class="hero-unit">
	<h1>Obtenez des informations sur une adresse IP</h1>
	<p>Découvrez le pays, le bloc source, les allocations...</p>

	<form method="get" action="search">
		<fieldset>
			<label>Rechercher</label>
			<input type="text" name="text" value="<?=$_SERVER["REMOTE_ADDR"]?>">
			<button type="submit" class="btn">Valider</button>
		</fieldset>
	</form>
</div>
<?php
require "Pages/$version/Layout/End.php";