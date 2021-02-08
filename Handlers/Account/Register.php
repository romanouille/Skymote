<?php
require "Core/Captcha.class.php";

$success = false;
if (count($_POST) > 0) {
	$messages = [];
	
	if (!isset($_POST["email"]) || !is_string($_POST["email"]) || empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		$messages[] = "Vous devez spécifier votre adresse e-mail.";
	} elseif (User::emailExists($_POST["email"])) {
		$messages[] = "L'adresse e-mail spécifiée est déjà inscrite sur ce site.";
	}
	
	if (!isset($_POST["password"]) || !is_string($_POST["password"]) || empty($_POST["password"])) {
		$messages[] = "Vous devez spécifier votre mot de passe.";
	} elseif (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 72) {
		$messages[] = "Votre mot de passe doit se composer d'au minimum 8 caractères et d'au maximum 72 caractères.";
	} else {	
		if (!isset($_POST["password2"]) || !is_string($_POST["password2"]) || empty($_POST["password2"])) {
			$messages[] = "Vous devez confirmer votre mot de passe.";
		} elseif ($_POST["password"] != $_POST["password2"]) {
			$messages[] = "Les mots de passe ne correspondent pas.";
		}
	}
	
	if (!isset($_POST["firstname"]) || !is_string($_POST["firstname"]) || empty($_POST["firstname"])) {
		$messages[] = "Vous devez spécifier votre prénom.";
	}
	
	if (!isset($_POST["lastname"]) || !is_string($_POST["lastname"]) || empty($_POST["lastname"])) {
		$messages[] = "Vous devez spécifier votre nom.";
	}
	
	if (!isset($_POST["address"]) || !is_string($_POST["address"]) || empty($_POST["address"])) {
		$messages[] = "Vous devez spécifier votre adresse postale.";
	}
	
	if (!isset($_POST["postalcode"]) || !is_string($_POST["postalcode"]) || empty($_POST["postalcode"])) {
		$messages[] = "Vous devez spécifier votre code postal.";
	}
	
	if (!isset($_POST["city"]) || !is_string($_POST["city"]) || empty($_POST["city"])) {
		$messages[] = "Vous devez spécifier votre ville.";
	}
	
	if (!isset($_POST["country"]) || !is_string($_POST["country"]) || empty($_POST["country"])) {
		$messages[] = "Vous devez spécifier votre pays.";
	}
	
	if (isset($_POST["company"])) {
		if (!is_string($_POST["company"])) {
			$messages[] = "Le nom d'entreprise que vous avez envoyé est incorrect.";
		}
	} else {
		$_POST["company"] = "";
	}
	
	if (!Captcha::check()) {
		$messages[] = "Vous devez prouver que vous n'êtes pas un robot.";
	}
	
	if (empty($messages)) {
		$userId = User::create($_POST["email"], $_POST["password"], $_POST["firstname"], $_POST["lastname"], $_POST["address"], $_POST["postalcode"], $_POST["city"], $_POST["country"], $_POST["company"]);
		$messages[] = "Votre compte a été créé, vous pouvez maintenant vous connecter.";
		$success = true;
	}
}


require "Pages/Account/Register.php";