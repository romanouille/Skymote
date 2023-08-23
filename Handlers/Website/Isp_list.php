<?php
$amp = false;

require "Core/GeoIP.class.php";

if (isset($match[0])) {
	if (!in_array($match[0], $countries)) {
		http_response_code(404);
		require "Handlers/Website/Error.php";
	}
	
	if (!Cache::exists("isp-list-{$match[0]}")) {
		$data = GeoIP::getIspList($match[0]);
		Cache::write("isp-list-{$match[0]}", json_encode($data));
	} else {
		$data = json_decode(Cache::read("isp-list-{$match[0]}"), true);
	}
	
	$pageTitle = "Liste des fournisseurs d'accès Internet";
	$pageDescription = "Liste des fournisseurs d'accès Internet dans la région '".Locale::getDisplayRegion("-{$match[0]}", "fr")."'.";
} else {
	$pageTitle = "Liste des fournisseurs d'accès Internet";
	$pageDescription = "Liste des fournisseurs d'accès Internet dans un pays spécifique.";
}

$countriesName = [];
foreach ($countries as $countryCode) {
	$countriesName[$countryCode] = Locale::getDisplayRegion("-$countryCode", "fr");
}
asort($countriesName);

require "Pages/Website/Isp_list.php";