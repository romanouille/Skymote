<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

require "Core/Paypal.class.php";

if (isset($match[1]) && !$user->hasServer($match[1])) {
	http_response_code(400);
	require "Handlers/Website/Error.php";
}

$products = [
	1 => 39.99, // Windows 10
	2 => 39.99, // Windows 10 renouvellement
	3 => 0.99, // Debian-1
	4 => 0.99, // Debian-1 renouvellement
	5 => 34.99, // Debian-2
	6 => 34.99, // Debian-2 renouvellement
	7 => 54.99, // Debian-3
	8 => 54.99, // Debian-3 renouvellement
];

if (!isset($products[$match[0]])) {
	http_response_code(404);
	require "Handlers/Website/Error.php";
}

$paypal = new Paypal($config["paypal"]["client_id"], $config["paypal"]["secret"]);
$data = $paypal->createPayment($products[$match[0]]);
if (!isset($data["id"])) {
	http_response_code(500);
	require "Handlers/Website/Error.php";
}

$user->createPaypalPayment($data["id"], $products[$match[0]], $_SERVER["PHP_AUTH_USER"], $match[0], isset($match[1]) ? $match[1] : "0.0.0.0");
header("Location: {$data["links"][1]["href"]}");