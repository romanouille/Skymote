<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Organisation <b><?=$match[0]?></b></h1>

<table class="table table-striped">
	<tbody>
		<tr>
			<td>Nom
			<td><?=htmlspecialchars($data["name"])?>
			
		<tr>
			<td>LIR
			<td><?=$data["is_lir"] ? "Oui" : "Non"?>
			
		<tr>
			<td>Création
			<td><?=date("d/m/Y H:i:s", $data["created"])?>
			
		<tr>
			<td>Dernière modification
			<td><?=date("d/m/Y H:i:s", $data["modified"])?>
	</tbody>
</table>
	
<h2>Allocations</h2>

<?php
if (!empty($data["allocations"])) {
?>
<table class="table striped">
	<thead>
		<tr>
			<th>Version
			<th>Bloc
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
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
			<td><?=htmlspecialchars($value["netname"])?>
			<td><pre><?=htmlspecialchars($value["description"])?></pre>
			<td><pre><?=htmlspecialchars($value["remarks"])?></pre>
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
<p>
	Cette organisation ne possède aucune allocation.
</p>
<?php
}

require "Pages/Website/Layout/End.php";