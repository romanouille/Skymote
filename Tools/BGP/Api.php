<?php
error_reporting(-1);
ini_set("display_errors", true);

if (!in_array($_SERVER["REMOTE_ADDR"], ["135.125.58.1", "90.35.100.94"])) {
	http_response_code(403);
	exit;
}

if (!isset($_GET["mode"]) || !is_string($_GET["mode"]) && $_GET["mode"] != "as" && $_GET["mode"] != "peers" && $_GET["mode"] != "blocks") {
	http_response_code(400);
	exit;
}

header("Content-Type: application/json");


if ($_GET["mode"] == "as") {
	$test = explode("/", $_GET["ip"]);
	$test = $test[0];
	if (strstr($test, ":")) {
		$test = "[$test]";
	}

	if (!isset($_GET["ip"]) || !filter_var("http://$test/", FILTER_VALIDATE_URL)) {
		http_response_code(400);
		exit;
	}
	
	$birdc = strstr($_GET["ip"], ":") ? "birdc6" : "birdc";
	
	$exec = explode("\n", shell_exec("sudo $birdc show route for {$_GET["ip"]}"));

	$as = explode("[AS", $exec[1]);
	$as = (int)str_replace("i]", "", isset($as[1]) ? $as[1] : 0);
	
	echo json_encode(["as" => $as]);
} elseif ($_GET["mode"] == "peers") {
	if (!isset($_GET["as"]) || !is_string($_GET["as"]) || !is_numeric($_GET["as"])) {
		http_response_code(400);
		exit;
	}
	
	$as = $_GET["as"];
	
	$peers = [4 => [], 6 => []];
	
	for ($i = 1; $i <= 2; $i++) {
		$routes = $i == 1 ? "routes" : "routes6";
		$shell = shell_exec("cat $routes | grep \" $as\"");
		if (empty($shell)) {
			continue;
		}
		$exec = explode("\n", $shell);

		foreach ($exec as $line) {
			$line = explode("BGP.as_path: ", $line);
			$line = end($line);
			
			$test = explode(" ", $line);
			
			if (end($test) != $as && !strstr($line, " $as ")) {
				continue;
			}
			
			while(1) {
				if (strstr($line, " $as $as")) {
					$line = str_replace(" $as $as", " $as", $line);
				} else {
					break;
				}
			}
			
			if (end($test) == $as) {
				$line = explode(" ", $line);
				$peer = $line[count($line)-2];
				
				if (is_numeric($peer) && $peer != $as && $peer != 20473 && $peer > 0 && !in_array($peer, $peers[($i == 1 ? 4 : 6)])) {
					$peers[($i == 1 ? 4 : 6)][] = (int)$peer;
				}
			} elseif (strstr($line, " $as ")) {
				$line = explode(" $as ", $line);
				$line1 = explode(" ", $line[count($line)-2]);
				$peer = end($line1);
				
				if ($peer != $as && $peer != 20473 && $peer > 0 && !in_array($peer, $peers[($i == 1 ? 4 : 6)])) {
					$peers[($i == 1 ? 4 : 6)][] = (int)$peer;
				}
				
				$line2 = explode(" ", end($line));
				$peer = $line2[0];
				
				if ($peer != $as && $peer != 20473 && $peer > 0 && !in_array($peer, $peers[($i == 1 ? 4 : 6)])) {
					$peers[($i == 1 ? 4 : 6)][] = (int)$peer;
				}
			}
		}
	}

	echo json_encode(["peers" => $peers]);
} elseif ($_GET["mode"] == "blocks") {
	if (!isset($_GET["as"]) || !is_string($_GET["as"]) || !is_numeric($_GET["as"])) {
		http_response_code(400);
		exit;
	}
	
	$blocks = [];
	
	for ($i = 1; $i <= 2; $i++) {
		$shell = shell_exec("cat routes | grep AS{$_GET["as"]}".($i == 1 ? "i" : "?"));
		if (!empty($shell)) {
			$exec = explode("\n", $shell);
			
			foreach ($exec as $line) {
				$line = explode(" ", $line);
				
				if (!empty($line[0])) {
					$blocks[] = $line[0];
				}
			}
		}
	}
	
	for ($i = 1; $i <= 2; $i++) {
		$shell = shell_exec("cat routes6 | grep AS{$_GET["as"]}".($i == 1 ? "i" : "?"));
		if (!empty($shell)) {
			$exec = explode("\n", $shell);
			
			foreach ($exec as $line) {
				$line = explode(" ", $line);
				
				if (!empty($line[0])) {
					$blocks[] = $line[0];
				}
			}
		}
	}
	
	echo json_encode(["blocks" => $blocks]);
}