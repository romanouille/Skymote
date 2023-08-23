<?php
chdir("../../");
set_include_path("../../");

$dev = true;

require "Core/Init.php";
require "vendor/autoload.php";

$ssh = new phpseclib\Net\SSH2($config["minecraft"]["free_server"]);
$key = new phpseclib\Crypt\RSA();
$key->setPassword(file_get_contents("Auth/Password"));
$key->loadKey(file_get_contents("Auth/Private.ppk"));
if (!$ssh->login("user", $key)) {
	trigger_error("Erreur auth SSH");
	return false;
}

$query = $db->prepare("SELECT * FROM minecraft_servers");
$query->execute();
$data = $query->fetchAll();

foreach ($data as $value) {
	$value = array_map("trim", $value);
	
	$ssh->exec("cd /opt/minecraft/s{$value["server_port"]}/ && screen -dmS minecraft_{$value["server_port"]} java -Xms512M -Xmx4096M -jar /opt/minecraft/s{$value["server_port"]}/server.jar");
}