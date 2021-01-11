<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Traceroute <?=$ip?></a>
	</ul>
	
	<h1>Traceroute <b><?=strtoupper($protocol)?> <?=$ip?><?=$protocol != "icmp" ? ":$port" : ""?></b></h1>
	
	<div class="grid">
		<div class="row">
			<div class="cell-3">
				<form method="get">
					<input type="text" name="ip" value="<?=$ip?>" placeholder="Adresse IP" data-role="input"><br>
					<input type="text" name="port" value="<?=$port?>" placeholder="Port" data-role="input"><br>
					<select name="protocol" data-role="select">
						<option value="tcp"<?=$protocol == "tcp" ? " selected" : ""?>>TCP</option>
						<option value="udp"<?=$protocol == "udp" ? " selected" : ""?>>UDP</option>
						<option value="icmp"<?=$protocol == "icmp" ? " selected" : ""?>>ICMP</option>
					</select>
					<br>
					
					<input type="submit" class="button success">
				</form>
			</div>
		</div>
	</div>
	
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
				<td><?=$value["countryCode"] != "*" ? Locale::getDisplayRegion("-{$value["countryCode"]}") : "*"?> <span class="flag-icon flag-icon-<?=$value["countryCode"]?>"></span>
				<td><?=htmlspecialchars($value["isp"])?>
<?php
}
?>
		</tbody>
	</table>
</div>
<?php
require "Pages/Website/Layout/End.php";