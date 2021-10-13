<?php
require "Pages/$version/Layout/Start.php";
?>
<h1>API</h1>
<p>
	L'API Skymote permet d'obtenir des informations sur des adresses IP données, telles que leur géolocalisation.<br>
	Les réponses de l'API sont en JSON, il n'y a aucune limite d'utilisation.
</p>

<h2>Utilisation</h2>
<p>
	Afin de créer une requête vers l'API du site, il suffit de recopier une URL classique du site (comme par exemple https://skymote.net/ip/2.0.0.0) et d'y inclure l'en-tête HTTP "<b>Accept: application/json</b>".<br><br>
	Exemple avec cURL :<br>
	<pre>curl -H "Accept: application/json" https://skymote.net/ip/2.0.0.0</pre>
	<br>
	Le résultat de cette commande est :<br>
	<pre>{"block":{"version":4,"block":"2.0.0.0\/12","block_start":"2.0.0.0","block_end":"2.15.255.255","country":"fr","lir":199140,"created":1278892800,"rir":4},"lir":{"name":"ORE-AS Orange S.A.","country":"fr"},"allocations":[{"version":4,"block":"2.0.0.0\/12","block_start":"2.0.0.0","block_end":"2.15.255.255","org":"org-ft2-ripe","country":"fr","netname":"FR-TELECOM-20100712","description":"","remarks":"","status":"ALLOCATED PA","created":1278942874,"modified":1491833797}],"routes":[{"version":4,"block":"2.0.0.0\/16","block_start":"2.0.0.0","block_end":"2.0.255.255","description":"France Telecom Orange","origin":3215,"created":1353576716,"modified":1353576716}]}</pre>
</p>
<?php
require "Pages/$version/Layout/End.php";