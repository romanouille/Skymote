<?php
require "Core/Captcha.class.php";
require "Core/MinecraftServer.class.php";

if (isset($_COOKIE["minecraft_session"])) {
	if (!MinecraftServer::cookieExists($_COOKIE["minecraft_session"])) {
		setcookie("minecraft_session", "", -86400, "/", $_SERVER["HTTP_HOST"], $_SERVER["SERVER_PORT"] == 443, true);
		header("Location: /minecraft");
		exit;
	}
	
	header("Location: /minecraft-setup");
	exit;
}

if (count($_POST) > 0) {
	$messages = [];
	
	if (!Captcha::check()) {
		$messages[] = "Vous devez prouver que vous n'êtes pas un robot.";
	}
	
	if (empty($messages)) {
		$session = MinecraftServer::createSession();
		
		if (!empty($session)) {
			setcookie("minecraft_session", $session, time()+(86400*365), "/", $_SERVER["HTTP_HOST"], $_SERVER["SERVER_PORT"] == 443, true);
			header("Location: /minecraft-setup");
			exit;
		} else {
			$messages[] = "Il n'y a plus de serveurs de disponibles, veuillez réessayer plus tard.";
		}
	}
}

$pageTitle = "Minecraft";
$pageDescription = "Serveur Minecraft gratuit à vie";

require "Pages/Website/Minecraft.php";