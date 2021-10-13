<?php
set_include_path("../");
chdir("../");

require "Core/Init.php";

function randomText(int $length = 16) {
	$chars = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");

	$result = "";
	for ($i = 1; $i <= 16; $i++) {
		$result .= $chars[random_int(0, count($chars)-1)];
	}

	return $result;
}


for ($a = 45; $a <= 45; $a++) {
	for ($b = 137; $b <= 137; $b++) {
		for ($c = 125; $c <= 125; $c++) {
			for ($d = 3; $d <= 254; $d++) {
				$query = $db->prepare("INSERT INTO vpn(ip, username, password) VALUES(:ip, :username, :password)");

				$query->bindValue(":ip", "$a.$b.$c.$d", PDO::PARAM_STR);
				$query->bindValue(":username", randomText(), PDO::PARAM_STR);
				$query->bindValue(":password", randomText(), PDO::PARAM_STR);
				$query->execute();
			}
		}
	}
}