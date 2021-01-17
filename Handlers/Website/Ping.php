<?php
require "Core/GeoIP.class.php";

if (!empty($match)) {
	$ip = $match[0];
	$port = $match[1];
	$protocol = $match[2];

	if (!GeoIP::validateIp($ip)) {
		http_response_code(400);
		require "Handlers/Website/Error.php";
	}

	if (!in_array($protocol, ["udp", "icmp"]) || $port < 1 || $port > 65535) {
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
		if (Cache::exists("ping-icmp-$ip")) {
			$data = json_decode(Cache::read("ping-icmp-$ip"), true);
		} else {
			$data = GeoIP::icmpPing($ip);
			Cache::write("ping-icmp-$ip", json_encode($data));
		}
	}
	
	$packetsCount = count($data);
	
	if ($protocol != "icmp") {
		$pageTitle = "Ping vers l'adresse IP $ip port $port ($protocol)";
		$pageDescription = "Le ping vers l'adresse IP $ip port $port ($protocol) a permis de recevoir $packetsCount paquet".($packetsCount > 1 ? "s" : "").".";
	} else {
		$pageTitle = "Ping vers l'adresse IP $ip ($protocol)";
		$pageDescription = "Le ping vers l'adresse IP $ip ($protocol) a permis de recevoir $packetsCount paquet".($packetsCount > 1 ? "s" : "").".";
	}
} else {
	$pageTitle = "Ping";
	$pageDescription = "Cet outil permet d'envoyer un ping vers une adresse IP avec un protocole spécifique ainsi qu'un port spécifique.";
}

require "Pages/Website/Ping.php";