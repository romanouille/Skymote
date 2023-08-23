<?php
http_response_code(403);
exit;

$pageTitle = "API";
$pageDescription = "L'API bgp.skymote.net vous permet d'intégrer nos données dans vos applications, telles que des données de géolocalisation.";
require "Pages/Website/Api.php";