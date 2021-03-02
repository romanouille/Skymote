<?php
require "Pages/Website/Layout/Start.php";
?>	
<h1>Factures</h1>
<table class="table table-striped">
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
			<td><a href="/account/invoice?id=<?=$value["id"]?>" title="Accéder à la facture" class="btn btn-sm">Accéder à la facture</a>
<?php
}
?>
	</tbody>
</table>
<?php
require "Pages/Website/Layout/End.php";