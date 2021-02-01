<?php
require "Core/Paypal.class.php";
require "Core/Server.class.php";

if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Error.php";
}

$paymentData = $user->loadPaypalPayment($match[0]);
if (empty($paymentData)) {
	http_response_code(400);
	require "Handlers/Website/Error.php";
}

if ($paymentData["product"] == 1) {
	if (!Server::isAvailable(1)) {
		http_response_code(503);
		require "Handlers/Website/Error.php";
	}
}

$paypal = new Paypal($config["paypal"]["client_id"], $config["paypal"]["secret"]);
if ($paypal->validatePayment($match[0], $match[2])) {
	$user->setPaymentAsPaid($match[0]);
	
	if ($paymentData["product"] == 1) {
		$invoice = $user->createInvoice([["VPS Windows 10", "Du ".date("d/m/Y")." au ".date("d/m/Y", strtotime("+1 month"))."\n8 coeurs CPU\n30 Go RAM\n480 Go HDD\n1Gbps", 1, 0, 39.99, 0, 39.99]]);
		$user->allocateServer(1);
	} elseif ($paymentData["product"] == 2) {
		$server = new Server($paymentData["service"]);
		$initialExpiration = $server->getExpiration();
		$expiration = strtotime("+1 month", $initialExpiration);
		
		$invoice = $user->createInvoice([["VPS Windows 10", "Du ".date("d/m/Y", $initialExpiration)." au ".date("d/m/Y", $expiration)."\n8 coeurs CPU\n30 Go RAM\n480 Go HDD\n1Gbps", 1, 0, 39.99, 0, 39.99]]);
		
		$user->extendVpsExpiration($paymentData["service"], $expiration);
	}
	
	$pageTitle = "Paiement #{$match[0]}";
	$pageDescription = "Paiement #{$match[0]}";
	require "Pages/Website/Post_payment.php";
} else {
	http_response_code(500);
	require "Handlers/Website/Error.php";
}