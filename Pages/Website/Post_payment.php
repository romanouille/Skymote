<?php
require "Pages/Website/Layout/Start.php";

if (count($_POST) > 0) {
?>
<h1>Paiement effectué</h1>
<p>
	Votre paiement a été effectué avec succès.<br>
<?php
if ($paymentData["price"] > 0) {
?>
		<a href="/account/invoice?id=<?=$invoice?>" title="Facture" target="_blank">Cliquez ici pour accéder à la facture</a><br>
<?php
}
?>
		<a href="/account/" title="Espace client">Cliquez ici pour accéder à l'espace client</a>
</p>
<?php
} else {
?>
<h1>Récapitulatif</h1>
	
<table class="table table-striped">
	<tbody>
<?php
if ($paymentData["product_type"] == 1) {
?>
		<tr>
			<td>Processeur
			<td>4 coeurs CPU @ 2.4GHz
		
		<tr>
			<td>RAM
			<td>8 Go DDR4 ECC
			
		<tr>
			<td>Disque
			<td>50 Go SSD NVMe
		
		<tr>
			<td>Débit Internet
			<td>100Mbps best-effort
			
		<tr>
			<td>IPv4
			<td>1 adresse IP
			
		<tr>
			<td>Virtualisation
			<td>LXC
			
		<tr>
			<td>Système d'exploitation
			<td>Debian 10
<?php
} elseif ($paymentData["product_type"] == 2) {
?>
		<tr>
			<td>Vous allez renouveler le VPS <?=$paymentData["service"]?> pour une durée d'un mois.
<?php
}
?>
	</tbody>
</table>
<br>

<form method="post">
	<input type="hidden" name="action" value="pay">
	<input type="submit" class="btn btn-white" value="Payer">
</form>
<?php
}

require "Pages/Website/Layout/End.php";