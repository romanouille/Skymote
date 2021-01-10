<?php
header("Content-Type: text/plain;chaset=utf-8");
chdir("../");

$serverIp = "193.251.51.117";
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
	for ($i = 0; $i <= 1; $i++) {
		if (!file_exists("db/$i/")) {
			exit("Db not found");
		}
		
		$files = glob("db/$i/*");
		
		foreach ($files as $file) {
			$data = file_get_contents($file);
			
			if ($data < 2) {
				unlink($file);
			}
		}
	}
	
	exit("Purged");
}

unset($_SERVER["SERVER_NAME"], $_SERVER["HTTP_HOST"]);

http_response_code(400);

if (!isset($_COOKIE["tk"]) || !is_string($_COOKIE["tk"]) || empty($_COOKIE["tk"]) || $_COOKIE["tk"] != $token) {
	stop("n 0");
}

if (!isset($_GET["a"]) || !is_string($_GET["a"]) || empty($_GET["a"]) || !@ip2long($_GET["a"])) {
	stop("n 1");
}

if (!isset($_GET["b"]) || !is_string($_GET["b"])|| empty($_GET["b"]) || !is_numeric($_GET["b"])) {
	stop("n 2");
}

if (!isset($_GET["c"]) || !is_string($_GET["c"])) {
	stop("n 3");
}

if (!isset($_GET["d"]) || !is_string($_GET["d"])) {
	stop("n 4");
}

if (!isset($_GET["e"]) || !is_string($_GET["e"])) {
	stop("n 5");
}

foreach ($_SERVER as $key=>$value) {
	if (strstr($key, $serverIp) || strstr($value, $serverIp)) {
		stop("n 6");
	}
}

$ip = $_GET["a"];
$port = $_GET["b"]/1337;
$type = $_GET["c"];
$mode = $_GET["d"];
$filename = "$ip-$port";

if ($ip != $_SERVER["REMOTE_ADDR"]) {
	stop("n 7");
}


http_response_code(200);



if (!file_exists("db/")) {
	mkdir("db");
}

if (!file_exists("db/$type/")) {
	mkdir("db/$type");
}

if (file_exists("db/$type/$filename")) {
	$data = file_get_contents("db/$type/$filename");
	
	if ($data == 0) {
		file_put_contents("db/$type/$filename", $type == 0 ? 1 : 2);
		exit("Success 1");
	} elseif ($data == 1) {
		file_put_contents("db/$type/$filename", 2);
		exit("Success 2");
	} elseif ($data == 2) {
		unlink("db/$type/$filename");
		exit("Success 3");
	}
} else {
	if ($type == 0) {
		if ($mode == 1) {
			$result = 3;
		} else {
			$result = 1;
		}
	} else {
		$result = 2;
	}
	
	file_put_contents("db/$type/$filename", $result);
	exit("Success 4");
}

exit("End");