<?php
require "Core/GeoIP.class.php";

if (!Cache::exists("ripe-ipv4-waiting-list")) {
	$data = GeoIP::getRipeIpv4WaitingList();
	Cache::write("ripe-ipv4-waiting-list", json_encode($data));
} else {
	$data = json_decode(Cache::read("ripe-ipv4-waiting-list"), true);
}

$pageTitle = "Liste d'attente IPv4 RIPE";
$pageDescription = "Cette page affiche les blocs IPv4 /24 récemment attribués aux LIR inscrits à la liste d'attente IPv4 du RIPE.";

require "Pages/Website/Ripe_ipv4_waiting_list.php";