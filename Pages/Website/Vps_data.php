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
			<td>Mot de passe
			<td><?=$data["password"]?>
			
		<tr>
			<td>Expiration
			<td><?=date("d/m/Y H:i:s", $data["expiration"])?>
			
		<tr>
			<td>URL vers l'hyperviseur
			<td><a href="https://<?=$data["hypervisor"]?>:8006" title="Hyperviseur">https://<?=$data["hypervisor"]?>:8006</a>
		
		<tr>
			<td>Identifiant vers l'hyperviseur
			<td><?=$match[0]?>
			
		<tr>
			<td>Mot de passe vers l'hyperviseur
			<td><?=$data["hypervisor_password"]?>
	</table>
</div>
<?php
require "Pages/Website/Layout/End.php";