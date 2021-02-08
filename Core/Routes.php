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
	
	"#^\/proxys$#" => [
		"handler" => "Website/Proxys.php"
	],
	
	"#^\/proxys\?raw$#" => [
		"handler" => "Website/Proxys.php"
	],
	
	"#^\/vps$#" => [
		"handler" => "Website/Vps.php"
	],
	
	"#^\/account\/buy\/post\?paymentId=(.+)&token=(.+)&PayerID=(.+)$#" => [
		"handler" => "Website/Post_payment.php"
	],
	
	"#^\/account\/invoice\?id=([0-9]+)$#" => [
		"handler" => "Website/Invoice.php"
	],
	
	"#^\/account\/buy\/init\?product=([0-9]+)$#" => [
		"handler" => "Website/Paypal_init.php"
	],
	
	"#^\/account\/buy\/init\?product=([0-9]+)&service=(.+)$#" => [
		"handler" => "Website/Paypal_init.php"
	],
	
	"#^\/account\/buy\/post\?token=(.+)$#" => [
		"handler" => "Website/Paypal_stop.php"
	],
	
	"#^\/account\/$#" => [
		"handler" => "Website/Account.php"
	],
	
	"#^\/account\/vps$#" => [
		"handler" => "Website/Vps_list.php"
	],
	
	"#^\/account\/vps\/(.+)\/$#" => [
		"handler" => "Website/Vps_data.php"
	],
	
	"#^\/account\/invoices$#" => [
		"handler" => "Website/Invoices.php"
	],
	
	"#^\/legal$#" => [
		"handler" => "Website/Legal.php"
	],
	
	"#^\/account\/admin\/login$#" => [
		"handler" => "Website/Admin_login.php"
	],
	
	"#^\/account\/admin$#" => [
		"handler" => "Website/Admin.php"
	],
	
	"#^\/account\/admin\/servers\/expirations$#" => [
		"handler" => "Website/Admin_expirations.php"
	],
	
	"#^\/account\/admin\/servers\/expirations\/mail\?ip=(.+)&mode=([0-9]+)$#" => [
		"handler" => "Website/Admin_expirations_mail.php"
	],
	
	"#^\/account\/admin\/requisition$#" => [
		"handler" => "Website/Admin_requisition.php"
	],
	
	"#^\/account\/admin\/invoices$#" => [
		"handler" => "Website/Admin_invoices.php"
	]
];