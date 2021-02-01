<?php
require "Pages/Website/Layout/Start.php";

?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>VPS Windows 10</h1>
	<table class="table striped">
		<thead>
			<tr>
				<th>CPU
				<th>Mémoire RAM
				<th>Stockage
				<th>Port réseau
				<th>Prix mensuel
			</tr>
		</thead>
		
		<tbody>
			<tr>
				<td>8 coeurs @ 2.4GHz
				<td>30 Go
				<td>480 Go
				<td>1Gbps
				<td>39,99€
			</tr>
		</tbody>
	</table>
	
<?php
if ($userLogged) {
	if (Server::isAvailable(1)) {
?>
	<div class="remark primary">
		<a href="/account/buy/init?product=1" title="Cliquez ici pour payer avec PayPal">Cliquez ici pour payer avec PayPal</a>
	</div>
<?php
	} else {
?>
	<div class="remark warning">
		Ce produit est temporairement en rupture de stock. Veuillez réessayer plus tard.
	</div>
<?php
	}
} else {
?>
	<div class="remark alert">
		Vous devez être connecté afin de commander un VPS Windows 10.<br>
		<a href="/account/login" title="Connexion">Cliquez ici pour vous connecter</a>
	</div>
<?php
}
?>
</div>
<?php

require "Pages/Website/Layout/End.php";