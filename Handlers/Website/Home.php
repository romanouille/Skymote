<?php
$amp = false;

require "Core/GeoIP.class.php";

$ip = $_SERVER["REMOTE_ADDR"] != "127.0.0.1" ? $_SERVER["REMOTE_ADDR"] : "80.11.198.78";

if (!Cache::exists("ip-$ip")) {
	$data = GeoIP::getIpData($ip);
	Cache::write("ip-$ip", json_encode($data));
} else {
	$data = json_decode(Cache::read("ip-$ip"), true);
}

$pageTitle = "Accueil";
$pageDescription = "Accédez aux informations sur une adresse IP grâce à bgp.skymote.net.";
require "Pages/Website/Home.php";