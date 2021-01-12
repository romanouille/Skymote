<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Proxys</a>
	</ul>
	
	<h1>Proxys Socks5</h1>
	
	<table class="table striped">
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
				<td><?=Locale::getDisplayRegion("-{$value["country"]}")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
				<td><?=htmlspecialchars($value["isp"])?>
				<td><?=date("d/m/Y H:i:s", $value["timestamp"])?>
<?php
}
?>
		</tbody>
	</table>
</div>
<?php
require "Pages/Website/Layout/End.php";