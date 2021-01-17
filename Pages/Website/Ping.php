<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>Ping<?=!empty($match) ? " <b>".strtoupper($protocol)." ".$ip.($protocol != "icmp" ? ":$port" : "")."</b>" : ""?></h1>
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
if (!empty($match) && !empty($data)) {
	if ($protocol == "tcp" || $protocol == "icmp") {
?>
	<table class="table striped">
		<thead>
			<tr>
				<th>Pong
				<th>IP source
				<th>TTL
				<th>Séquence
		</thead>
		
		<tbody>
<?php
		foreach ($data as $value) {
?>
			<tr>
				<td><?=$value["pong"]?>ms
				<td><?=$value["sourceIp"]?>
				<td><?=$value["ttl"]?>
				<td><?=$value["seq"]?>
<?php
}	
?>
		</tbody>
	</table>
<?php
	} elseif ($protocol == "udp") {
?>
	<table class="table striped">
		<thead>
			<tr>
				<th>Pong
				<th>IP source
				<th>TTL
		</thead>
		
		<tbody>
<?php
		foreach ($data as $value) {
?>
			<tr>
				<td><?=$value["pong"]?>ms
				<td><?=$value["sourceIp"]?>
				<td><?=$value["ttl"]?>
<?php
		}
?>
		</tbody>
	</table>
<?php
	}
} else {
	if (!empty($match)) {
?>
<div class="remark alert">
	Aucune donnée n'a été reçue.
</div>
<?php
	}
}
?>
</div>
<?php
require "Pages/Website/Layout/End.php";