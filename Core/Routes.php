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
	
	"#^\/ip\/(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$#" => [
		"handler" => "Website/Ip.php"
	],
	
	"#^\/ip\/(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))$#" => [
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
	]
];