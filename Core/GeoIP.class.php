<?php
class GeoIP {
	/**
	 * Vérifie si une chaîne est une adresse IP
	 *
	 * @param string $ip Chaîne
	 *
	 * @return bool Résultat
	 */
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
	
	/**
	 * Réduit une IP
	 *
	 * @param string $ip IP à réduire
	 *
	 * @return string IP réduite
	 */
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
	 * Nécessaire pour ipRangeToCidr()
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
		if (strstr($ip, ":")) {
			$add = "-6";
		} else {
			$add = "";
		}
		
		if (PHP_OS == "WINNT") {
			$command = shell_exec("nping $ip --icmp $add");
		} else {
			$command = shell_exec("sudo nping $ip --icmp $add");
		}
		
		$data = explode("\n", $command);
		
		$result = [];
		$lastTime = 0;
		
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
			
			$pong = round(str_replace("s", "", str_replace("(", "", str_replace(")", "", $value[1])))-$lastTime, 3)*1000;
			$sourceIp = str_replace("[", "", $value[3]);
			$ttl = explode(" ", explode("ttl=", $rawValue)[1])[0];
			if (strstr($rawValue, "seq=")) {
				$seq = explode(" ", explode("seq=", $rawValue)[1])[0];
			} else {
				$seq = 0;
			}
			
