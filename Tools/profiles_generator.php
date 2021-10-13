<?php
$db = new PDO("mysql:dbname=proxification;host=127.0.0.1", "root", "azerty", [PDO::ATTR_PERSISTENT => true]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$result = "";
$gateway = "45.137.125.1";

$query = $db->prepare("SELECT ip, username, password FROM vpn");
$query->execute();
$data = $query->fetchAll();

foreach ($data as $value) {
	$result .= "/ppp secret add service=l2tp name={$value["username"]} password={$value["password"]} remote-address={$value["ip"]} local-address=$gateway\n";
}

file_put_contents("profiles.txt", $result);