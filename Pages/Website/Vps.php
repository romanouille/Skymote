<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>VPS Debian</h1>
	<table class="table striped">
		<thead>
			<tr>
				<th>CPU
				<td>Mémoire RAM
				<td>Stockage
				<td>Débit Internet
				<td>Adresses IPv4
				<td>Virtualisation
				<td>OS
				<td>Prix mensuel
				<td>
			</tr>
		</thead>
		
			<tr>
				<td>8 coeurs @ 2.4GHz
				<td>32 Go DDR4 ECC
				<td>50 Go SSD NVMe
				<td>500Mbps best-effort
				<td>/29 (8 adresses)
				<td>KVM
				<td>Debian
				<td>19,99€
				<td><a href="/account/buy/init?product=1" title="Commander" class="button success"<?=!Server::isAvailable(1) ? " disabled" : ""?>>Commander</a>
		
			<tr>
				<td>16 coeurs @ 2.4GHz
				<td>64 Go DDR4 ECC
				<td>100 Go SSD NVMe
				<td>500Mbps best-effort
				<td>/28 (16 adresses)
				<td>KVM
				<td>Debian
				<td>39,99€
				<td><a href="/account/buy/init?product=3" title="Commander" class="button success"<?=!Server::isAvailable(2) ? " disabled" : ""?>>Commander</a>
		</tbody>
	</table>
	
	<div class="remark primary">
		➡️ <b>Configurations des serveurs hôtes</b>
		<ul>
			<li>Processeurs Intel Xeon
			<li>128 Go RAM DDR4 au minimum
			<li>Disques SSD NVMe
			<li>500Mbps par hôte (débit mutualisé entre les VPS)
			<li>Localisés en France
		</ul>
		<br>
		
		➡️ <b>Virtualisation</b>
		<ul>
			<li>Technologie KVM
		</ul><br>
		
		➡️ <b>Divers</b>
		<ul>
			<li>Trafic illimité
			<li>Livraison instantanée
			<li>Sauvegardes quotidiennes
		</ul>
	</div>
</div>
<?php
require "Pages/Website/Layout/End.php";