<?php
require "Core/GeoIP.class.php";

if (!Cache::exists("stats")) {
	$result = [];
	$file = explode("\n", file_get_contents("../logs/access.log"));

	foreach ($file as $line) {
		$line = explode(" ", $line, 2);
		$ip = trim($line[0]);
		
		if (empty($ip)) {
			continue;
		}
		
		if (!Cache::exists("ip-$ip")) {
			$data = GeoIP::getIpData($ip);
			Cache::write("ip-$ip", json_encode($data));
		} else {
			$data = json_decode(Cache::read("ip-$ip"), true);
		}
		
		if (isset($result["isp"][$data["block"]["isp"]])) {
			$result["isp"][$data["block"]["isp"]]["nb"]++;
		} else {
			$result["isp"][$data["block"]["isp"]] = [
				"nb" => 1,
				"name" => isset($data["isp"]["name"]) && !empty($data["isp"]["name"]) ? $data["isp"]["name"] : "*",
				"country" => $data["isp"]["country"]
			];
		}
	}
	
	Cache::write("stats", json_encode($result));
} else {
	$result = json_decode(Cache::read("stats"), true);
}

$pageTitle = "Statistiques d'utilisation du site";
$pageDescription = "Cette page liste les FAI se rendant sur le site Nextly.";

require "Pages/Website/Stats.php";