<?php
require "Core/GeoIP.class.php";

$ispId = $match[0];
$ispSlug = $match[1];

if (!Cache::exists("isp-$ispId")) {
	$data = GeoIP::getIspData($ispId);
	Cache::write("isp-$ispId", json_encode($data));
} else {
	$data = json_decode(Cache::read("isp-$ispId"), true);
}
if (empty($data)) {
	http_response_code(404);
	require "Handlers/Error.php";
}

$slugTest = slug($data["name"]);
if ($ispSlug != $slugTest) {
	header("Location: /isp/$ispId-$slugTest");
	exit;
}

$blocksCount = count($data["blocks"]);
$pageTitle = $data["name"];
$pageDescription = "Le fournisseur d'accès Internet '{$data["name"]}' est localisé dans la région '".Locale::getDisplayRegion("-{$data["country"]}", "fr")."', il possède $blocksCount bloc".($blocksCount > 1 ? "s" : "")." IP.";

require "Pages/Website/Isp.php";