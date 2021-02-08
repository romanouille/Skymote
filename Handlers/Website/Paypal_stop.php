<?php
$pageTitle = "Paiement abandonné";
$pageDescription = "Le paiement a été abandonné";

if (!$userLogged) {
	http_response_code(404);
	require "Handlers/Website/Error.php";
}

require "Pages/Website/Paypal_stop.php";