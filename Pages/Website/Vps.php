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
				<td>480 Go
				<td>1Gbps
				<td>39,99€
				<td><a href="/account/vps/buy/windows" title="Commander" class="button success">Commander</a>
			</tr>
		</tbody>
	</table>
	<br><br>
	
	<h1>VPS Debian 10</h1>
	<table class="table striped">
		<thead>
			<tr>
				<th>CPU
				<td>Mémoire RAM
				<td>Stockage
				<td>Port réseau
				<td>Prix mensuel
				<td>
			</tr>
		</thead>
		
		<tbody>
			<tr>
				<td>1 coeur @ 2.4GHz
				<td>500 Mo
				<td>2 Go
				<td>100Mbps
				<td>Gratuit
				<td><a href="/account/vps/buy/debian" title="Commander" class="button success">Commander</a>
			</tr>
		</tbody>
	</table>
</div>
<?php
require "Pages/Website/Layout/End.php";