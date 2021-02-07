<?php
class Server {
	public function __construct(string $ip) {
		$this->ip = $ip;
	}
	
	public function exists() : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM servers WHERE ip = :ip");
		$query->bindValue(":ip", $this->ip, PDO::PARAM_STR);
		$query->execute();
		return $query->fetch()["nb"];
	}
	
	public function getExpiration() : int {
		global $db;
		
		$query = $db->prepare("SELECT expiration FROM servers WHERE ip = :ip");
		$query->bindValue(":ip", $this->ip, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["expiration"];
	}
	
	public function load() : array {
		global $db;
		
		$query = $db->prepare("SELECT password, type, expiration, owner, hypervisor, hypervisor_password FROM servers WHERE ip = :ip");
		$query->bindValue(":ip", $this->ip, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		if (empty($data)) {
			return [];
		}
		
		$data = array_map("trim", $data);
		
		return $data;
	}
	
	public static function isAvailable(int $type) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM servers WHERE type = :type AND owner = ''");
		$query->bindValue(":type", $type, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] > 0;
	}
	
	public static function getExpirations() : array {
		global $db;
		
		$query = $db->prepare("SELECT ip, expiration FROM servers WHERE owner != '' ORDER BY expiration DESC");
		$query->execute();
		$data = $query->fetchAll();
		$result = [];
		
		foreach ($data as $value) {
			$result[] = [
				"ip" => (string)$value["ip"],
				"expiration" => (int)$value["expiration"]
			];
		}
		
		return $result;
	}
	
	public function getOwner(int $timestamp) : string {
		global $db;
		
		$query = $db->prepare("SELECT owner FROM ip_logs WHERE ip = :ip AND $timestamp > timestamp_start AND $timestamp < timestamp_end");
		$query->bindValue(":ip", $this->ip, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		if (empty($data)) {
			return "";
		}
		
		return $data["owner"];
	}
}