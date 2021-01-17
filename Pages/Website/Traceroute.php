<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>Traceroute<?=!empty($match) ? " <b>".strtoupper($protocol)." ".$ip.($protocol != "icmp" ? ":$port" : "")."</b>" : ""?></h1>
	
	<div class="grid">
		<div class="row">
			<div class="cell-lg-3 cell-12">
				<form method="get">
					<input type="text" name="ip" value="<?=isset($ip) ? $ip : ""?>" placeholder="Adresse IP" data-role="input" required><br>
					<input type="text" name="port" value="<?=isset($port) ? $port : ""?>" placeholder="Port" data-role="input" required><br>
					<select name="protocol" data-role="select">
						<!--<option value="tcp"<?=isset($protocol) && $protocol == "tcp" ? " selected" : ""?>>TCP</option>-->
						<option value="icmp"<?=isset($protocol) && $protocol == "icmp" ? " selected" : ""?>>ICMP</option>
						<option value="udp"<?=isset($protocol) && $protocol == "udp" ? " selected" : ""?>>UDP</option>
					</select>
					<br>
					
					<input type="submit" class="button success">
				</form>
			</div>
		</div>
	</div>
	
<?php
if (!empty($match)) {
?>
	<table class="table striped">
		<thead>
			<tr>
				<th>Pong
				<th>IP source
				<th>PTR
				<th>Pays
				<th>Fournisseur d'accès Internet
		</thead>
		
		<tbody>
<?php
	foreach ($data as $value) {
?>
			<tr>
				<td><?=$value["pong"]?>ms
				<td><a href="/ip/<?=$value["sourceIp"]?>" title="<?=$value["sourceIp"]?>"><?=$value["sourceIp"]?></a>
				<td><?=$value["ptr"]?>
				<td><?=$value["countryCode"] != "*" ? Locale::getDisplayRegion("-{$value["countryCode"]}", "fr") : "*"?> <span class="flag-icon flag-icon-<?=$value["countryCode"]?>"></span>
				<td><?=htmlspecialchars($value["isp"])?>
<?php
	}
?>
		</tbody>
	</table>
<?php
}
?>
</div>
<?php
require "Pages/Website/Layout/End.php";