<?php
require "Core/GeoIP.class.php";

$ip = explode("/", $_SERVER["REQUEST_URI"]);
$ip = end($ip);

if (!Cache::exists("ip-$ip")) {
	$data = GeoIP::getIpData($ip);
	Cache::write("ip-$ip", json_encode($data));
} else {
	$data = json_decode(Cache::read("ip-$ip"), true);
}
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

$pageTitle = "Adresse IPv{$data["block"]["version"]} $ip";
$pageDescription = "L'adresse IPv{$data["block"]["version"]} est localisée dans la région '".Locale::getDisplayRegion("-".(isset($data["lir"]["country"]) && $data["lir"]["country"] != "ZZ" ? $data["lir"]["country"] : $data["block"]["country"]))."', son fournisseur d'accès Internet est ".(isset($data["lir"]["name"]) && !empty($data["lir"]["name"]) && $data["lir"]["name"] != "*" ? "'{$data["lir"]["name"]}'" : "inconnu").".";

require "Pages/Website/Ip.php";