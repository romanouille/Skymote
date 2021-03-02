<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

if (!$user->hasServer($match[0])) {
	http_response_code(404);
	require "Handlers/Website/Error.php";
}

require "Core/Hypervisor.class.php";
require "Core/Proxmox.class.php";
require "Core/Server.class.php";

$pageTitle = "VPS {$match[0]}";
$pageDescription = "Informations sur le VPS {$match[0]}";

$server = new Server($match[0]);
$data = $server->load();

$proxmox = new Proxmox("vps{$data["hypervisor_id"]}.skymote.net", "admin", (new Hypervisor($data["hypervisor_id"]))->getAuthPassword());
$containerData = $proxmox->getContainerData($data["proxmox_id"]);

if (count($_POST) > 0) {
	$messages = [];
	
	if (!isset($_POST["token"]) || !is_string($_POST["token"]) || empty($_POST["token"])) {
		$messages[] = "Le formulaire est invalide, veuillez réessayer.";
	}
	
	if (!isset($_POST["action"]) || !is_string($_POST["action"]) || !in_array($_POST["action"], ["reboot"])) {
		$messages[] = "L'action spécifiée est invalide.";
	}
	
	if (empty($messages)) {
		if ($_POST["action"] == "reboot") {
			if ($proxmox->rebootContainer($data["proxmox_id"])) {
				$messages[] = "Le VPS a été redémarré.";
			} else {
				$messages[] = "Un problème est survenu pendant le redémarrage de votre VPS.";
			}
		}
	}
}

require "Pages/Website/Vps_data.php";