			$result[] = [
				"pong" => (int)$pong,
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
		if (strstr($ip, ":")) {
			$add = "-6";
		} else {
			$add = "";
		}
		
		if (PHP_OS == "WINNT") {
			$command = "nping $ip -p $port --tcp $add";
		} else {
			$command = "sudo nping $ip -p $port --tcp $add";
		}
		
		$data = explode("\n", shell_exec($command));
		
		$result = [];
		$lastTime = 0;
		
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
			
			$ipData = explode(":", $value[3]);
			$pong = round(str_replace("s", "", str_replace("(", "", str_replace(")", "", $value[1])))-$lastTime, 3)*1000;
			$sourceIp = $ipData[0];
			$ttl = (int)explode("=", $value[7])[1];
			$seq = explode("=", $value[11])[1];
			
			$result[] = [
				"pong" => (int)$pong,
				"sourceIp" => $sourceIp,
				"ttl" => (int)$ttl,
				"seq" => (int)$seq,
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
		if (strstr($ip, ":")) {
			$add = "-6";
		} else {
			$add = "";
		}
		
		if (PHP_OS == "WINNT") {
			$command = "nping $ip -p $port --udp $add";
		} else {
			$command = "sudo nping $ip -p $port --udp $add";
		}
		
		$data = explode("\n", shell_exec($command));
		$result = [];
		$lastTime = 0;
		
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
			
			$ipData = explode(":", $value[3]);
			$pong = round(str_replace("s", "", str_replace("(", "", str_replace(")", "", $value[1])))-$lastTime, 3)*1000;
			$sourceIp = $ipData[0];
			$ttl = (int)explode("=", $value[6])[1];
			
			$result[] = [
				"pong" => (int)$pong,
				"sourceIp" => $sourceIp,
				"ttl" => (int)$ttl,
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
		if (strstr($ip, ":")) {
			$add = "-6";
		} else {
			$add = "";
		}
		
		if (PHP_OS == "WINNT") {
			if ($protocol == "icmp") {
				$command = "nmap -Pn -sn -n --traceroute $ip $add";
			} elseif ($protocol == "tcp") {
				$command = "nmap -Pn -n --traceroute -p $port $ip $add";
			} elseif ($protocol == "udp") {
				$command = "nmap -sU -Pn -n --traceroute -p $port $ip $add";
			} else {
				return [];
			}
		} else {
			if ($protocol == "icmp") {
				$command = "sudo nmap -Pn -sn -n --traceroute $ip $add";
			} elseif ($protocol == "tcp") {
				$command = "sudo nmap -Pn -n --traceroute -p $port $ip $add";
			} elseif ($protocol == "udp") {
				$command = "sudo nmap -sU -Pn -n --traceroute -p $port $ip $add";
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
				"pong" => (int)$value[2],
				"sourceIp" => $value[4],
				"ptr" => gethostbyaddr($value[4]),
				"country_code" => isset($ipData["isp"]["country"]) && $ipData["isp"]["country"] != "ZZ" ? $ipData["isp"]["country"] : (isset($ipData["block"]["country"]) ? $ipData["block"]["country"] : "*"),
				"isp" => isset($ipData["isp"]["name"]) ? $ipData["isp"]["name"] : "*"
			];
		}
		
		return $result;
	}
	
	/**
	 * Récupère la table actuelle
	 *
	 * @return int Table
	 */
	public static function getTable() : int {
		global $db;

		$query = $db->prepare("SELECT value FROM cache WHERE name = 'table'");
		$query->execute();
		$data = $query->fetch();

		return (int)$data["value"];
	}
	
	/**
	 * Récupère des informations sur une IP
	 *
	 * @param string $ip Adresse IP
	 *
	 * @return array Données
	 */
	public static function getIpData(string $ip) : array {
		global $db, $rirList;
		
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
		/*$lir = self::getAsFromIp($ip);
		if ($lir == 0) {
			$lir = $data["lir"];
		}*/
		$lir = $data["lir"];

		$result["block"] = [
				"version" => (int)$data["version"],
				"block" => (string)$data["block"],
				"block_start" => (string)$data["block_start"],
				"block_end" => (string)$data["block_end"],
				"country" => (string)$data["country"],
				"isp" => (int)$lir,
				"created" => (int)$data["created"],
				"rir" => (string)$rirList[$data["rir"]]
		];


		$query = $db->prepare("SELECT name, country FROM dump_as_$table WHERE id = :id");
		$query->bindValue(":id", $lir, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		if (!$data) {
			$data = [
				"name" => "*",
				"country" => "ZZ"
			];
		}

		$data = array_map("trim", $data);

		$result["isp"] = [
			"name" => (string)$data["name"],
			"country" => (string)$data["country"]
		];

		if ($result["block"]["rir"] == "RIPENCC") {
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
					"country" => (string)$value["country"],
					"netname" => (string)$value["netname"],
					"description" => (string)$value["description"],
					"remarks" => (string)$value["remarks"],
					"status" => (string)$value["status"],
					"created" => (int)$value["created"],
					"modified" => (int)$value["modified"]
				];
			}
			
			$result["routes"] = [];
			
			$query = $db->prepare("SELECT version, block, block_start, block_end, description, origin, created, modified FROM dump_ripe_routes_$table WHERE :ip << block");
			$query->bindValue(":ip", $ip, PDO::PARAM_STR);
			$query->execute();
			$data = $query->fetchAll();
			
			foreach ($data as $value) {
				$value = array_map("trim", $value);
				
				$result["routes"][] = [
					"version" => (int)$value["version"],
					"block" => (string)$value["block"],
					"block_start" => (string)$value["block_start"],
					"block_end" => (string)$value["block_end"],
					"description" => (string)$value["description"],
					"origin" => (int)$value["origin"],
					"created" => (int)$value["created"],
					"modified" => (int)$value["modified"]
				];
			}
		}

		return $result;
	}
	
	/**
	 * Effectue une recherche
	 *
	 * @param string $text Texte à rechercher
	 *
	 * @return array Résultat
	 */
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
		
		$query = $db->prepare("SELECT id, name, country FROM dump_as_$table WHERE name ILIKE :name LIMIT 100");
		$query->bindValue(":name", "%$text%", PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["as"][] = [
				"id" => (int)$value["id"],
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
	
	/**
	 * Récupère des informations sur une organisation
	 *
	 * @param string $org Organisation
	 *
	 * @return array Résultat
	 */
	public static function getOrgData(string $org) : array {
		global $db;
		
		$table = self::getTable();
		
		$query = $db->prepare("SELECT name, is_lir, created, modified FROM dump_ripe_organisations_$table WHERE org = :org");
		$query->bindValue(":org", $org, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		if (empty($data)) {
			return [];
		}
		
		$result = [
			"name" => (string)trim($data["name"]),
			"is_lir" => (bool)$data["is_lir"],
			"created" => (int)$data["created"],
			"modified" => (int)$data["modified"],
			"allocations" => []
		];
		
		
		$query = $db->prepare("SELECT version, block, block_start, block_end, country, netname, description, remarks, status, created, modified FROM dump_ripe_allocations_$table WHERE org = :org ORDER BY modified DESC LIMIT 100");
		$query->bindValue(":org", $org, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["allocations"][] = [
				"version" => (int)$value["version"],
				"block" => (string)trim($value["block"]),
				"block_start" => (string)trim($value["block_start"]),
				"block_end" => (string)trim($value["block_end"]),
				"country" => (string)trim($value["country"]),
				"netname" => (string)trim($value["netname"]),
				"description" => (string)trim($value["description"]),
				"remarks" => (string)trim($value["remarks"]),
				"status" => (string)trim($value["status"]),
				"created" => (int)$value["created"],
				"modified" => (int)$value["modified"]
			];
		}
		
		return $result;
	}
	
	/**
	 * Récupère les récentes allocations RIPE
	 *
	 * @return array Résultat
	 */
	public static function getRecentsAllocations() : array {
		global $db, $rirList;
		
		$result = [
			"allocations" => [],
			"blocks" => [],
			"as" => [],
			"ripeAs" => [],
			"organisations" => [],
			"routes" => []
		];
		
		$table = self::getTable();
		$query = $db->prepare("SELECT version, block, block_start, block_end, org, country, netname, description, remarks, status, created, modified FROM dump_ripe_allocations_$table ORDER BY created DESC LIMIT 100");
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
		
		
		$query = $db->prepare("SELECT version, block, block_start, block_end, country, lir, created, rir FROM dump_blocks_$table ORDER BY created DESC, id DESC LIMIT 100");
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["blocks"][] = [
				"version" => (int)$value["version"],
				"block" => (string)trim($value["block"]),
				"block_start" => (string)trim($value["block_start"]),
				"block_end" => (string)trim($value["block_end"]),
				"country" => (string)trim($value["country"]),
				"isp" => (int)$value["lir"],
				"created" => (int)$value["created"],
				"rir" => $rirList[$value["rir"]]
			];
		}
		
		
		$query = $db->prepare("SELECT id, rir, created FROM dump_lir_$table ORDER BY created DESC, id DESC LIMIT 100");
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["as"][] = [
				"id" => (int)$value["id"],
				"rir" => $rirList[$value["rir"]],
				"created" => (int)$value["created"]
			];
		}
		
		
		$query = $db->prepare("SELECT id, org, sponsoring_org, description, remarks, created, modified FROM dump_ripe_as_$table ORDER BY created DESC, id DESC LIMIT 100");
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["ripeAs"][] = [
				"id" => (int)$value["id"],
				"org" => (string)trim($value["org"]),
				"sponsoring_org" => (string)trim($value["sponsoring_org"]),
				"description" => (string)trim($value["description"]),
				"remarks" => (string)trim($value["remarks"]),
				"created" => (int)$value["created"],
				"modified" => (int)$value["modified"]
			];
		}
		
		
		$query = $db->prepare("SELECT org, name, is_lir, created, modified FROM dump_ripe_organisations_$table ORDER BY created DESC, id DESC LIMIT 100");
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result["organisations"][] = [
				"org" => (string)trim($value["org"]),
				"name" => (string)trim($value["name"]),
				"is_lir" => (bool)$value["is_lir"],
				"created" => (int)$value["created"],
				"modified" => (int)$value["modified"]
			];
		}
		
		
		$query = $db->prepare("SELECT version, block, block_start, block_end, description, origin, created, modified FROM dump_ripe_routes_$table ORDER BY created DESC, id DESC LIMIT 100");
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
	
	/**
	 * Récupère la liste des FAI d'un pays
	 *
	 * @param string $countryCode Code ISO du pays
	 *
	 * @return array Résultat
	 */
	public static function getIspList(string $countryCode) : array {
		global $db;
		
		$result = [];
		$table = self::getTable();
		$query = $db->prepare("SELECT id, name FROM dump_as_$table WHERE country = :country ORDER BY name ASC");
		$query->bindValue(":country", $countryCode, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$result[] = [
				"id" => (int)$value["id"],
				"name" => trim($value["name"])
			];
		}
		
		return $result;
	}
	
	/**
	 * Récupère la liste des proxys
	 *
	 * @return array Résultat
	 */
	public static function getProxysList() : array {
		global $db;
		
		$result = [];
		$query = $db->prepare("SELECT ip, port, timestamp FROM proxys ORDER BY timestamp DESC");
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$ipData = self::getIpData($value["ip"]);
			
			if ($ipData["isp"]["country"] == "ZZ" && isset($ipData["block"]["country"])) {
				$ipData["isp"]["country"] = $ipData["block"]["country"];
			}
			
			$result[] = [
				"ip" => (string)trim($value["ip"]),
				"port" => (int)$value["port"],
				"timestamp" => (int)$value["timestamp"],
				"country" => isset($ipData["isp"]["country"]) ? trim($ipData["isp"]["country"]) : "zz",
				"isp" => isset($ipData["isp"]["name"]) ? trim($ipData["isp"]["name"]) : ""
			];
		}
		
		return $result;
	}
	
