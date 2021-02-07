<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

if (!$dev) {
	http_response_code(403);
	require "Handlers/Website/Error.php";
}

$success = false;

if (!$admin) {
	if (count($_POST) > 0) {
		if (!isset($_POST["password"]) || !is_string($_POST["password"]) || empty($_POST["password"])) {
			$message = "Vous devez entrer le mot de passe d'administration.";
		}
		
		if (!isset($message) && $config["admin"]["password"] == $_POST["password"]) {
			setcookie("admin", $config["admin"]["password"]);
			$message = "Le mot de passe d'administration a été accepté.";
			$success = true;
		} else {
			$message = "Le mot de passe spécifié est incorrect.";
		}
	} else {
		$message = "Veuillez entrer le mot de passe d'administration.";
	}
} else {
	$message = "Vous êtes déjà connecté en tant qu'administrateur.";
	$success = true;
}

$pageTitle = "Admin";
$pageDescription = "Authentifiez-vous en tant qu'administrateur";

require "Pages/Website/Admin_login.php";