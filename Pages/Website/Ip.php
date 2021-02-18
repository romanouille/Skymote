<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>Adresse IP <b><?=$ip?></b></h1>
	
	<table class="table striped">
		<tbody>
			<tr>
				<td>Fournisseur d'accès Internet
				<td><?=$data["block"]["lir"] > 0 ? "<a href=\"/isp/{$data["block"]["lir"]}-".slug($data["lir"]["name"])."\" title=\"".htmlspecialchars($data["lir"]["name"])."\">".htmlspecialchars($data["lir"]["name"])."</a>" : "*"?>
			
			<tr>
				<td>Pays
				<td><?=Locale::getDisplayRegion("-{$data["lir"]["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$data["lir"]["country"]?>"></span>
			
			<tr>
				<td>Version
				<td>IPv<?=$data["block"]["version"]?>
			
			<tr>
				<td>Bloc
				<td><?=$data["block"]["block"]?> (<a href="/ip/<?=$data["block"]["block_start"]?>" title="<?=$data["block"]["block_start"]?>"><?=$data["block"]["block_start"]?></a> - <a href="/ip/<?=$data["block"]["block_end"]?>" title="<?=$data["block"]["block_end"]?>"><?=$data["block"]["block_end"]?></a>)
			
			<tr>
				<td>Pays du bloc
				<td><?=Locale::getDisplayRegion("-{$data["block"]["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$data["block"]["country"]?>"></span>
			
			<tr>
				<td>Autonomous System (approximatif)
				<td><?=$data["block"]["lir"] > 0 ? "AS{$data["block"]["lir"]}" : "*"?>
			
			<tr>
				<td>Création du bloc
				<td><?=date("d/m/Y H:i:s", $data["block"]["created"])?>
			
			<tr>
				<td>Registre Internet régional
				<td><?=$rirList[$data["block"]["rir"]]?>
		</tbody>
	</table>
	
<?php
if ($data["block"]["rir"] == 4 && !empty($data["allocations"])) {
?>
	<h2>Allocations</h2>
	
	<table class="table striped">
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
}
?>
<br><br>
<!--<a href="/tools/ping?ip=<?=$ip?>&port=80&protocol=tcp" title="Ping TCP" class="button success">Ping TCP</a>&nbsp;-->
<a href="/tools/ping?ip=<?=$ip?>&port=80&protocol=icmp" title="Ping ICMP" class="button success">Ping ICMP</a>
<a href="/tools/ping?ip=<?=$ip?>&port=80&protocol=udp" title="Ping UDP" class="button success">Ping UDP</a>&nbsp;
<br><br>

<!--<a href="/tools/traceroute?ip=<?=$ip?>&port=80&protocol=tcp" title="Ping TCP" class="button success">Traceroute TCP</a>&nbsp;-->
<a href="/tools/traceroute?ip=<?=$ip?>&port=80&protocol=icmp" title="Ping TCP" class="button success">Traceroute ICMP</a>
<a href="/tools/traceroute?ip=<?=$ip?>&port=80&protocol=udp" title="Ping TCP" class="button success">Traceroute UDP</a>&nbsp;
</div>
<?php
require "Pages/Website/Layout/End.php";