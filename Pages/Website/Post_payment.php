<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Paiement #<?=$match[0]?></a>
	</ul>
	
	<div class="remark primary">
		Votre paiement a été effectué avec succès.<br>
<?php
if ($paymentData["price"] > 0) {
?>
		<a href="/account/invoice?id=<?=$invoice?>" title="Facture" target="_blank">Cliquez ici pour accéder à la facture</a><br>
<?php
}
?>
		<a href="/account/" title="Espace client">Cliquez ici pour accéder à l'espace client</a>
	</div>
</div>
<?php
require "Pages/Website/Layout/End.php";