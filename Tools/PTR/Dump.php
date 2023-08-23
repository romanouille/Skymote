<?php
$dev = true;

set_include_path("../../");
chdir("../../");

$tempDir = sys_get_temp_dir();

require "Core/Init.php";

set_include_path("Tools/PTR/");
chdir("Tools/PTR/");

for ($a = 0; $a <= 255; $a++) {
	for ($b = 0; $b <= 255; $b++) {
		for ($c = 0; $c <= 255; $c++) {
			if ($a == 0) {
				continue;
			}
			
			if ($a == 10) {
				continue;
			}
			
			if ($a == 100 && $b >= 64 && $b <= 127) {
				continue;
			}
			
			if ($a == 127) {
				$a++;
				continue;
			}
			
			if ($a == 169 && $b == 254) {
				continue;
			}
			
			if ($a == 172 && $b >= 16 && $b <= 31) {
				continue;
			}
			
			if ($a == 192 && $b == 0 && $c == 0) {
				continue;
			}
			
			if ($a == 192 && $b == 0 && $c == 2) {
				continue;
			}
			
			if ($a == 192 && $b == 88 && $c == 99) {
				continue;
			}
			
			if ($a == 192 && $b == 168) {
				continue;
			}
			
			if ($a == 198 && $b >= 18 && $b <= 19) {
				continue;
			}
			
			if ($a == 198 && $b == 51 && $c == 100) {
				continue;
			}
			
			if ($a == 203 && $b == 0 && $c == 113) {
				continue;
			}
			
			if ($a == 224) {
				exit;
			}
			
			echo "$a.$b.$c.0/24\n";
			
			$exec = json_decode(shell_exec("node PTR.js $a.$b.$c."), true);
			foreach ($exec as $value) {
				$ip = array_key_first($value);
				
				if (empty($value[$ip])) {
					continue;
				}
				
				$query = $db->prepare("INSERT INTO ptr(ip, ptr) VALUES(:ip, :ptr)");
				$query->bindValue(":ip", $ip, PDO::PARAM_STR);
				$query->bindValue(":ptr", $value[$ip], PDO::PARAM_STR);
				$query->execute();
			}
		}
	}
}