<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

$pageTitle = "Mes VPS";
$pageDescription = "Liste de vos VPS";

$data = $user->getVpsList();

require "Pages/Website/Vps_list.php";