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
	1 => 19.99,
	2 => 19.99,
	3 => 0.00,
	4 => 0.00
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
}

if ($products[$match[0]] == 0) {
	if ($match[0] == 4 && isset($match[1])) {
		if (!$server->exists()) {
			http_response_code(404);
			require "Handlers/Website/Error.php";
		}
		
		if (time() < $server->getExpiration()) {
			http_response_code(403);
			require "Handlers/Website/Error.php";
		}
	}
	
	if ($match[0] == 3 && $user->hasFreeServer()) {
		http_response_code(410);
		require "Handlers/Website/Error.php";
	}
		
	$paymentId = sha1(microtime(1).$_SERVER["REMOTE_ADDR"].$_SERVER["REMOTE_PORT"]);
	$user->createPaypalPayment($paymentId, $products[$match[0]], $_SERVER["PHP_AUTH_USER"], $match[0], isset($match[1]) ? $match[1] : "0.0.0.0");
	header("Location: /account/buy/post?paymentId=$paymentId&token=x&PayerID=x");
	exit;
}

$paypal = new Paypal($config["paypal"]["client_id"], $config["paypal"]["secret"]);
$data = $paypal->createPayment($products[$match[0]]);
if (!isset($data["id"])) {
	http_response_code(500);
	require "Handlers/Website/Error.php";
}

$user->createPaypalPayment($data["id"], $products[$match[0]], $_SERVER["PHP_AUTH_USER"], $match[0], isset($match[1]) ? $match[1] : "0.0.0.0");
header("Location: {$data["links"][1]["href"]}");