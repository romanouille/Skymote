<?php
require "Core/GeoIP.class.php";

$ip = $match[0];
$port = $match[1];
$protocol = $match[2];

if (!GeoIP::validateIp($ip)) {
	http_response_code(400);
	require "Handlers/Website/Error.php";
}

if (!in_array($protocol, ["tcp", "udp", "icmp"])) {
	http_response_code(400);
	require "Handlers/Website/Error.php";
}

$ip = GeoIP::reduceIp($ip);
if ($ip != $match[0]) {
	header("Location: /tools/traceroute?ip=$ip&port=$port&protocol=$protocol");
	exit;
}

if (Cache::exists("traceroute-$ip-$port-$protocol")) {
	$data = json_decode(Cache::read("traceroute-$ip-$port-$protocol"), true);
} else {
	$data = GeoIP::traceroute($ip, $port, $protocol);
	Cache::write("traceroute-$ip-$port-$protocol", json_encode($data));
}

require "Pages/Website/Traceroute.php";