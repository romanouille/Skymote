<?php
require "inc.php";

if (!isset($_GET["offset"]) || !is_numeric($_GET["offset"]) || $_GET["offset"] < 0) {
	http_response_code(400);
	echo json_encode(["message" => "Vous devez spécifier l'offset."]);
	exit;
}

$query = $db->prepare("SELECT * FROM honeypot_reports ORDER BY id DESC LIMIT 100 OFFSET :offset");
$query->bindValue(":offset", $_GET["offset"], PDO::PARAM_INT);
$query->execute();
$data = $query->fetchAll();
$result = [];

foreach ($data as $value) {
	$value = array_map("trim", $value);
	
	$result[] = [
		"id" => (int)$value["id"],
		"source_ip" => (string)$value["source_ip"],
		"source_port" => (int)$value["source_port"],
		"destination_port" => (int)$value["destination_port"],
		"data" => (string)$value["data"],
		"timestamp" => (int)$value["timestamp"]
	];
}

echo json_encode($result);