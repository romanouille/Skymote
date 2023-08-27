<?php
$routes = [
	"#^\/$#" => [
		"handler" => "Website/Home.php"
	],
	
	"#^\/ripe-ipv4-waiting-list$#" => [
		"handler" => "Website/Ripe_ipv4_waiting_list.php"
	],
	
	/*"#^\/bgp-events$#" => [
		"handler" => "Website/Bgp_events.php"
	],
	
	"#^\/stats$#" => [
		"handler" => "Website/Stats.php"
	],
	
	"#^\/minecraft$#" => [
		"handler" => "Website/Minecraft.php"
	],*/
	
	"#^\/ip\/(.+)$#" => [
		"handler" => "Website/Ip.php"
	],
	
	"#^\/search\?text=(.+)$#" => [
		"handler" => "Website/Search.php"
	],
	
	"#^\/tools\/ping\?ip=(.+)&port=(.+)&protocol=(.+)&captcha=(.+)$#" => [
		"handler" => "Website/Ping.php"
	],
	
	"#^\/tools\/traceroute\?ip=(.+)&port=(.+)&protocol=(.+)&captcha=(.+)$#" => [
		"handler" => "Website/Traceroute.php"
	],
	
	"#^\/tools\/ping\?ip=(.+)&port=(.+)&protocol=(.+)$#" => [
		"handler" => "Website/Ping.php"
	],
	
	"#^\/tools\/traceroute\?ip=(.+)&port=(.+)&protocol=(.+)$#" => [
		"handler" => "Website/Traceroute.php"
	],
	
	"#^\/tools\/ping$#" => [
		"handler" => "Website/Ping.php"
	],
	
	"#^\/tools\/traceroute$#" => [
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
	
	"#^\/isp\/([0-9]+)-(.+)$#" => [
		"handler" => "Website/Isp.php"
	],
	
	/*"#^\/api$#" => [
		"handler" => "Website/Api.php"
	]*/
];