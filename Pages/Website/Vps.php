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
				<td>Virtualisation
				<td>Prix mensuel
				<td>
			</tr>
		</thead>
		
		<tbody>
			<tr>
				<td>1 coeur @ 2.4GHz
				<td>500 Mo
				<td>2 Go SSD
				<td>8Mbps
				<td>LXC
				<td>1,49€
				<td><a href="/account/buy/init?product=1" title="Commander" class="button success"<?=!Server::isAvailable(1) ? " disabled" : ""?>>Commander</a>
			
			<tr>
				<td>4 coeurs @ 2.4GHz
				<td>16 Go
				<td>50 Go SSD
				<td>500Mbps
				<td>KVM
				<td>34,99€
				<td><a href="/account/buy/init?product=3" title="Commander" class="button success"<?=!Server::isAvailable(2) ? " disabled" : ""?>>Commander</a>
			
			<tr>
				<td>8 coeurs @ 2.4GHz
				<td>32 Go
				<td>100 Go SSD
				<td>500Mbps
				<td>KVM
				<td>54,99€
				<td><a href="/account/buy/init?product=5" title="Commander" class="button success"<?=!Server::isAvailable(3) ? " disabled" : ""?>>Commander</a>
		</tbody>
	</table>
	
	<div class="remark primary">
		Un serveur privé virtuel (VPS) est le meilleur compromis entre un hébergement mutualisé et un serveur dédié.<br>
		Afin de virtualiser les VPS, nous utilisons les technologies LXC et KVM, selon les offres.<br><br>
		
		
		➡️ <b>Configurations des serveurs hôtes</b>
		<ul>
			<li>Processeurs Intel Xeon
			<li>128 Go RAM DDR4 au minimum
			<li>Disques SSD
			<li>500Mbps par hôte (débit mutualisé entre les VPS)
			<li>Localisés en France
		</ul>
		<br>
		
		➡️ <b>Virtualisation</b>
		<ul>
			<li>Technologies LXC et KVM
			<li>Ressources CPU et RAM garanties pour les offres KVM
			<li>Panel Proxmox inclus pour les offres KVM
		</ul><br>
		
		➡️ <b>Divers</b>
		<ul>
			<li>Trafic illimité
			<li>Livraison instantanée
			<li>Sauvegardes quotidiennes
		</ul>
	</div>
	
	<div class="remark warning">
		⚠ Les VPS LXC ne supportent pas les applications telles que Docker, Pterodactyl, et tout autre application nécessitant de modifier le noyau Linux.
	</div>️
</div>
<?php
require "Pages/Website/Layout/End.php";