<?php
require "Pages/$version/Layout/Start.php";
?>
<h1>API</h1>
<p>
	The Skymote API provides information on given IP addresses, such as their geolocation. <br>
	The responses of the API are in JSON, there is no limit of use.
</p>

<h2>Usage</h2>
<p>
	In order to create a request to the site's API, all you have to do is copy a classic URL of the site (such as https://skymote.net/ip/2.0.0.0) and include the HTTP header. "<b>Accept: application/json</b>".<br><br>
	Example with cURL :<br>
	<pre>curl -H "Accept: application/json" https://skymote.net/ip/2.0.0.0</pre>
	<br>
	The result of this command is :<br>
	<pre>{"block":{"version":4,"block":"2.0.0.0\/12","block_start":"2.0.0.0","block_end":"2.15.255.255","country":"fr","lir":199140,"created":1278892800,"rir":4},"lir":{"name":"ORE-AS Orange S.A.","country":"fr"},"allocations":[{"version":4,"block":"2.0.0.0\/12","block_start":"2.0.0.0","block_end":"2.15.255.255","org":"org-ft2-ripe","country":"fr","netname":"FR-TELECOM-20100712","description":"","remarks":"","status":"ALLOCATED PA","created":1278942874,"modified":1491833797}],"routes":[{"version":4,"block":"2.0.0.0\/16","block_start":"2.0.0.0","block_end":"2.0.255.255","description":"France Telecom Orange","origin":3215,"created":1353576716,"modified":1353576716}]}</pre>
</p>
<?php
require "Pages/$version/Layout/End.php";