<?php
if (!$userLogged || !$admin) {
	http_response_code(401);
	require "Handlers/Error.php";
}

require "Core/Admin.class.php";

$data = Admin::getAllInvoices();

$pageTitle = "Liste des factures";
$pageDescription = "Liste des factures";

require "Pages/Website/Admin_invoices.php";