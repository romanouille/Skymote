<?php
require "Core/GeoIP.class.php";

$ip = explode("/", $_SERVER["REQUEST_URI"]);
$ip = end($ip);

$data = GeoIP::getIpData($ip);
if (empty($data)) {
	http_response_code(404);
	require "Handlers/Website/Error.php";
}

$oldIp = $ip;
$ip = GeoIP::reduceIp($ip);

if ($oldIp != $ip) {
	header("Location: /ip/$ip");
	exit;
}

require "Pages/Website/Ip.php";