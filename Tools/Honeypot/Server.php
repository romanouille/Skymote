<?php
error_reporting(-1);
ini_set("display_errors", true);
ini_set("memory_limit", -1);

$db = new PDO("pgsql:host=127.0.0.1;dbname=skymote", "postgres", "HZts8aJq8MbeVGeE", [PDO::ATTR_PERSISTENT => true]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://api.abuseipdb.com/api/v2/report");
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, ["Accept: application/json", "Key: af0f75d07f7d684787269a65aef61c35e0699fa6949d69f3e3676b56531ece84c4a218017310653c"]);

$exceptions = [53, 953, 1023, 1024];
$servers = [];

for ($i = 1; $i <= 1000; $i++) {
	if (in_array($i, $exceptions)) {
		continue;
	}
	
	$servers[$i] = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_bind($servers[$i], "5.39.78.72", $i);
	socket_listen($servers[$i], SOMAXCONN);
	socket_set_nonblock($servers[$i]);
	socket_set_option($servers[$i], SOL_SOCKET, SO_RCVTIMEO, ["sec"=>1, "usec"=>0]);
}

while(1) {
	foreach ($servers as $id=>$server) {
		if (($client = socket_accept($server))) {
			@socket_getpeername($client, $ip, $port);
			$data = @socket_read($client, 2048);
			echo "($ip:$port -> $id) : $data\n";
			socket_close($client);
			
			$query = $db->prepare("SELECT COUNT(*) AS nb FROM honeypot_reports WHERE source_ip = :source_ip AND ".time()." < expiration");
			$query->bindValue(":source_ip", $ip, PDO::PARAM_STR);
			$query->execute();
			$data2 = $query->fetch();
			
			if ($data2["nb"] == 0) {
				$post = [
					"ip" => $ip,
					"categories" => "14",
					"comment" => "Connection to port tcp/$id"
				];
				
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
				curl_exec($curl);
			}
			
			$query = $db->prepare("INSERT INTO honeypot_reports(source_ip, source_port, destination_port, data, timestamp, expiration) VALUES(:source_ip, :source_port, :destination_port, :data, :timestamp, :expiration)");
			$query->bindValue(":source_ip", $ip, PDO::PARAM_STR);
			$query->bindValue(":source_port", $port, PDO::PARAM_INT);
			$query->bindValue(":destination_port", $id, PDO::PARAM_INT);
			$query->bindValue(":data", base64_encode($data), PDO::PARAM_STR);
			$query->bindValue(":timestamp", time(), PDO::PARAM_INT);
			$query->bindValue(":expiration", strtotime("+1 day"), PDO::PARAM_INT);
			$query->execute();
		}
	}
}