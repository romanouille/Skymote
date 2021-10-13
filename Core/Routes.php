<?php
$routes = [
	"#^\/$#" => [
		"handler" => "Website/Home.php"
	],

	/*"#^\/legal$#" => [
		"handler" => "Website/Legal.php"
	],*/
	
	"#^\/search\?text=(.+)$#" => [
		"handler" => "Website/Search.php"
	],
	
	"#^\/ip\/(.+)$#" => [
		"handler" => "Website/Ip.php"
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
	
	"#^\/isp\/([0-9]+)-(.+)$#" => [
		"handler" => "Website/Isp.php"
	],
	
	"#^\/free-vps$#" => [
		"handler" => "Website/Free_vps.php"
	],
	
	"#^\/api$#" => [
		"handler" => "Website/Api.php"
	]
];