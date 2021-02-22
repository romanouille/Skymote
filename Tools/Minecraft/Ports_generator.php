<?php
chdir("../../");
set_include_path("../../");

$dev = true;

require "Core/Init.php";

for ($i = 1; $i <= 200; $i++) {
	$serverPort = 10000+$i;
	$rconPort = $serverPort+1;
	$rconPassword = sha1(microtime(1).random_bytes(32));
	$i++;
	
	$query = $db->prepare("INSERT INTO minecraft_servers(server_port, rcon_port, rcon_password) VALUES(:server_port, :rcon_port, :rcon_password)");
	$query->bindValue(":server_port", $serverPort, PDO::PARAM_INT);
	$query->bindValue(":rcon_port", $rconPort, PDO::PARAM_INT);
	$query->bindValue(":rcon_password", $rconPassword, PDO::PARAM_STR);
	$query->execute();
}