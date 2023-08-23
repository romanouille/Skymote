<?php
chdir("../../");
set_include_path("../../");

$dev = true;

require "Core/Init.php";
require "vendor/autoload.php";

$query = $db->prepare("SELECT ip, password FROM servers WHERE user_email = ''");
$query->execute();
$data = $query->fetchAll();

foreach ($data as $value) {
	$value = array_map("trim", $value);
	
	$ssh = new phpseclib\Net\SSH2($value["ip"]);
	if ($ssh->login("root", $value["password"])) {
		echo "OK {$value["ip"]}\n";
	} else {
		echo "ERR {$value["ip"]}\n";
	}
}