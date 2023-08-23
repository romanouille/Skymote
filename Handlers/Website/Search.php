<?php
$amp = false;

require "Core/GeoIP.class.php";
$match[0] = urldecode($match[0]);

if (GeoIP::validateIp($match[0])) {
	header("Location: /ip/{$match[0]}");
	exit;
}

if (!Cache::exists("search-{$match[0]}")) {
	$data = GeoIP::search($match[0]);
	Cache::write("search-{$match[0]}", json_encode($data));
} else {
	$data = json_decode(Cache::read("search-{$match[0]}"), true);
}
$pageTitle = "Recherche";
$pageDescription = "Résultats de la recherche pour '{$match[0]}'.";

require "Pages/Website/Search.php";