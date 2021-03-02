<?php
require "Pages/Website/Layout/Start.php";
?>	
<h1>Factures</h1>

<?php
if (!empty($data)) {
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID
			<th>Horodatage
			<th>Actions
	</thead>
	
	<tbody>
<?php
	foreach ($data as $value) {
?>
		<tr>
			<td><?=$value["id"]?>
			<td><?=date("d/m/Y H:i:s", $value["timestamp"])?>
			<td><a href="/account/invoice?id=<?=$value["id"]?>" title="Accéder à la facture" class="button primary">Accéder à la facture</a>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="remark warning">
	Vous ne possédez aucune facture.
</div>
<?php
}

require "Pages/Website/Layout/End.php";