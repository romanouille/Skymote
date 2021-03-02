<?php
if (!$userLogged) {
	header("Location: /account/register");
	exit;
}

require "Core/Paypal.class.php";
require "Core/Server.class.php";

if (isset($match[1]) && !$user->hasServer($match[1])) {
	http_response_code(404);
	require "Handlers/Website/Error.php";
}

$products = [
	1 => 9.99,
	2 => 9.99
];

if (!isset($products[$match[0]])) {
	http_response_code(404);
	require "Handlers/Website/Error.php";
}

if (isset($match[1])) {
	$server = new Server($match[1]);
	$serverData = $server->load();
	
	if (($match[0] == 2 && $serverData["type"] != 1) || ($match[0] == 4 && $serverData["type"] != 2)) {
		http_response_code(400);
		require "Handlers/Website/Error.php";
	}
} else {
	if (!Server::isAvailable($match[0])) {
		http_response_code(503);
		require "Handlers/Website/Error.php";
	}
}

$paypal = new Paypal($config["paypal"]["client_id"], $config["paypal"]["secret"]);
$data = $paypal->createPayment($products[$match[0]]);
if (!isset($data["id"])) {
	http_response_code(500);
	require "Handlers/Website/Error.php";
}

$user->createPaypalPayment($data["id"], $products[$match[0]], $_SERVER["PHP_AUTH_USER"], $match[0], isset($match[1]) ? $match[1] : "0.0.0.0");
header("Location: {$data["links"][1]["href"]}");