<?php
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
	
	$pageTitle = "List of Internet Service Providers";
	$pageDescription = "List of Internet service providers in the region '".Locale::getDisplayRegion("-{$match[0]}", "en")."'.";
} else {
	$pageTitle = "List of Internet Service Providers";
	$pageDescription = "List of Internet service providers in a specific country.";
}

$countriesName = [];
foreach ($countries as $countryCode) {
	$countriesName[$countryCode] = Locale::getDisplayRegion("-$countryCode", "en");
}
asort($countriesName);

require "Pages/$version/Isp_list.php";