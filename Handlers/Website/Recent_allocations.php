<?php
require "Core/GeoIP.class.php";

if (!Cache::exists("recents-allocations")) {
	$data = GeoIP::getRecentsAllocations();
	Cache::write("recents-allocations", json_encode($data));
} else {
	$data = json_decode(Cache::read("recents-allocations"), true);
}

$pageTitle = "Recent allocations";
$pageDescription = "This page provides access to the list of recent allocations such as RIPE allocations, IP blocks, ASs, ...";

require "Pages/$version/Recent_allocations.php";