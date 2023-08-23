<?php
require "Pages/Website/Layout/Start.php";
?>
<h1><?=htmlspecialchars($data["name"])?></h1>
<table>
	<tbody>
		<tr>
			<td>Pays
			<td><?=Locale::getDisplayRegion("-{$data["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$data["country"]?>"></span>
		
		<tr>
			<td>Autonomous System (approximatif)
			<td>AS<?=$ispId?>
	</tbody>
</table>
<br><br>

<h2>Blocs IP</h2>
<?php
if (!empty($data["blocks"])) {
?>
<table>
	<thead>
		<tr>
			<th>Version
			<th>Bloc
			<th>Pays
			<th>Description
			<th>Remarques
			<th>Création
			<th>RIR
	</thead>
	
	<tbody>
<?php
	foreach ($data["blocks"] as $value) {
?>
		<tr>
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
			<td><?=nl2br(htmlspecialchars($value["description"]))?>
			<td><?=nl2br(htmlspecialchars($value["remarks"]))?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=$value["rir"]?>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="alert">
	Ce fournisseur d'accès Internet ne semble posséder aucun bloc IP.
</div>
<?php
}

/*
?>
<br>
<h2>Annonces BGP</h2>
<?php
if (!empty($data["bgp"])) {
?>
<table>
	<thead>
		<tr>
			<th>Version
			<th>Bloc
			<th>Netname
			<th>Description
			<th>Remarques
			<th>Pays
	</thead>
	
	<tbody>
<?php
	foreach ($data["bgp"] as $value) {
?>
		<tr>
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><?=nl2br(htmlspecialchars($value["netname"]))?>
			<td><?=nl2br(htmlspecialchars($value["description"]))?>
			<td><?=nl2br(htmlspecialchars($value["remarks"]))?>
			<td><?=Locale::getDisplayRegion("-".($value["country"] != "ZZ" && !empty($value["country"]) ? $value["country"] : $data["country"]), "fr")?> <span class="flag-icon flag-icon-<?=($value["country"] != "ZZ" && !empty($value["country"]) ? $value["country"] : $data["country"])?>"></span>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="alert">
	Ce fournisseur d'accès Internet ne semble posséder aucune annonce BGP.
</div>
<?php
}
?>
<br>
<h2>Peers IPv4</h2>
<?php
if (!empty($data["peers"][4])) {
?>
<table>
	<thead>
		<tr>
			<th>AS
			<th>Nom
			<th>Pays
	</thead>
	
	<tbody>
<?php
	foreach ($data["peers"][4] as $value) {
?>
		<tr>
			<td>AS<?=$value["as"]?>
			<td><a href="/isp/<?=$value["as"]?>-<?=slug($value["name"])?>" title="<?=htmlspecialchars($value["name"])?>"><?=htmlspecialchars($value["name"])?></a>
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="alert">
	Ce fournisseur d'accès Internet ne semble posséder aucun peer IPv4.
</div>
<?php
}
?>
<br>
<h2>Peers IPv6</h2>
<?php
if (!empty($data["peers"][6])) {
?>
<table>
	<thead>
		<tr>
			<th>AS
			<th>Nom
			<th>Pays
	</thead>
	
	<tbody>
<?php
	foreach ($data["peers"][4] as $value) {
?>
		<tr>
			<td>AS<?=$value["as"]?>
			<td><a href="/isp/<?=$value["as"]?>-<?=slug($value["name"])?>" title="<?=htmlspecialchars($value["name"])?>"><?=htmlspecialchars($value["name"])?></a>
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="alert">
	Ce fournisseur d'accès Internet ne semble posséder aucun peer IPv6.
</div>
<?php
}*/


require "Pages/Website/Layout/End.php";