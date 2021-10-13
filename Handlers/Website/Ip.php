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

$pageTitle = "IPv{$data["block"]["version"]} address $ip";
$pageDescription = "The IPv{$data["block"]["version"]} address is located in '".Locale::getDisplayRegion("-".(isset($data["lir"]["country"]) && $data["lir"]["country"] != "ZZ" ? $data["lir"]["country"] : $data["block"]["country"]), "en")."', his Internet service provider is ".(isset($data["lir"]["name"]) && !empty($data["lir"]["name"]) && $data["lir"]["name"] != "*" ? "'{$data["lir"]["name"]}'" : "unknown").".";

require "Pages/$version/Ip.php";