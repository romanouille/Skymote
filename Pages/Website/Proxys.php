<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Proxys Socks5</h1>

<table class="table table-striped">
	<thead>
		<tr>
			<td>Adresse IP
			<td>Port
			<td>Pays
			<td>Fournisseur d'accès Internet
			<td>Horodatage
	</thead>
	
	<tbody>
<?php
foreach ($data as $value) {
?>
		<tr>
			<td><a href="/ip/<?=$value["ip"]?>" title="<?=$value["ip"]?>"><?=$value["ip"]?></a>
			<td><?=$value["port"]?>
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
			<td><?=htmlspecialchars($value["isp"])?>
			<td><?=date("d/m/Y H:i:s", $value["timestamp"])?>
<?php
}
?>
	</tbody>
</table>
<?php
require "Pages/Website/Layout/End.php";