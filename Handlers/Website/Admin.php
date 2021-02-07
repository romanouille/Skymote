<?php
if (!$userLogged || !$admin) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

$pageTitle = "Panneau d'administration";
$pageDescription = "Panneau d'administration de Skymote";

require "Pages/Website/Admin.php";