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
	if (Cache::exists("ping-tcp-$ip-$port")) {
		$data = json_decode(Cache::read("ping-tcp-$ip-$port"), true);
	} else {
		$data = GeoIP::tcpPing($ip, $port);
		Cache::write("ping-tcp-$ip-$port", json_encode($data));
	}
} elseif ($protocol == "udp") {
	if (Cache::exists("ping-udp-$ip-$port")) {
		$data = json_decode(Cache::read("ping-udp-$ip-$port"), true);
	} else {
		$data = GeoIP::udpPing($ip, $port);
		Cache::write("ping-udp-$ip-$port", json_encode($data));
	}
} elseif ($protocol == "icmp") {
	if (Cache::exists("ping-icmp-$ip-$port")) {
		$data = json_decode(Cache::read("ping-icmp-$ip-$port"), true);
	} else {
		$data = GeoIP::icmpPing($ip);
		Cache::write("ping-icmp-$ip-$port", json_encode($data));
	}
}

require "Pages/Website/Ping.php";