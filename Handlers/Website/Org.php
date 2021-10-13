<?php
require "Core/GeoIP.class.php";

if (!Cache::exists("org-{$match[0]}")) {
	$data = GeoIP::getOrgData($match[0]);
	if (empty($data)) {
		http_response_code(404);
		require "Handlers/Website/Error.php";
	}
	
	Cache::write("org-{$match[0]}", json_encode($data));
} else {
	$data = json_decode(Cache::read("org-{$match[0]}"), true);
}

$pageTitle = $match[0];
$pageDescription = "The RIPE organisation '{$match[0]}' is named '{$data["name"]}', it is ".($data["is_lir"] ? "LIR" : "not LIR")." and has been created the ".date("d/m/Y à H:i:s", $data["created"]).".";

require "Pages/$version/Org.php";