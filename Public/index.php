<?php
set_time_limit(5);
ini_set("memory_limit", -1);

$dev = !isset($_SERVER["REMOTE_ADDR"]) || in_array($_SERVER["REMOTE_ADDR"], ["127.0.0.1", "37.164.131.160"]);

if ($dev) {
	error_reporting(-1);
	ini_set("display_errors", true);
	
	$version = "normal";
} else {
	error_reporting(0);
	ini_set("display_errors", false);

	$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
	if (strstr($ua, "msie") || strstr($ua, "win98")) {
		$version = "light";
	} elseif ($_SERVER["HTTP_HOST"] != "127.0.0.1") {
		if ($_SERVER["SERVER_PORT"] == 80) {
			header("Location: https://skymote.net{$_SERVER["REQUEST_URI"]}");
			exit;
		} else {
			$version = "normal";
		}
	} else {
		$version = "normal";
	}
}
ignore_user_abort(true);

set_include_path("../");
chdir("../");

require "Core/Cache.class.php";
require "Core/Functions.php";
require "Core/Routes.php";

ob_start();
register_shutdown_function("renderPage");

// Recherche de la route
foreach ($routes as $route=>$routeData) {
	if (preg_match($route, $_SERVER["REQUEST_URI"], $match)) {
		unset($match[0]);
		$match = array_values($match);
		
		require "Core/Init.php";
		require "Handlers/{$routeData["handler"]}";
		exit;
	}
}

unset($route, $routeData);


// Aucune route correspondante

http_response_code(404);

require "Core/Init.php";
require "Handlers/Website/Error.php";