<?php
require "Core/MinecraftServer.class.php";

if (!isset($_COOKIE["minecraft_session"]) || !MinecraftServer::cookieExists($_COOKIE["minecraft_session"])) {
	setcookie("minecraft_session", "", -86400, "/", $_SERVER["HTTP_HOST"], $_SERVER["SERVER_PORT"] == 443, true);
	header("Location: /minecraft");
	exit;
}

$port = MinecraftServer::cookieToPort($_COOKIE["minecraft_session"]);
$server = new MinecraftServer($port);
$expiration = $server->getExpiration();

if (count($_POST) > 0) {
	$messages = [];
	
	if (!isset($_POST["token"]) || !is_string($_POST["token"]) || $_POST["token"] != $token) {
		$messages[] = "Le formulaire est invalide, veuillez réessayer.";
	}
	
	if (empty($messages)) {	
		if (isset($_POST["action"]) && is_string($_POST["action"])) {
			if ($_POST["action"] == "cmd") {
				if (isset($_POST["cmd"]) && is_string($_POST["cmd"])) {
					$server->rcon->sendCommand($_POST["cmd"]);
					$messages[] = "La commande a été exécutée.";
				} else {
					$messages[] = "La commande envoyée est incorrecte.";
				}
			} elseif ($_POST["action"] == "renew") {
				if (time() > $expiration) {
					$server->extendExpiration();
					$messages[] = "Votre serveur a été renouvelé pour 24h.";
					$expiration = $server->getExpiration();
				} else {
					$messages[] = "Votre serveur doit avoir atteint sa date d'expiration afin d'être renouvelé.";
				}
			}
		}
	}
}

$console = $server->readConsole();

if (strstr($console, "No such file or directory")) {
	$logs = "Pas de logs";
}

$pageTitle = "Configuration de votre serveur Minecraft";
$pageDescription = "Configuration de votre serveur Minecraft";

require "Pages/Website/Minecraft_setup.php";