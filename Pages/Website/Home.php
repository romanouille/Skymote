<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Obtenez des informations sur une adresse IP</h1>
<p>Découvrez le pays, le bloc source, les allocations...</p>
<form method="get" action="search">
	<input type="text" class="form-control" name="text" placeholder="Adresse IPv4/v6, FAI, ..." value="<?=$_SERVER["REMOTE_ADDR"]?>" required>
	<input type="submit" class="btn btn-white" value="Valider">
</form>
<?php
if (!empty($data)) {
?>
<br><br><br><br>
<h1>Adresse IP <b><?=$ip?></b></h1>
	
<table>
	<tbody>
		<tr>
			<td>Fournisseur d'accès Internet
<?php
	if ($data["isp"]["name"] != "*") {
?>
			<td><?=$data["block"]["isp"] > 0 ? "<a href=\"/isp/{$data["block"]["isp"]}-".slug($data["isp"]["name"])."\" title=\"".htmlspecialchars($data["isp"]["name"])."\">".htmlspecialchars($data["isp"]["name"])."</a>" : "*"?>
<?php
	} else {
?>
			<td>*
<?php
	}
?>

		<tr>
			<td>Pays
			<td><?=Locale::getDisplayRegion("-{$data["isp"]["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$data["isp"]["country"]?>"></span>
		
		<tr>
			<td>Version
			<td>IPv<?=$data["block"]["version"]?>
		
		<tr>
			<td>Bloc
			<td><?=$data["block"]["block"]?> (<a href="/ip/<?=$data["block"]["block_start"]?>" title="<?=$data["block"]["block_start"]?>"><?=$data["block"]["block_start"]?></a> - <a href="/ip/<?=$data["block"]["block_end"]?>" title="<?=$data["block"]["block_end"]?>"><?=$data["block"]["block_end"]?></a>)
		
		<tr>
			<td>Pays d'origine du bloc
			<td><?=Locale::getDisplayRegion("-{$data["block"]["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$data["block"]["country"]?>"></span>
		
		<tr>
			<td>Autonomous System (approximatif)
			<td><?=$data["block"]["isp"] > 0 ? "AS{$data["block"]["isp"]}" : "*"?>
		
		<tr>
			<td>Création du bloc
			<td><?=date("d/m/Y H:i:s", $data["block"]["created"])?>
		
		<tr>
			<td>Registre Internet régional
			<td><?=$data["block"]["rir"]?>
	</tbody>
</table>
	
<?php
	if ($data["block"]["rir"] == "RIPENCC" && !empty($data["allocations"])) {
?>
<h2>Allocations</h2>

<table>
	<thead>
		<th>Version
		<th>Bloc
		<th>Organisation
		<th>Pays
		<th>Netname
		<th>Description
		<th>Remarques
		<th>Statut
		<th>Création
		<th>Dernière modification
	</thead>
	
	<tbody>
<?php
		foreach ($data["allocations"] as $value) {
?>
		<tr>
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><a href="/org/<?=$value["org"]?>" title="<?=$value["org"]?>"><?=$value["org"]?></a>
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
			<td><?=htmlspecialchars($value["netname"])?>
			<td><?=nl2br(htmlspecialchars($value["description"]))?>
			<td><?=nl2br(htmlspecialchars($value["remarks"]))?>
			<td><?=$value["status"]?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
		}
?>
	</tbody>
</table>
<?php
	}

	if (!empty($data["routes"])) {
?>
<br>
<h2>Routes</h2>
<table>
	<thead>
		<th>Version
		<th>Bloc
		<th>Description
		<th>Origine
		<th>Création
		<th>Dernière modification
	</thead>
	
	<tbody>
<?php
			foreach ($data["routes"] as $value) {
?>
		<tr>
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><?=nl2br(htmlspecialchars($value["description"]))?>
			<td><?=$value["origin"]?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
		}
?>
	</tbody>
</table>
<?php
	}
}
?>
<a href="/tools/ping?ip=<?=urlencode($_SERVER["REMOTE_ADDR"])?>&port=80&protocol=icmp" class="button" target="_blank">Ping</a>&nbsp;
<a href="/tools/traceroute?ip=<?=urlencode($_SERVER["REMOTE_ADDR"])?>&port=80&protocol=icmp" class="button" target="_blank">Traceroute</a>
<?php

require "Pages/Website/Layout/End.php";
