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
	header("Location: /tools/ping?ip=$ip&port=$port&protocol=$protocol");
	exit;
}

if ($protocol == "tcp") {
	$data = GeoIP::tcpPing($ip, $port);
} elseif ($protocol == "udp") {
	$data = GeoIP::udpPing($ip, $port);
} elseif ($protocol == "icmp") {
	$data = GeoIP::icmpPing($ip);
}

require "Pages/Website/Ping.php";