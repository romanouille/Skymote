<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>API</h1>
<p>
	L'API Nextly fournit des informations sur des adresses IP données, telles que leur géolocalisation.<br>
	Les réponses de l'API sont en JSON, il n'y a pas de limite d'utilisation.
</p>

<h2>Utilisation</h2>
<p>
	Afin de créer une requête vers l'API du site, il suffit de copier une URL classique du site (comme https://bgp.nextly.gg/ip/2.0.0.0) et d'inclure l'entête HTTP : "<b>Accept: application/json</b>".<br><br>
	Exemple avec cURL :<br>
	<pre>curl -H "Accept: application/json" https://nextly.gg/ip/2.0.0.0</pre>
	<br>
	Le résultat de la commande devrait ressembler à :<br>
	<span style="font-family:Courier;max-width:75%">{"block":{"version":4,"block":"2.0.0.0\/12","block_start":"2.0.0.0","block_end":"2.15.255.255","country":"fr","isp":199140,"created":1278892800,"rir":4},"isp":{"name":"ORE-AS Orange S.A.","country":"fr"},"allocations":[{"version":4,"block":"2.0.0.0\/12","block_start":"2.0.0.0","block_end":"2.15.255.255","org":"org-ft2-ripe","country":"fr","netname":"FR-TELECOM-20100712","description":"","remarks":"","status":"ALLOCATED PA","created":1278942874,"modified":1491833797}],"routes":[{"version":4,"block":"2.0.0.0\/16","block_start":"2.0.0.0","block_end":"2.0.255.255","description":"France Telecom Orange","origin":3215,"created":1353576716,"modified":1353576716}]}</span>
</p>
<?php
require "Pages/Website/Layout/End.php";