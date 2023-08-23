<?php
require "Pages/Website/Layout/Start.php";
?>	
<h1>Ping<?=!empty($match) ? " <b>".strtoupper($protocol)." ".(strstr($ip, ":") ? "[$ip]" : $ip).($protocol != "icmp" ? ":$port" : "")."</b>" : ""?></h1>
<form method="get">
	<input type="text" name="ip" value="<?=isset($ip) ? htmlspecialchars($ip) : ""?>" placeholder="Adresse IP" required>
	<input type="text" name="port" value="<?=isset($port) ? $port : ""?>" placeholder="Port" required>
	<select name="protocol">
		<option value="tcp"<?=isset($protocol) && $protocol == "tcp" ? " selected" : ""?>>TCP</option>
		<option value="udp"<?=isset($protocol) && $protocol == "udp" ? " selected" : ""?>>UDP</option>
		<option value="icmp"<?=isset($protocol) && $protocol == "icmp" ? " selected" : ""?>>ICMP</option>
	</select>
	<br>
	
	<input type="submit"><br><br>
</form>
<?php
if (!empty($match) && !empty($data)) {
	if ($protocol == "tcp" || $protocol == "icmp") {
?>
<table>
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
<table>
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
<div class="alert">
	Aucune donnée n'a été reçue.
</div>
<?php
	}
}

require "Pages/Website/Layout/End.php";