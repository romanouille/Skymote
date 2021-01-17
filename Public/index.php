<?php
ini_set("memory_limit", -1);

$devMode = !isset($_SERVER["REMOTE_ADDR"]) || in_array($_SERVER["REMOTE_ADDR"], ["127.0.0.1", "192.168.2.25", "193.251.51.117"]);

if ($devMode) {
	error_reporting(-1);
	ini_set("display_errors", true);
} else {
	error_reporting(0);
	ini_set("display_errors", false);
}

set_time_limit(600);
ignore_user_abort(true);

set_include_path("../");
chdir("../");

require "Core/Cache.class.php";
require "Core/Functions.php";
require "Core/Routes.php";

// Recherche de la route
foreach ($routes as $route=>$routeData) {
	if (preg_match($route, $_SERVER["REQUEST_URI"], $match)) {
		unset($match[0]);
		$match = array_values($match);
		$isApi = strstr($routeData["handler"], "Api_");
		
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