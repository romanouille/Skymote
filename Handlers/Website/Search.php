<?php
require "Core/GeoIP.class.php";
$match[0] = urldecode($match[0]);

if (GeoIP::validateIp($match[0])) {
	header("Location: /ip/{$match[0]}");
	exit;
}

$data = GeoIP::search($match[0]);

require "Pages/Website/Search.php";