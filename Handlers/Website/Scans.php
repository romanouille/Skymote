<?php
require "Core/Scans.class.php";

$page = isset($match[0]) ? $match[0] : 1;
$data = Scans::load($page);

$pageTitle = "Scans";
$pageDescription = "Cette section liste des adresses IP malveillantes (bots) tentant de se connecter à un de nos serveurs honeypot.";

require "Pages/Website/Scans.php";