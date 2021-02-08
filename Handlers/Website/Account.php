<?php
if (!$userLogged) {
	header("Location: /account/login");
	exit;
}

$pageTitle = "Mon compte";
$pageDescription = "Liste des sections de votre compte";

require "Pages/Website/Account.php";