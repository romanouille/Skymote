<?php
http_response_code(503);
require "Handlers/Website/Error.php";

require "Core/MinecraftServer.class.php";

if (!isset($_COOKIE["minecraft_session"]) || !MinecraftServer::cookieExists($_COOKIE["minecraft_session"])) {
	setcookie("minecraft_session", "", -86400, "/", $_SERVER["HTTP_HOST"], $_SERVER["SERVER_PORT"] == 443, true);
	header("Location: /minecraft");
	exit;
}

$pageTitle = "Renouvellement du serveur Minecraft pour 1 mois";
$pageDescription = "Renouvelez votre serveur Minecraft pour une durée de 1 mois";


require "Pages/Website/Minecraft_renew_err.php";