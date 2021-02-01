<?php
class Server {
	public function __construct(string $ip) {
		$this->ip = $ip;
	}
	
	public function getExpiration() : int {
		global $db;
		
		$query = $db->prepare("SELECT expiration FROM servers WHERE ip = :ip");
		$query->bindValue(":ip", $this->ip, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["expiration"];
	}
	
	public static function isAvailable(int $type) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM servers WHERE type = :type AND owner = ''");
		$query->bindValue(":type", $type, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] > 0;
	}
}