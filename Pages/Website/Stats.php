<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Statistiques d'utilisation du site</h1>
<h2>AS</h2>
<table>
	<thead>
		<tr>
			<th>AS
			<th>FAI
			<th>Pays
			<th>Requêtes
	</thead>
	
	<tbody>
<?php
foreach ($result["isp"] as $id=>$value) {
?>
		<tr>
			<td><?=$id?>
			<td><a href="/isp/<?=$id?>-<?=slug($value["name"])?>"><?=htmlspecialchars($value["name"])?></a>
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
			<td><?=$value["nb"]?>
<?php
}
?>
	</tbody>
</table>
<?php
require "Pages/Website/Layout/End.php";