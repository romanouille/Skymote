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
			<td>Nom d'utilisateur SSH
			<td>user
			
		<tr>
			<td>Mot de passe
			<td><?=$data["password"]?>
			
		<tr>
			<td>Expiration
			<td><?=date("d/m/Y H:i:s", $data["expiration"])?>
<?php
if (!empty($data["hypervisor_password"])) {
?>
		<tr>
			<td>URL vers l'hyperviseur
			<td><a href="https://<?=$data["hypervisor"]?>:8006" title="Hyperviseur">https://<?=$data["hypervisor"]?>:8006</a>
		
		<tr>
			<td>Identifiant vers l'hyperviseur
			<td><?=$match[0]?>
			
		<tr>
			<td>Mot de passe vers l'hyperviseur
			<td><?=$data["hypervisor_password"]?>
<?php
}
?>
	</table>
	<br>
<?php
if ($data["type"] == 1) {
	$renewProduct = 2;
} elseif ($data["type"] == 2) {
	$renewProduct = 4;
} elseif ($data["type"] == 3) {
	$renewProduct = 6;
}
?>

	<a href="/account/buy/init?product=<?=$renewProduct?>&service=<?=$match[0]?>" class="button primary">Renouveler le VPS pour 1 mois</a>

</div>
<?php
require "Pages/Website/Layout/End.php";