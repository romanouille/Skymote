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
	],
	
	"#^\/search\?text=(.+)$#" => [
		"handler" => "Website/Search.php"
	],
	
	"#^\/ip\/(.+)$#" => [
		"handler" => "Website/Ip.php"
	],
	
	"#^\/tools\/ping\?ip=(.+)&port=(.+)&protocol=(.+)$#" => [
		"handler" => "Website/Ping.php"
	],
	
	"#^\/tools\/traceroute\?ip=(.+)&port=(.+)&protocol=(.+)$#" => [
		"handler" => "Website/Traceroute.php"
	],
	
	"#^\/org\/(.*)$#" => [
		"handler" => "Website/Org.php"
	],
	
	"#^\/recent-allocations$#" => [
		"handler" => "Website/Recent_allocations.php"
	],
	
	"#^\/isp-list$#" => [
		"handler" => "Website/Isp_list.php"
	],
	
	"#^\/isp-list\?country=(.+)$#" => [
		"handler" => "Website/Isp_list.php"
	],
	
	"#^\/proxys$#" => [
		"handler" => "Website/Proxys.php"
	]
];