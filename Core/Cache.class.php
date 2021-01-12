<?php
class Cache {
	public static function read(string $name) : string {
		global $db;
		
		$query = $db->prepare("SELECT value FROM cache WHERE name = :name");
		$query->bindValue(":name", $name, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["value"];
	}
	
	public static function write(string $name, string $value, int $duration = 3600) : string {
		global $db;
		
		$query = $db->prepare("INSERT INTO cache(name, value, expiration) VALUES(:name, :value, ".(time()+$duration).")");
		$query->bindValue(":name", $name, PDO::PARAM_STR);
		$query->bindValue(":value", $value, PDO::PARAM_STR);
		
		return $query->execute();
	}
	
	public static function exists(string $name) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM cache WHERE name = :name");
		$query->bindValue(":name", $name, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"];
	}
	
	public static function purge() : bool {
		global $db;
		
		$query = $db->prepare("DELETE FROM cache WHERE ".time()." > expiration");
		
		return $query->execute();
	}
}