<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Ping <?=$ip?></a>
	</ul>
	
	<h1>Ping <b><?=strtoupper($protocol)?> <?=$ip?><?=$protocol != "icmp" ? " :$port" : ""?></b></h1>
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
<?php
if (!empty($data)) {
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
?>
<div class="remark alert">
	Aucune donnée n'a été reçue.
</div>
<?php
}
?>
</div>
<?php
require "Pages/Website/Layout/End.php";