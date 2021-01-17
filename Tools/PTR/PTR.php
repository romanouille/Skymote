<?php
ini_set("memory_limit", -1);
chdir("../../");
$devMode = true;

require "Core/Init.php";

if (isset($argv[1])) {
	$ptr = gethostbyaddr($argv[1]);
	
	if ($ptr != $argv[1]) {
		$query = $db->prepare("INSERT INTO ptr(ip, ptr) VALUES(:ip, :ptr)");
		$query->bindValue(":ip", $argv[1], PDO::PARAM_STR);
		$query->bindValue(":ptr", $ptr, PDO::PARAM_STR);
		$query->execute();
	} else {
		$query = $db->prepare("INSERT INTO ptr(ip, ptr) VALUES(:ip, '')");
		$query->bindValue(":ip", $argv[1], PDO::PARAM_STR);
		$query->execute();
	}
	
	exit;
}

require "Core/GeoIP.class.php";

$query = $db->prepare("SELECT block, block_start, block_end FROM dump_blocks_".GeoIP::getTable()." WHERE version = 4");
$query->execute();
$data = $query->fetchAll();

$nb = 0;

foreach ($data as $value) {
	$blockStart = explode(".", $value["block_start"]);
	$blockEnd = explode(".", $value["block_end"]);
	
	for ($a = $blockStart[0]; $a <= $blockEnd[0]; $a++) {
		for ($b = $blockStart[1]; $b <= $blockEnd[1]; $b++) {
			for ($c = $blockStart[2]; $c <= $blockEnd[2]; $c++) {
				for ($d = $blockStart[3]; $d <= $blockEnd[3]; $d++) {
					$ip = "$a.$b.$c.$d";
					$query = $db->prepare("SELECT COUNT(*) AS nb FROM ptr WHERE ip = :ip");
					$query->bindValue(":ip", $ip, PDO::PARAM_STR);
					$query->execute();
					$data = $query->fetch();
					
					if ($data["nb"] > 0) {
						continue;
					}
					
					echo "$ip\n";
					
					$thread = new COM("WScript.Shell");
					$thread->Run("php {$argv[0]} $ip", 0, false);
					$nb++;
					
					if ($nb == 256) {
						sleep(3);
						$nb = 0;
					}
				}
			}
		}
	}
}