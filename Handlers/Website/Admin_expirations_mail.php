<?php
if (!$userLogged || !$admin) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

require "Core/Server.class.php";

$server = new Server($match[0]);
if (!$server->exists()) {
	http_response_code(404);
	require "Handlers/Website/Error.php";
}

$data = $server->load();

header("Content-Type: text/plain");

if ($match[1] == 1) {
	echo "Destinataire : {$data["owner"]}\n\nSujet : Expiration le ".date("d/m/Y", $data["expiration"])." de votre serveur {$match[0]}\n\nBonjour,\n\nvotre serveur {$match[0]} expire le ".date("d/m/Y à H:i:s", $data["expiration"]).".\nDans le cas où vous avez l'intention de continuer à l'utiliser, nous vous invitons à le renouveler à partir de votre espace client.\n\nCordialement.";
} elseif ($match[1] == 2) {
	echo "Destinataire : {$data["owner"]}\n\nSujet : Votre serveur {$match[0]} est expiré\n\nBonjour,\n\nvotre serveur {$match[0]} est expiré.\nSi vous avez l'intention de continuer à l'utiliser, merci de le renouveler avant le ".date("d/m/Y", strtotime("+3 days", $data["expiration"])).". Autrement, celui-ci sera supprimé.\n\nCordialement.";
}