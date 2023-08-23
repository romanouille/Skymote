<?php
error_reporting(-1);
ini_set("display_errors", true);
$db = new PDO("pgsql:host=127.0.0.1;dbname=skymote", "postgres", "HZts8aJq8MbeVGeE", [PDO::ATTR_PERSISTENT => true]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

header("Content-Type: application/json");

$keys = [
	"bc0e686e37d9de79a6211db252de58b7e161ac96"
];

if (!isset($_GET["key"])) {
	http_response_code(400);
	echo json_encode(["message" => "Vous devez spécifier votre clé."]);
	exit;
}

if (!in_array($_GET["key"], $keys)) {
	http_response_code(401);
	echo json_encode(["message" => "La clé spécifiée est incorrecte."]);
	exit;
}