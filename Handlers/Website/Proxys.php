<?php
require "Core/GeoIP.class.php";

if (!Cache::exists("proxys")) {
	$data = GeoIP::getProxysList();
	Cache::write("proxys", json_encode($data));
} else {
	$data = json_decode(Cache::read("proxys"), true);
}

$pageTitle = "Proxys Socks5";
$pageDescription = "Cette liste se compose de ".count($data)." proxys utilisables avec le protocole Socks5.";

require "Pages/Website/Proxys.php";