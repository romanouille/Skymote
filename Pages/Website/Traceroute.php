<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Traceroute<?=!empty($match) ? " <b>".strtoupper($protocol)." ".(strstr($ip, ":") ? "[$ip]" : $ip).($protocol != "icmp" ? ":$port" : "")."</b>" : ""?></h1>
	
<form method="get">
	<input type="text" name="ip" value="<?=isset($ip) ? $ip : ""?>" placeholder="Adresse IP" class="form-control" required>
	<input type="text" name="port" value="<?=isset($port) ? $port : ""?>" placeholder="Port" class="form-control" required>
	<select name="protocol" class="form-select">
		<option value="tcp"<?=isset($protocol) && $protocol == "tcp" ? " selected" : ""?>>TCP</option>
		<option value="udp"<?=isset($protocol) && $protocol == "udp" ? " selected" : ""?>>UDP</option>
		<option value="icmp"<?=isset($protocol) && $protocol == "icmp" ? " selected" : ""?>>ICMP</option>
	</select>
	<br>
	<img src="/Captcha.php" alt=""><input type="text" name="captcha" required>
	<input type="submit" class="btn btn-white"><br><br>
</form>
	
<?php
if (!empty($match)) {
?>
<table>
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
			<td><?=$value["country_code"] != "*" ? Locale::getDisplayRegion("-{$value["country_code"]}", "fr") : "*"?> <span class="flag-icon flag-icon-<?=$value["country_code"]?>"></span>
			<td><?=htmlspecialchars($value["isp"])?>
<?php
	}
?>
	</tbody>
</table>
<?php
}

require "Pages/Website/Layout/End.php";