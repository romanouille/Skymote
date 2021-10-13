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
	require "Handlers/Website/Error.php";
}

$slugTest = slug($data["name"]);
if ($ispSlug != $slugTest) {
	header("Location: /isp/$ispId-$slugTest");
	exit;
}

$blocksCount = count($data["blocks"]);
$pageTitle = $data["name"];
$pageDescription = "The Internet Service Provider '{$data["name"]}' is located in '".Locale::getDisplayRegion("-{$data["country"]}", "en")."', it owns $blocksCount".($blocksCount > 1 ? "s" : "")." IP blocks.";

require "Pages/$version/Isp.php";