<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

$data = $user->getInvoices();

$pageTitle = "Factures";
$pageDescription = "Liste de vos factures";

require "Pages/Website/Invoices.php";