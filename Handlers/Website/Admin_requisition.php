<?php
if (!$userLogged || !$admin) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

require "Core/Server.class.php";

$success = false;

if (count($_POST) > 0) {
	if (isset($_POST["ip"]) && ip2long($_POST["ip"]) && isset($_POST["time"]) && is_string($_POST["time"]) && !empty($_POST["time"])) {
		$_POST["time"] = str_replace("/", "-", $_POST["time"]);
		
		$server = new Server($_POST["ip"]);
		if ($server->exists()) {
			$owner = $server->getOwner(strtotime($_POST["time"]));
			if (!empty($owner)) {
				$serverUser = new User($owner);
				$data = $user->load();
				$success = true;
			} else {
				$message = "Impossible de récupérer le détenteur du serveur via cet horodatage.";
			}
		} else {
			$message = "L'adresse IP spécifiée n'existe pas.";
		}
	} else {
		$message = "Le formulaire est incorrect.";
	}
}

$pageTitle = "Réquisition judiciaire";
$pageDescription = "Exécuter une réquisition judiciaire";

require "Pages/Website/Admin_requisition.php";