<?php
require "Pages/Website/Layout/Start.php";
?>	
<p>
	Cette section liste des adresses IP malveillantes (bots) tentant de se connecter à un de nos serveurs honeypot.
</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Adresse IP
			<th>Port source
			<th>Port destination
			<th>Horodatage
			<th>Données
	</thead>
	
	<tbody>
<?php
foreach ($data as $value) {
?>
		<tr>
			<td><a href="/ip/<?=$value["source_ip"]?>" title="<?=$value["source_ip"]?>" target="_blank"><?=$value["source_ip"]?></a>
			<td><?=$value["source_port"]?>
			<td><?=$value["destination_port"]?>
			<td><?=date("d/m/Y H:i:s", $value["timestamp"])?>
			<td><pre><?=nl2br(htmlspecialchars(str_replace("5.39.78.72", "xx.xx.xx.xx", utf8_decode(base64_decode($value["data"])))))?></pre>
<?php
}
?>
	</tbody>
</table>
<?php
require "Pages/Website/Layout/End.php";