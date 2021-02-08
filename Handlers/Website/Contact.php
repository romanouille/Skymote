<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

$pageTitle = "Contacter un administrateur";
$pageDescription = "Contacter un administrateur";

require "Pages/Website/Contact.php";