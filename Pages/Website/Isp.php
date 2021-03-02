<?php
require "Pages/Website/Layout/Start.php";
?>
<h1><?=htmlspecialchars($data["name"])?></h1>
<table class="table table-striped">
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
<table class="table table-striped">
	<thead>
		<tr>
			<th>Version
			<th>Bloc
			<th>Pays
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
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=$rirList[$value["rir"]]?>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="remark alert">
	Ce fournisseur d'accès Internet ne possède aucun bloc IP.
</div>
<?php
}

require "Pages/Website/Layout/End.php";