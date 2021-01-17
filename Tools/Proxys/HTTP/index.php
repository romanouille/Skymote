<?php
error_reporting(-1);
ini_set("display_errors", true);
header("Content-Type: text/plain;chaset=utf-8");
chdir("../../../");
$devMode = true;

$serverIp = "151.127.2.122";
$token = "2afa6130500e10ce3b9ce7eeed4794083ae5d4ac";
$debug = false;


function stop(string $reason) {
	global $debug;
	
	if ($debug) {
		file_put_contents("debug", $reason);
	}
	
	exit($reason);
}

if (isset($_GET["purge-opx234"])) {
	require "Core/Cache.class.php";
	require "Core/Init.php";
	$query = $db->prepare("DELETE FROM proxys WHERE ".time()."-timestamp > 3600");
	$query->execute();
	
	exit("Purged");
}

unset($_SERVER["SERVER_NAME"], $_SERVER["HTTP_HOST"]);

http_response_code(400);

if (!isset($_COOKIE["tk"]) || !is_string($_COOKIE["tk"]) || empty($_COOKIE["tk"]) || $_COOKIE["tk"] != $token) {
	stop("Bad Request : n°0");
}

if (!isset($_GET["a"]) || !is_string($_GET["a"]) || empty($_GET["a"]) || !@ip2long($_GET["a"])) {
	stop("Bad Request : n°1");
}

if (!isset($_GET["b"]) || !is_string($_GET["b"])|| empty($_GET["b"]) || !is_numeric($_GET["b"])) {
	stop("Bad Request : n°2");
}

if (!isset($_GET["c"]) || !is_string($_GET["c"])) {
	stop("Bad Request : n°3");
}

foreach ($_SERVER as $key=>$value) {
	if (strstr($key, $serverIp) || strstr($value, $serverIp)) {
		stop("Bad Request : n°4");
	}
}

$ip = $_GET["a"];
$port = $_GET["b"]/1337;
$filename = "$ip-$port";

if ($ip != $_SERVER["REMOTE_ADDR"]) {
	stop("Bad Request : n°5");
}

http_response_code(200);

require "Core/Cache.class.php";
require "Core/Init.php";

$query = $db->prepare("SELECT COUNT(*) AS nb FROM proxys WHERE ip = :ip AND port = :port");
$query->bindValue(":ip", $ip, PDO::PARAM_STR);
$query->bindValue(":port", $port, PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();

if ($data["nb"] == 0) {
	$query = $db->prepare("INSERT INTO proxys(ip, port, timestamp) VALUES(:ip, :port, ".time().")");
	$query->bindValue(":ip", $ip, PDO::PARAM_STR);
	$query->bindValue(":port", $port, PDO::PARAM_INT);
	$query->execute();
} else {
	$query = $db->prepare("UPDATE proxys SET timestamp = ".time()." WHERE ip = :ip AND port = :port");
	$query->bindValue(":ip", $ip, PDO::PARAM_STR);
	$query->bindValue(":port", $port, PDO::PARAM_INT);
	$query->execute();
}

exit("Success");