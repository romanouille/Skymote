<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

if (!$user->hasServer($match[0])) {
	http_response_code(404);
	require "Handlers/Website/Error.php";
}

require "Core/Server.class.php";

$pageTitle = "VPS {$match[0]}";
$pageDescription = "Informations sur le VPS {$match[0]}";

$server = new Server($match[0]);
$data = $server->load();

require "Pages/Website/Vps_data.php";