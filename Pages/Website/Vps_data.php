<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>VPS <?=$match[0]?></h1>
<?php
if (isset($messages) && !empty($messages)) {
?>
<p>
<?php
	foreach ($messages as $id=>$message) {
		if ($id > 0) {
			echo "<br>";
		}
		
		echo $message;
	}
?>
</p>
<?php
}
?>

<table class="table table-striped">			
	<tr>
		<td>Identifiants root
		<td>root / <?=$data["password"]?>
		
	<tr>
		<td>Expiration
		<td><?=date("d/m/Y H:i:s", $data["expiration"])?>
		
	<tr>
		<td>État
		<td><?=$containerData["data"]["status"] == "running" ? "Démarré" : "Éteint"?>
	
	<tr>
		<td>Utilisation RAM
		<td><?=substr($containerData["data"]["mem"]/1073741824, 0, 4)?> Go / <?=floor($containerData["data"]["maxmem"]/1073741824)?> Go
</table>
<br>

<form method="post">
	<input type="hidden" name="token" value="<?=$token?>">
	<input type="hidden" name="action" value="reboot">
	<input type="submit" class="btn btn-white" value="Redémarrer le VPS">
</form>

<hr>
	
<?php
if ($data["type"] == 1) {
	$renewProduct = 2;
}
?>
<a href="/account/buy/init?product=<?=$renewProduct?>&service=<?=$match[0]?>" class="btn btn-sm">Renouveler le VPS pour 1 mois</a>
<?php
require "Pages/Website/Layout/End.php";