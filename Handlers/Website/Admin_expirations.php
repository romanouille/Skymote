<?php
if (!$userLogged || !$admin) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

require "Core/Server.class.php";

$data = Server::getExpirations();

$pageTitle = "Serveurs proches de l'expiration";
$pageDescription = "Serveurs proches de l'expiration";

require "Pages/Website/Admin_expirations.php";