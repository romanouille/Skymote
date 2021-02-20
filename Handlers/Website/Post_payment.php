<?php
require "Core/Paypal.class.php";
require "Core/Server.class.php";

if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

$paymentData = $user->loadPaypalPayment($match[0]);
if (empty($paymentData)) {
	http_response_code(400);
	require "Handlers/Website/Error.php";
}

if ($paymentData["product"] == 1 && !Server::isAvailable(1)) {
	// VPS Debian-1
	http_response_code(503);
	require "Handlers/Website/Error.php";
} elseif ($paymentData["product"] == 2) {
	// VPS Debian-1 renouvellement
	$server = new Server($paymentData["service"]);
	if (!$server->exists() || !$user->hasServer($paymentData["service"])) {
		http_response_code(404);
		require "Handlers/Website/Error.php";
	}
} elseif ($paymentData["product"] == 3 && !Server::isAvailable(2)) {
	// VPS Debian-Free
	http_response_code(503);
	require "Handlers/Website/Error.php";
} elseif ($paymentData["product"] == 4) {
	// VPS Debian-Free renouvellement
	$server = new Server($paymentData["service"]);
	if (!$server->exists() || !$user->hasServer($paymentData["service"])) {
		http_response_code(404);
		require "Handlers/Website/Error.php";
	}
}

$pageTitle = "Paiement #{$match[0]}";
$pageDescription = "Paiement #{$match[0]}";

if ($paymentData["price"] > 0) {
	$paypal = new Paypal($config["paypal"]["client_id"], $config["paypal"]["secret"]);
	if ($paypal->validatePayment($match[0], $match[2])) {
		$user->setPaymentAsPaid($match[0]);
		
		if ($paymentData["product"] == 1) {
			// VPS Debian-1
			$invoice = $user->createInvoice([["VPS Debian", "Du ".date("d/m/Y")." au ".date("d/m/Y", strtotime("+1 month"))."\n8 coeurs CPU @ 2.4GHz\n32 Go RAM\n50 Go SSD NVMe\n500 Mbps best-effort", 1, 0, 19.99, 0, 19.99]]);
			$user->allocateServer(1, strtotime("+1 month"));
		} elseif ($paymentData["product"] == 2) {
			// VPS Debian-1 renouvellement
			$server = new Server($paymentData["service"]);
			$initialExpiration = $server->getExpiration();
			$expiration = strtotime("+1 month", $initialExpiration);
			
			$invoice = $user->createInvoice([["VPS Debian", "Du ".date("d/m/Y", $initialExpiration)." au ".date("d/m/Y", $expiration)."\n8 coeurs CPU @ 2.4GHz\n32 Go RAM\n50 Go SSD NVMe\n500 Mbps best-effort", 1, 0, 19.99, 0, 19.99]]);
			
			$user->extendVpsExpiration($paymentData["service"], $expiration);
		}	
	} else {
		http_response_code(500);
		require "Handlers/Website/Error.php";
	}
} else {
	if ($paymentData["product"] == 3) {
		// VPS Debian-Free
		if (!$user->hasFreeServer()) {
			$user->allocateServer(2, strtotime("+1 day"));
		} else {
			http_response_code(410);
			require "Handlers/Website/Error.php";
		}
	} elseif ($paymentData["product"] == 4) {
		// VPS Debian-Free
		$server = new Server($paymentData["service"]);
		$initialExpiration = $server->getExpiration();
		if (time() < $initialExpiration) {
			http_response_code(403);
			require "Handlers/Website/Error.php";
		}
		
		$user->extendVpsExpiration($paymentData["service"], strtotime("+1 day"));
	}
}

require "Pages/Website/Post_payment.php";