<?php
require "Core/GeoIP.class.php";

if (!Cache::exists("recents-allocations")) {
	$data = GeoIP::getRecentsAllocations();
	Cache::write("recents-allocations", json_encode($data));
} else {
	$data = json_decode(Cache::read("recents-allocations"), true);
}

$pageTitle = "Récentes allocations";
$pageDescription = "Cette page permet d'accéder à la liste de récentes allocations telles que des allocations RIPE, des blocs IP, des AS, ...";

require "Pages/Website/Recent_allocations.php";