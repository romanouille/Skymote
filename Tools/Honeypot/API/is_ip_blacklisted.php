<?php
require "inc.php";

if (!isset($_GET["ip"]) || !is_string($_GET["ip"])) {
	http_response_code(400);
	echo json_encode(["message" => "Vous devez spécifier l'adresse IP à vérifier."]);
	exit;
}

$query = $db->prepare("SELECT COUNT(*) AS nb FROM honeypot_reports WHERE timestamp > ".strtotime("-1 month")." AND source_ip = :source_ip");
$query->bindValue(":source_ip", $_GET["ip"], PDO::PARAM_STR);
$query->execute();
$data = $query->fetch();

echo json_encode(["result" => $data["nb"] > 0]);