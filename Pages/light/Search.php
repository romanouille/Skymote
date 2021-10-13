<?php
require "Pages/$version/Layout/Start.php";
?>
<h1>Résultats de la recherche pour <b><?=htmlspecialchars($match[0])?></b></h1>
<br>
	
<h2>Fournisseurs d'accès Internet</h2><br>
<?php
if (!empty($data["as"])) {
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Nom
			<th>Pays
	</thead>
	
	<tbody>
<?php
	foreach ($data["as"] as $value) {
?>
		<tr>
			<td><a href="/isp/<?=$value["id"]?>-<?=slug($value["name"])?>" title="<?=htmlspecialchars($value["name"])?>"><?=htmlspecialchars($value["name"])?></a>
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="alert alert-info">
	Aucun AS n'a été trouvé pour "<?=htmlspecialchars($match[0])?>".
</div>
<?php
}
?>

<br><br>

<h2>Allocations RIPE</h2>
<?php
if (!empty($data["allocations"])) {
?>
<table class="table table-striped">
	<thead>
		<tr>
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
			<td><?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>
			<td><a href="/org/<?=$value["org"]?>" title="<?=$value["org"]?>"><?=$value["org"]?></a>
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?>
			<td><?=htmlspecialchars($value["netname"])?>
			<td><pre><?=nl2br(htmlspecialchars($value["description"]))?></pre>
			<td><pre><?=nl2br(htmlspecialchars($value["remarks"]))?></pre>
			<td><?=$value["status"]?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="alert alert-info">
	Aucune allocation n'a été trouvée pour "<?=htmlspecialchars($match[0])?>".
</div>
<?php
}
?>

<br><br>

<h2>RIPE</h2>
<?php
if (!empty($data["ripe_as"])) {
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Organisation
			<th>Organisation sponsor
			<th>Description
			<th>Remarques
			<th>Création
			<th>Dernière modification
	</thead>
	
	<tbody>
<?php
	foreach ($data["ripe_as"] as $value) {
?>
		<tr>
			<td><a href="/org/<?=$value["org"]?>" title="<?=$value["org"]?>"><?=$value["org"]?></a>
			<td><a href="/org/<?=$value["sponsoring_org"]?>" title="<?=$value["sponsoring_org"]?>"><?=$value["sponsoring_org"]?></a>
			<td><pre><?=nl2br(htmlspecialchars($value["description"]))?></pre>
			<td><pre><?=nl2br(htmlspecialchars($value["remarks"]))?></pre>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="alert alert-info">
	Aucune donnée RIPE trouvée pour "<?=htmlspecialchars($match[0])?>".
</div>
<?php
}
?>

<br><br>
<h2>Organisations</h2>

<?php
if (!empty($data["org"])) {
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Organisation
			<th>Nom
			<th>LIR
			<th>Création
			<th>Dernière modification
	</thead>
	
	<tbody>
<?php
	foreach ($data["org"] as $value) {
?>
		<tr>
			<td><a href="/org/<?=$value["org"]?>" title="<?=$value["org"]?>"><?=$value["org"]?></a>
			<td><?=htmlspecialchars($value["name"])?>
			<td><?=$value["is_lir"] ? "Oui" : "Non"?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="alert alert-info">
	Aucune organisation trouvée pour "<?=htmlspecialchars($match[0])?>".
</div>
<?php
}
?>

<br><br>
<h2>Routes</h2>

<?php
if (!empty($data["routes"])) {
?>
<table class="table table-striped">
	<thead>
		<tr>
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
			<td><?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><pre><?=nl2br(htmlspecialchars($value["description"]))?></pre>
			<td>AS<?=$value["origin"]?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="alert alert-info">
	Aucune route trouvée pour "<?=htmlspecialchars($match[0])?>".
</div>
<?php
}
?>
<?php
require "Pages/$version/Layout/End.php";