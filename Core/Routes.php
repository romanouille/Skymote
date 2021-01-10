<?php
$routes = [
	"#^\/$#" => [
		"handler" => "Website/Home.php"
	],
	
	"#^\/account\/login$#" => [
		"handler" => "Account/Login.php"
	],
	
	"#^\/account\/register$#" => [
		"handler" => "Account/Register.php"
	]
];