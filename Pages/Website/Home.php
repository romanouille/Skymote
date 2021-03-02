<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Obtenez des informations sur une adresse IP</h1>
<p>Découvrez le pays, le bloc source, les allocations...</p>
<form method="get" action="search">
	<input type="text" class="form-control" name="text" placeholder="Adresse IPv4/v6, FAI, ..." value="<?=$_SERVER["REMOTE_ADDR"]?>" required>
	<input type="submit" class="btn btn-white">
</form>
<?php
require "Pages/Website/Layout/End.php";