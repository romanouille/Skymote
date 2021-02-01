<?php
if (!isset($_SERVER["PHP_AUTH_USER"])) {
	header("WWW-Authenticate: Basic realm=\"Authentification\"");
	http_response_code(401);
	require "Pages/Account/Login_select.php";
	exit;
} elseif (isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])) {
	if (!User::checkPassword($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"])) {
		header("WWW-Authenticate: Basic realm=\"Authentification\"");
		require "Pages/Account/Login_bad_password.php";
		exit;
	}
}

require "Pages/Account/Login.php";