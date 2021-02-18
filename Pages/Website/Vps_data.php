<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>VPS <?=$match[0]?></h1>
	<table class="table striped">
		<tr>
			<td>Identifiants utilisateur
			<td>user / <?=$data["password"]?>
			
		<tr>
			<td>Identifiants root
			<td>root / <?=$data["root_password"]?>
			
		<tr>
			<td>Expiration
			<td><?=date("d/m/Y H:i:s", $data["expiration"])?>
			
		<tr>
			<td>Adresses IPv4
			<td>
<?php
$baseIp = explode(".", $match[0]);
$baseIpEnd = $baseIp[3]+7;

for ($i = $baseIp[3]; $i <= $baseIpEnd; $i++) {
	echo "{$baseIp[0]}.{$baseIp[1]}.{$baseIp[2]}.$i<br>";
}
?>
<?php
if (!empty($data["hypervisor_password"])) {
?>
		<tr>
			<td>URL de l'hyperviseur
			<td><a href="https://<?=$data["hypervisor"]?>.skymote.net:8006" title="Hyperviseur" target="_blank">https://<?=$data["hypervisor"]?>.skymote.net:8006</a>
		
		<tr>
			<td>Identifiant de l'hyperviseur
			<td><?=$match[0]?>
			
		<tr>
			<td>Mot de passe de l'hyperviseur
			<td><?=$data["hypervisor_password"]?>
<?php
}
?>
	</table>
	<br>
<?php
if ($data["type"] == 1) {
	$renewProduct = 2;
}
?>
	<a href="/account/buy/init?product=<?=$renewProduct?>&service=<?=$match[0]?>" class="button primary">Renouveler le VPS pour 1 mois</a>

</div>
<?php
require "Pages/Website/Layout/End.php";