	/**
	 * Récupère des informations sur un FAI
	 *
	 * @param int $id ID du FAI
	 *
	 * @return array Résultat
	 */
	public static function getIspData(int $id, bool $light = false) : array {
		global $db, $rirList;
		
		$result = [
			"name" => "",
			"country" => "",
			"blocks" => []
		];
		$table = self::getTable();
		$query = $db->prepare("SELECT name, country FROM dump_as_$table WHERE id = :id");
		$query->bindValue(":id", $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		if (empty($data)) {
			if ($light) {
				$result["name"] = "*";
				$result["country"] = "zz";
				
				return $result;
			}
			
			return [];
		}
		
		$result = [
			"name" => (string)trim($data["name"]),
			"country" => (string)trim($data["country"]),
			"blocks" => []
		];
		
		
		$query = $db->prepare("SELECT version, block, block_start, block_end, country, created, rir FROM dump_blocks_$table WHERE lir = :lir ORDER BY block ASC");
		$query->bindValue(":lir", $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			if ($value["rir"] == 4) {
				$query = $db->prepare("SELECT description, remarks FROM dump_ripe_allocations_$table WHERE block = :block");
				$query->bindValue(":block", $value["block"], PDO::PARAM_STR);
				$query->execute();
				$data2 = $query->fetch();
			}
			
			$result["blocks"][] = [
				"version" => (int)$value["version"],
				"block" => (string)trim($value["block"]),
				"block_start" => (string)trim($value["block_start"]),
				"block_end" => (string)trim($value["block_end"]),
				"country" => (string)trim($value["country"]),
				"description" => isset($data2["description"]) && !empty($data2["description"]) ? (string)trim($data2["description"]) : "*",
				"remarks" => isset($data2["remarks"]) && !empty($data2["remarks"]) ? (string)trim($data2["remarks"]) : "*",
				"created" => (int)$value["created"],
				"rir" => $rirList[$value["rir"]]
			];
		}
		
		if ($light) {
			return $result;
		}
		
		$result["bgp"] = self::getBgpRoutes($id);
		$result["peers"] = self::getAsPeers($id);
		
		return $result;
	}
	
	public static function getBgpRoutes(int $as) : array {
		global $config, $db;
		
		return [];
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "http://{$config["common"]["bgp_router"]}/Api.php?mode=blocks&as=$as");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$page = curl_exec($curl);
		curl_close($curl);
		
		$table = self::getTable();
		$data = json_decode($page, true)["blocks"];
		$result = [];
		
		foreach ($data as $value) {
			$query = $db->prepare("SELECT rir FROM dump_lir_$table WHERE id = :id");
			$query->bindValue(":id", $as, PDO::PARAM_INT);
			$query->execute();
			$data2 = $query->fetch();
			
			$ipVersion = !strstr($value, ":") ? 4 : 6;
			
			if ($ipVersion == 4) {
				$blockData = GeoIP::cidrToRange($value);
				$blockStart = $blockData[0];
				$blockEnd = $blockData[1];
			} else {
				$block = explode("/", $value);
				$blockStart = $block[0];
				if ($block[1] != 128) {
					$blockEnd = GeoIP::long2ipv2(gmp_strval(gmp_sub(gmp_strval(gmp_add(GeoIP::ip2longv2($blockStart), GeoIP::cidrToHostsV6($block[1]))), 1)));
				} else {
					$blockEnd = $blockStart;
				}
			}
			
			if (!isset($data2["rir"]) || $data2["rir"] == 4) {
				$query = $db->prepare("SELECT country, netname, description, remarks FROM dump_ripe_allocations_$table WHERE block = :block");
				$query->bindValue(":block", $value, PDO::PARAM_STR);
				$query->execute();
				$data2 = $query->fetch();
			}
			
			$result[] = [
				"version" => $ipVersion,
				"block" => $value,
				"block_start" => $blockStart,
				"block_end" => $blockEnd,
				"country" => isset($data2["country"]) && !empty($data2["country"]) ? trim($data2["country"]) : "ZZ",
				"netname" => isset($data2["netname"]) && !empty($data2["netname"]) ? trim($data2["netname"]) : "*",
				"description" => isset($data2["description"]) && !empty($data2["description"]) ? (string)trim($data2["description"]) : "*",
				"remarks" => isset($data2["remarks"]) && !empty($data2["remarks"]) ? (string)trim($data2["remarks"]) : "*"
			];
		}
		
		return $result;			
	}
	
