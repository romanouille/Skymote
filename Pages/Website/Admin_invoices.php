<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Factures</a>
	</ul>
	
	<h1>Factures</h1>
	<table class="table striped">
		<thead>
			<tr>
				<th>ID
				<th>Utilisateur
				<th>Horodatage
				<th>Actions
		</thead>
		
		<tbody>
<?php
foreach ($data as $value) {
?>
			<tr>
				<td><?=$value["id"]?>
				<td><?=$value["user_email"]?>
				<td><?=date("d/m/Y H:i:s", $value["timestamp"])?>
				<td><a href="/account/invoice?id=<?=$value["id"]?>" title="Accéder à la facture" class="button primary">Accéder à la facture</a>
<?php
}
?>
		</tbody>
	</table>
</div>
<?php
require "Pages/Website/Layout/End.php";