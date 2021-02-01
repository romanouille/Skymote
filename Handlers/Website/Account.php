<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Error.php";
}

$pageTitle = "Mon compte";
$pageDescription = "Liste des sections de votre compte";

require "Pages/Website/Account.php";