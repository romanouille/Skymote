<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Liste d'attente IPv4 RIPE</h1>
<h2>C'est quoi ?</h2>
<p>
	La liste d'attente IPv4 RIPE est destinée aux LIR (Local Internet Registry) inscrits auprès du RIPE. Elle leur permet de faire l'acquisition d'un bloc IPv4 /24, une seule demande peut être faite par LIR.<br>
	Cette page liste les blocs qui ont été attribués par le RIPE récemment, auprès des LIR. <a href="https://www.ripe.net/manage-ips-and-asns/ipv4/ipv4-waiting-list" target="_blank">Cliquez ici pour voir le graphique actuel de la liste d'attente</a>
</p>
<br><br>

<table>
	<thead>
		<tr>
			<th>Bloc
			<th>Pays
			<th>AS
			<th>Création
	</thead>
	
	<tbody>
<?php
foreach ($data as $value) {
?>
		<tr>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
			<td><?=$value["isp"] > 0 ? "AS{$value["isp"]}" : "*"?>
			<td><?=date("d/m/Y", $value["created"])?>
<?php
}
?>
	</tbody>
</table>
<?php
require "Pages/Website/Layout/End.php";