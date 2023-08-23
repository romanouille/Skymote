<?php
require "Core/GeoIP.class.php";

if (!Cache::exists("bgp-events")) {
	$data = GeoIP::getBgpEvents();
	Cache::write("bgp-events", json_encode($data), 5);
} else {
	$data = json_decode(Cache::read("bgp-events"), true);
}

$pageTitle = "Évènements BGP";
$pageDescription = "Liste des évènements BGP en direct.";

require "Pages/Website/Bgp_events.php";