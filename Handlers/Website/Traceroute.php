<?php
$amp = false;

require "Core/GeoIP.class.php";

if (!empty($match)) {
	$ip = $match[0];
	$port = $match[1];
	$protocol = $match[2];

	if (!GeoIP::validateIp($ip)) {
		http_response_code(400);
		require "Handlers/Website/Error.php";
	}

	if (!in_array($protocol, ["tcp", "udp", "icmp"]) || $port < 1 || $port > 65535) {
		http_response_code(400);
		require "Handlers/Website/Error.php";
	}

	$ip = GeoIP::reduceIp($ip);
	if ($ip != $match[0]) {
		header("Location: /tools/traceroute?ip=$ip&port=$port&protocol=$protocol");
		exit;
	}

	if ($protocol != "icmp") {
		if (Cache::exists("traceroute-$ip-$port-$protocol")) {
			$data = json_decode(Cache::read("traceroute-$ip-$port-$protocol"), true);
		} else {
			$data = GeoIP::traceroute($ip, $port, $protocol);
			Cache::write("traceroute-$ip-$port-$protocol", json_encode($data));
		}
	} else {
		if (Cache::exists("traceroute-$ip-$protocol")) {
			$data = json_decode(Cache::read("traceroute-$ip-$protocol"), true);
		} else {
			$data = GeoIP::traceroute($ip, $port, $protocol);
			Cache::write("traceroute-$ip-$protocol", json_encode($data));
		}
	}
	
	$packetsCount = count($data);
	
	if ($protocol != "icmp") {
		$pageTitle = "Traceroute vers $ip port $port ($protocol)";
		$pageDescription = "Le traceroute vers $ip port $port ($protocol) a permis de recevoir $packetsCount paquet".($packetsCount > 1 ? "s" : "").".";
	} else {
		$pageTitle = "Traceroute vers $ip ($protocol)";
		$pageDescription = "Le traceroute vers $ip ($protocol) a permis de recevoir $packetsCount paquet".($packetsCount > 1 ? "s" : "").".";
	}
} else {
	$pageTitle = "Traceroute";
	$pageDescription = "Cette page permet d'effectuer un traceroute vers une adresse IP avec un protocole spécifique ainsi qu'un port spécifique.";
}

require "Pages/Website/Traceroute.php";