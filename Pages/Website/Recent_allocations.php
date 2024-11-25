<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Récentes allocations</h1>
<h2>Allocations RIPE</h2>

<table>
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
<br><br>

<h2>Blocs IP</h2>
<table>
	<thead>
		<tr>
			<th>Version
			<th>Bloc
			<th>Pays
			<th>AS
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
			<td><?=$value["isp"] > 0 ? "AS{$value["isp"]}" : "*"?>
			<td><?=date("d/m/Y", $value["created"])?>
			<td><?=$value["rir"]?>
<?php
}
?>
	</tbody>
</table>
<br><br>
	
<h2>Autonomous System</h2>
<table>
	<thead>
		<tr>
			<th>ID
			<th>RIR
			<th>Création
	</thead>
	
	<tbody>
<?php
foreach ($data["as"] as $value) {
?>
		<tr>
			<td>AS<?=$value["id"]?>
			<td><?=$value["rir"]?>
			<td><?=date("d/m/Y", $value["created"])?>
<?php
}
?>
	</tbody>
</table>
<br><br>
	
<h2>Autonomous System RIPE</h2>
<table>
	<thead>
		<tr>
			<th>ID
			<th>Organisation
			<th>Organisation sponsor
			<th>Description
			<th>Remarques
			<th>Création
			<th>Dernière modification
	</thead>
	
	<tbody>
<?php
foreach ($data["ripeAs"] as $value) {
?>
		<tr>
			<td>AS<?=$value["id"]?>
			<td><a href="/org/<?=$value["org"]?>" title="<?=$value["org"]?>"><?=$value["org"]?></a>
			<td><a href="/org/<?=$value["sponsoring_org"]?>" title="<?=$value["sponsoring_org"]?>"><?=$value["sponsoring_org"]?></a>
			<td><?=nl2br(htmlspecialchars($value["description"]))?>
			<td><?=nl2br(htmlspecialchars($value["remarks"]))?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
}
?>
	</tbody>
</table>
<br><br>
	
<h2>Organisations RIPE</h2>
<table>
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
foreach ($data["organisations"] as $value) {
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
<br><br>
	
<h2>Routes RIPE</h2>
<table>
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
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><?=nl2br(htmlspecialchars($value["description"]))?>
			<td><?=$value["origin"] > 0 ? "AS{$value["origin"]}" : "*"?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
}
?>
	</tbody>
</table>
<?php
require "Pages/Website/Layout/End.php";