	public static function getAsPeers(int $as) : array {
		global $config, $db;
		
		return [];
		
		$table = self::getTable();
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "http://{$config["common"]["bgp_router"]}/Api.php?mode=peers&as=$as");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$page = curl_exec($curl);
		curl_close($curl);
		
		$data = @json_decode($page, true)["peers"];
		$result = [4 => [], 6 => []];
		
		foreach ($data as $version=>$peers) {
			foreach ($peers as $peer) {
				$query = $db->prepare("SELECT name, country FROM dump_as_$table WHERE id = :id");
				$query->bindValue(":id", $peer, PDO::PARAM_INT);
				$query->execute();
				$data = $query->fetch();
				
				$result[$version][] = [
					"as" => $peer,
					"name" => isset($data["name"]) ? trim($data["name"]) : "*",
					"country" => isset($data["country"]) ? trim($data["country"]) : "ZZ"
				];
			}
		}
		
		return $result;
	}
	
	public static function getAsFromIp(string $ip) : int {
		global $config;
		
		return [];
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "http://{$config["common"]["bgp_router"]}/Api.php?mode=as&ip=$ip");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$page = curl_exec($curl);
		curl_close($curl);
		
		return json_decode($page, true)["as"];
	}
	
	public static function getRipeIpv4WaitingList() : array {
		global $db;
		
		$table = self::getTable();
		$query = $db->prepare("SELECT block, block_start, block_end, country, lir, created FROM dump_blocks_$table WHERE rir = 4 AND version = 4 ORDER BY created DESC LIMIT 100");
		$query->execute();
		$data = $query->fetchAll();
		
		$result = [];
		foreach ($data as $value) {
			$result[] = [
				"version" => 4,
				"block" => (string)$value["block"],
				"block_start" => (string)$value["block_start"],
				"block_end" => (string)$value["block_end"],
				"country" => (string)$value["country"],
				"isp" => (int)$value["lir"],
				"created" => (int)$value["created"],
				"rir" => 4
			];
		}
		
		return $result;
	}
	
	public static function getBgpEvents() : array {
		global $db;
		
		$table = self::getTable();
		$query = $db->prepare("SELECT type, version, block, block_start, block_end, before, after, timestamp FROM bgp_events WHERE block_start != block_end AND (before != 64515 AND after != 64515) AND ((SELECT COUNT(*) FROM dump_as_$table WHERE id = before) > 0 OR (SELECT COUNT(*) FROM dump_as_$table WHERE id = after) > 0) ORDER BY timestamp DESC LIMIT 500");
		$query->execute();
		$data = $query->fetchAll();
		$result = [];
		
		foreach ($data as $value) {
			$value = array_map("trim", $value);
			
			$ispBefore = $value["before"] > 0 ? self::getIspData($value["before"], true) : ["name" => "*", "country" => "zz"];
			$ispAfter = $value["after"] > 0 ? self::getIspData($value["after"], true) : ["name" => "*", "country" => "zz"];
			
			$result[] = [
				"type" => (int)$value["type"],
				"version" => (int)$value["version"],
				"block" => (string)$value["block"],
				"block_start" => (string)$value["block_start"],
				"block_end" => (string)$value["block_end"],
				"before" => (int)$value["before"],
				"after" => (int)$value["after"],
				"timestamp" => (int)$value["timestamp"],
				"ispBefore" => $ispBefore,
				"ispAfter" => $ispAfter
			];
		}
		
		return $result;
	}
}