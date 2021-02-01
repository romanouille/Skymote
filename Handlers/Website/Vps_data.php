<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Error.php";
}

$pageTitle = "VPS {$match[0]}";
$pageDescription = "Informations sur le VPS {$match[0]}";

require "Pages/Website/Vps_data.php";