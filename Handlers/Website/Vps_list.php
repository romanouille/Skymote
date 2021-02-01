<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Error.php";
}

$pageTitle = "Mes VPS";
$pageDescription = "Liste de vos VPS";

$data = $user->getVpsList();

require "Pages/Website/Vps_list.php";