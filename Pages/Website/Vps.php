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
				<th>
			</tr>
		</thead>
		
		<tbody>
			<tr>
				<td>8 coeurs @ 2.4GHz
				<td>30 Go
				<td>480 Go HDD
				<td>1Gbps
				<td>39,99€
				<td><a href="/account/buy/init?product=1" title="Commander" class="button success">Commander</a>
			</tr>
		</tbody>
	</table>
	<br><br>
	
	<h1>VPS Debian</h1>
	<table class="table striped">
		<thead>
			<tr>
				<th>CPU
				<td>Mémoire RAM
				<td>Stockage
				<td>Port réseau
				<td>Virtualisation
				<td>Prix mensuel
				<td>
			</tr>
		</thead>
		
		<tbody>
			<tr>
				<td>1 coeur @ 2.4GHz
				<td>500 Mo
				<td>1 Go SSD
				<td>100Mbps
				<td>LXC
				<td>0,99€
				<td><a href="/account/buy/init?product=3" title="Commander" class="button success">Commander</a>
			
			<tr>
				<td>4 coeurs @ 2.4GHz
				<td>16 Go
				<td>50 Go SSD
				<td>1Gbps
				<td>KVM
				<td>34,99€
				<td><a href="/account/buy/init?product=5" title="Commander" class="button success">Commander</a>
			
			<tr>
				<td>8 coeurs @ 2.4GHz
				<td>32 Go
				<td>100 Go SSD
				<td>1Gbps
				<td>KVM
				<td>54,99€
				<td><a href="/account/buy/init?product=7" title="Commander" class="button success">Commander</a>
		</tbody>
	</table>
	
	<p>Les VPS KVM possèdent des coeurs CPU dédiés.</p>
</div>
<?php
require "Pages/Website/Layout/End.php";