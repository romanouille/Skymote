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
$pageDescription = "L'organisation RIPE '{$match[0]}' est nommée '{$data["name"]}', elle ".($data["is_lir"] ? "est LIR" : "n'est pas LIR")." et a été créée le ".date("d/m/Y à H:i:s", $data["created"]).".";

require "Pages/Website/Org.php";