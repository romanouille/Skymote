<?php
class GeoIP {		
	public static function validateIp(string $ip) : bool {
		if (!inet_pton($ip)) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Convertie une adresse IP au format décimal, quelle que soit sa version
	 *
	 * @param string $ip Adresse IP
	 *
	 * @return string Valeur décimale
	 */
	public static function ip2longv2(string $ip) : string {
		return strstr($ip, ":") ? self::ip2longv6($ip) : ip2long($ip);
	}

	/**
	 * Convertie une valeur décimale en adresse IP, quelle que soit sa version
	 *
	 * @param string $long Valeur décimale
	 *
	 * @return string Adresse IP
	 */
	public static function long2ipv2(string $long) {
		return $long > 4294967295 ? self::long2ipv6($long) : long2ip($long);
	}
	
	/**
	 * Retourne l'adresse IP précédente d'une adresse IP donnée
	 *
	 * @param string $ip Adresse IP
	 *
	 * @return string Adresse IP précédente
	 */
	public static function precedentIp(string $ip) {
		return strstr($ip, ":") ? self::long2ipv2(gmp_strval(gmp_sub(self::ip2longv2($ip), 1)), 1) : long2ip(ip2long($ip)-1);
	}

	/**
	 * Retourne l'adresse IP suivante d'une adresse IP donnée
	 *
	 * @param string $ip Adresse IP
	 *
	 * @return string Adresse IP suivante
	 */
	public static function nextIp(string $ip) {
		return strstr($ip, ":") ? self::long2ipv2(gmp_strval(gmp_add(self::ip2longv2($ip), 1)), 1) : long2ip(ip2long($ip)+1);
	}
	
	public static function reduceIpv6(string $ip) : string {
		return self::precedentIp(self::nextIp($ip));
	}
	
	/**
	 * Converti une IPv6 en valeur décimale
	 *
	 * @param string $ip Adresse IPv6
	 *
	 * @return string Valeur décimale (retournée sous format string car PHP ne supporte pas des nombres aussi grands)
	 */
	public static function ip2longv6(string $ip) : string {
		$ip_n = inet_pton($ip);
		$bin = '';
		for ($bit = strlen($ip_n) - 1; $bit >= 0; $bit--) {
			$bin = sprintf('%08b', ord($ip_n[$bit])) . $bin;
		}

		if (function_exists('gmp_init')) {
			return gmp_strval(gmp_init($bin, 2), 10);
		} elseif (function_exists('bcadd')) {
			$dec = '0';
			for ($i = 0; $i < strlen($bin); $i++) {
				$dec = bcmul($dec, '2', 0);
				$dec = bcadd($dec, $bin[$i], 0);
			}
			return $dec;
		} else {
			trigger_error('GMP or BCMATH extension not installed!', E_USER_ERROR);
		}
	}

	/**
	 * Convertie une valeur décimale en IPv6
	 *
	 * @param string $number Valeur décimale à convertir
	 *
	 * @return string Adresse IPv6
	 */
	public static function long2ipv6(string $number) : string {
		// convert to hex
		$hex = gmp_strval(gmp_init($number, 10), 16);
		// pad to 32 chars
		$hex = str_pad($hex, 32, '0', STR_PAD_LEFT);
		// convert to a binary string
		$packed = hex2bin($hex);
		// convert to IPv6 string
		return inet_ntop($packed);
	}
	
	public static function reduceIp(string $ip) : string {
		return self::precedentIp(self::nextIp($ip));
	}
	
	/**
	 * Retourne le nombre d'adresses maximales d'un CIDR IPv6
	 *
	 * @param int $cidr CIDR
	 *
	 * @return int Nombre d'adresses
	 */
	public static function cidrToHostsV6(int $cidr) : string {
		$result = 2;
		$i = 127;
		
		while(1) {
			if ($i == $cidr) {
				break;
			}
			
			$result = gmp_mul($result, 2);
			$i--;
		}
		
		return $result;
	}
	
	/**
	 * Récupère le CIDR d'une rangée d'adresses IPv4
	 *
	 * @param string $ipStart Adresse IP de début
	 * @param string $ipEnd Adresse IP de fin
	 *
	 * @return int CIDR
	 */
	public static function ipRangeToCidr($ipStart, $ipEnd) : int {
		if (is_string($ipStart) || is_string($ipEnd)){
			$start = ip2long($ipStart);
			$end = ip2long($ipEnd);
		}
		else{
			$start = $ipStart;
			$end = $ipEnd;
		}

		$result = array();

		while($end >= $start){
			$maxSize = 32;
			while ($maxSize > 0){
				$mask = hexdec(self::iMask($maxSize - 1));
				$maskBase = $start & $mask;
				if($maskBase != $start) break;
				$maxSize--;
			}
			$x = log($end - $start + 1)/log(2);
			$maxDiff = floor(32 - floor($x));

			if($maxSize < $maxDiff){
				$maxSize = $maxDiff;
			}

			$ip = long2ip($start);
			array_push($result, "$ip/$maxSize");
			$start += pow(2, (32-$maxSize));
		}

		if (!isset($maxSize)) {
			var_dump($ipStart);
			var_dump($ipEnd);
			exit("Error\n");
		}

		return $maxSize;
	}
	
	/**
	 * Transforme un bloc IPv4 contenant un CIDR vers un array contenant l'IP de début et de fin
	 *
	 * @param string $cidr Bloc IPv4
	 *
	 * @return array Adresse IP de début et de fin
	 */
	public static function cidrToRange(string $cidr) : array {
		$range = [];
		$cidr = explode("/", $cidr);
		$range[0] = long2ip((ip2long($cidr[0])) & ((-1 << (32 - (int)$cidr[1]))));
		$range[1] = long2ip((ip2long($range[0])) + pow(2, (32 - (int)$cidr[1])) - 1);
		return $range;
	}
	
	/**
	 * Nécessaire pour Ip::ipRangeToCidr()
	 */
	public static function iMask($s){
		return base_convert((pow(2, 32) - pow(2, (32-$s))), 10, 16);
	}
	

	/**
	 * Effectue un whois sur une adresse IP
	 *
	 * @param string $target Target
	 *
	 * @return string Whois
	 */
	public static function whois(string $target) : string {
		if (PHP_OS == "WINNT") {
			$result = utf8_encode(shell_exec("whois -r $target"));
		} else {
			$result = utf8_encode(shell_exec("timeout --signal=INT 1 whois -r $target"));
		}
		
		return $result;
	}
	
	/**
	 * Effectue un ping ICMP vers une adresse IP
	 *
	 * @return array Résultat
	 */
	public static function icmpPing(string $ip) : array {
		if (PHP_OS == "WINNT") {
			$command = shell_exec("nping $ip --icmp");
		} else {
			$command = shell_exec("sudo nping $ip --icmp");
		}
		
		$data = explode("\n", $command);
		$result = [];
		$lastTime = 0;
		$append = false;
		
		foreach ($data as $id=>$value) {
			if (empty(trim($value))) {
				continue;
			}
			
			$rawValue = $value;
			$value = explode(" ", trim($value));
			
			if ($value[0] == "SENT") {
				$lastTime = str_replace("s", "", str_replace("(", "", str_replace(")", "", $value[1])));
				continue;
			} elseif ($value[0] != "RCVD") {
				continue;
			}
			
			if (!$append) {
				$append = true;
				continue;
			}
			
			$pong = round(str_replace("s", "", str_replace("(", "", str_replace(")", "", $value[1])))-$lastTime, 3)*1000;
			$sourceIp = str_replace("[", "", $value[3]);
			$ttl = explode(" ", explode("ttl=", $rawValue)[1])[0];
			if (strstr($rawValue, "seq=")) {
				$seq = explode(" ", explode("seq=", $rawValue)[1])[0];
			} else {
				$seq = 0;
			}
			
			$result[] = [
				"pong" => $pong,
				"sourceIp" => $sourceIp,
				"ttl" => (int)$ttl,
				"seq" => (int)$seq
			];
		}
		
		return $result;
	}
	
	/**
	 * Effectue un ping TCP vers une adresse IP et port
	 *
	 * @param int $port Port
	 *
	 * @return array Résultat
	 */
	public static function tcpPing(string $ip, int $port) : array {
		if (PHP_OS == "WINNT") {
			$command = "nping $ip -p $port --tcp ";
		} else {
			$command = "sudo nping $ip -p $port --tcp ";
		}
		
		$data = explode("\n", shell_exec($command));
		$result = [];
		$lastTime = 0;
		$append = false;
		
		foreach ($data as $value) {
			if (empty(trim($value))) {
				continue;
			}
			
			$value = explode(" ", trim($value));
			
			if ($value[0] == "SENT") {
				$lastTime = str_replace("s", "", str_replace("(", "", str_replace(")", "", $value[1])));
				continue;
			} elseif ($value[0] != "RCVD") {
				continue;
			}
			
			if (!$append) {
				$append = true;
				continue;
			}
			
			$ipData = explode(":", $value[3]);
			$pong = round(str_replace("s", "", str_replace("(", "", str_replace(")", "", $value[1])))-$lastTime, 3)*1000;
			$sourceIp = $ipData[0];
			$ttl = (int)explode("=", $value[7])[1];
			$seq = explode("=", $value[11])[1];
			
			$result[] = [
				"pong" => $pong,
				"sourceIp" => $sourceIp,
				"ttl" => $ttl,
				"seq" => $seq,
			];
		}
		
		return $result;
	}
	
	/**
	 * Effectue un ping UDP vers une adresse IP et port
	 *
	 * @param string $ip Adresse IP
	 * @param int $port Port
	 *
	 * @return array Résultat
	 */
	public static function udpPing(string $ip, int $port) : array {
		if (PHP_OS == "WINNT") {
			$command = "nping $ip -p $port --udp";
		} else {
			$command = "sudo nping $ip -p $port --udp";
		}
		
		$data = explode("\n", shell_exec($command));
		$result = [];
		$lastTime = 0;
		$append = false;
		
		foreach ($data as $value) {
			if (empty(trim($value))) {
				continue;
			}
			
			$value = explode(" ", trim($value));
			
			if ($value[0] == "SENT") {
				$lastTime = str_replace("s", "", str_replace("(", "", str_replace(")", "", $value[1])));
				continue;
			} elseif ($value[0] != "RCVD") {
				continue;
			}
			
			if (!$append) {
				$append = true;
				continue;
			}
			
			$ipData = explode(":", $value[3]);
			$pong = round(str_replace("s", "", str_replace("(", "", str_replace(")", "", $value[1])))-$lastTime, 3)*1000;
			$sourceIp = $ipData[0];
			$ttl = (int)explode("=", $value[6])[1];
			
			$result[] = [
				"pong" => $pong,
				"sourceIp" => $sourceIp,
				"ttl" => $ttl,
			];
		}
		
		return $result;
	}
	
	/**
	 * Effectue un traceroute vers une adresse IP
	 *
	 * @param string $port Port
	 * @param string $protocol Protocole (tcp, udp, icmp)
	 *
	 * @return array Résultat
	 */
	public static function traceroute(string $ip, int $port = 0, string $protocol = "icmp") : array {
		if (PHP_OS == "WINNT") {
			if ($protocol == "icmp") {
				$command = "nmap -Pn -sn -n --traceroute $ip";
			} elseif ($protocol == "tcp") {
				$command = "nmap -Pn -n --traceroute -p $port $ip";
			} elseif ($protocol == "udp") {
				$command = "nmap -sU -Pn -n --traceroute -p $port $ip";
			} else {
				return [];
			}
		} else {
			if ($protocol == "icmp") {
				$command = "sudo nmap -Pn -sn -n --traceroute $ip";
			} elseif ($protocol == "tcp") {
				$command = "sudo nmap -Pn -n --traceroute -p $port $ip";
			} elseif ($protocol == "udp") {
				$command = "sudo nmap -sU -Pn -n --traceroute -p $port $ip";
			} else {
				return [];
			}
		}
		
		$data = explode("\n", shell_exec($command));
		$result = [];
		$lastId = 0;
		
		foreach ($data as $value) {
			unset($ipData, $ispData);
			
			$value = explode(" ", trim(str_replace("  ", " ", $value)));
			
			if (!is_numeric($value[0])) {
				continue;
			}
			
			if (!isset($value[4]) || !self::validateIp($value[4])) {
				if (isset($value[3]) && self::validateIp($value[3])) {
					$value[2] = $value[1];
					$value[4] = $value[3];
				} else {
					continue;
				}
			}
			
			$ipData = self::getIpData($value[4]);
			
			$result[$value[0]] = [
				"pong" => $value[2],
				"sourceIp" => $value[4],
				"ptr" => gethostbyaddr($value[4]),
				"countryCode" => isset($ipData["lir"]["country"]) ? $ipData["lir"]["country"] : "*",
				"isp" => isset($ipData["lir"]["name"]) ? $ipData["lir"]["name"] : "*"
			];
		}
		
		return $result;
	}

	public static function getTable() : int {
		global $db;

		$query = $db->prepare("SELECT value FROM cache WHERE name = 'table'");
		$query->execute();
		$data = $query->fetch();

		return (int)$data["value"];
	}

	public static function getIpData(string $ip) : array {
		global $db;
		
		$table = self::getTable();

		$query = $db->prepare("SELECT version, block, block_start, block_end, country, lir, created, rir FROM dump_blocks_$table WHERE :ip << block LIMIT 1");
		$query->bindValue(":ip", $ip, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();

		if (empty($data)) {
			return [];
		}

		$result = [];

		$data = array_map("trim", $data);

		$result["block"] = [
				"version" => (int)$data["version"],
				"block" => (string)$data["block"],
				"block_start" => (string)$data["block_start"],
				"block_end" => (string)$data["block_end"],
				"country" => (string)$data["country"],
				"lir" => (int)$data["lir"],
				"created" => (int)$data["created"],
				"rir" => (int)$data["rir"]
		];


		$query = $db->prepare("SELECT name, country FROM dump_as_$table WHERE id = :id");
		$query->bindValue(":id", (int)$data["lir"], PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		if (!$data) {
			$data = [
				"name" => "*",
				"country" => "ZZ"
			];
		}

		$data = array_map("trim", $data);

		$result["lir"] = [
			"name" => (string)$data["name"],
			"country" => (string)$data["country"]
		];

		if ($result["block"]["rir"] == 4) {
			$query = $db->prepare("SELECT version, block, block_start, block_end, org, country, netname, description, remarks, status, created, modified FROM dump_ripe_allocations_$table WHERE :ip << block AND status != 'ALLOCATED UNSPECIFIED' AND org != 'org-ncc1-ripe' ORDER BY block ASC");
			$query->bindValue(":ip", $ip, PDO::PARAM_STR);
			$query->execute();
			$data = $query->fetchAll();

			$result["allocations"] = [];

			foreach ($data as $value) {
				$value = array_map("trim", $value);

				$result["allocations"][] = [
					"version" => (int)$value["version"],
					"block" => (string)$value["block"],
					"block_start" => (string)$value["block_start"],
					"block_end" => (string)$value["block_end"],
					"org" => (string)$value["org"],
					"netname" => (string)$value["netname"],
					"description" => (string)$value["description"],
					"remarks" => (string)$value["remarks"],
					"status" => (string)$value["status"],
					"created" => (int)$value["created"],
					"modified" => (int)$value["modified"]
				];
			}
		}

		return $result;
	}
	
	public static function search(string $text) : array {
		global $db, $table;
		
		$table = self::getTable();
		$result = [
			"as" => [],
			"allocations" => [],
			"ripe_as" => [],
			"org" => [],
			"routes" => []
		];
		
		$query = $db->prepare("SELECT name, country FROM dump_as_$table WHERE name ILIKE :name LIMIT 100");
		$query->bindValue(":name", "%$text%", PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["as"][] = [
				"name" => (string)trim($value["name"]),
				"country" => (string)trim($value["country"])
			];
		}
		
		
		$query = $db->prepare("SELECT version, block, block_start, block_end, org, country, netname, description, remarks, status, created, modified FROM dump_ripe_allocations_$table WHERE netname ILIKE :text OR description ILIKE :text OR remarks ILIKE :text ORDER BY modified DESC LIMIT 100");
		$query->bindValue(":text", "%$text%", PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["allocations"][] = [
				"version" => (int)$value["version"],
				"block" => (string)trim($value["block"]),
				"block_start" => (string)trim($value["block_start"]),
				"block_end" => (string)trim($value["block_end"]),
				"org" => (string)trim($value["org"]),
				"country" => (string)trim($value["country"]),
				"netname" => (string)trim($value["netname"]),
				"description" => (string)trim($value["description"]),
				"remarks" => (string)trim($value["remarks"]),
				"status" => (string)trim($value["status"]),
				"created" => (int)$value["created"],
				"modified" => (int)$value["modified"]
			];
		}
		
		
		$query = $db->prepare("SELECT org, sponsoring_org, description, remarks, created, modified FROM dump_ripe_as_$table WHERE description ILIKE :text OR remarks ILIKE :text ORDER BY modified DESC LIMIT 100");
		$query->bindValue(":text", "%$text%", PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["ripe_as"][] = [
				"org" => (string)trim($value["org"]),
				"sponsoring_org" => (string)trim($value["sponsoring_org"]),
				"description" => (string)trim($value["description"]),
				"remarks" => (string)trim($value["remarks"]),
				"created" => (int)$value["created"],
				"modified" => (int)$value["modified"]
			];
		}
		
		
		$query = $db->prepare("SELECT org, name, is_lir, created, modified FROM dump_ripe_organisations_$table WHERE name ILIKE :text ORDER BY modified DESC LIMIT 100");
		$query->bindValue(":text", "%$text%", PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["org"][] = [
				"org" => (string)trim($value["org"]),
				"name" => (string)trim($value["name"]),
				"is_lir" => (bool)$value["is_lir"],
				"created" => (int)$value["created"],
				"modified" => (int)$value["modified"]
			];
		}
		
		
		$query = $db->prepare("SELECT version, block, block_start, block_end, description, origin, created, modified FROM dump_ripe_routes_$table WHERE description ILIKE :text ORDER BY modified DESC LIMIT 100");
		$query->bindValue(":text", "%$text%", PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["routes"][] = [
				"version" => (int)$value["version"],
				"block" => (string)trim($value["block"]),
				"block_start" => (string)trim($value["block_start"]),
				"block_end" => (string)trim($value["block_end"]),
				"description" => (string)trim($value["description"]),
				"origin" => (int)$value["origin"],
				"created" => (int)$value["created"],
				"modified" => (int)$value["modified"]
			];
		}
			
		return $result;
	}
	
	public static function getOrgData(string $org) : array {
		global $db;
		
		$table = self::getTable();
		
		$query = $db->prepare("SELECT name, is_lir, created, modified FROM dump_ripe_organisations_$table WHERE org = :org");
		$query->bindValue(":org", $org, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		$result = [
			"name" => (string)trim($data["name"]),
			"is_lir" => (bool)$data["is_lir"],
			"created" => (int)$data["created"],
			"modified" => (int)$data["modified"]
		];
		
		return $result;
	}
}