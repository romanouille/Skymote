<?php
class Server {
	/**
	 * Constructeur
	 *
	 * @param string $ip Adresse IP du serveur
	 */
	public function __construct(string $ip) {
		$this->ip = $ip;
	}
	
	/**
	 * Vérifie si le serveur existe
	 *
	 * @return bool Résultat
	 */
	public function exists() : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM servers WHERE ip = :ip");
		$query->bindValue(":ip", $this->ip, PDO::PARAM_STR);
		$query->execute();
		return $query->fetch()["nb"];
	}
	
	/**
	 * Récupère l'horodatage de l'expiration du serveur
	 *
	 * @return int Horodatage de l'expiration
	 */
	public function getExpiration() : int {
		global $db;
		
		$query = $db->prepare("SELECT expiration FROM servers WHERE ip = :ip");
		$query->bindValue(":ip", $this->ip, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["expiration"];
	}
	
	/**
	 * Charge les données sur le serveur
	 *
	 * @return array Résultat
	 */
	public function load() : array {
		global $db;
		
		$query = $db->prepare("SELECT password, root_password, type, expiration, owner, hypervisor, hypervisor_password FROM servers WHERE ip = :ip");
		$query->bindValue(":ip", $this->ip, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		if (empty($data)) {
			return [];
		}
		
		$data = array_map("trim", $data);
		
		return $data;
	}
	
	/**
	 * Vérifie si un type de serveur est disponible à la location
	 *
	 * @param int $type Type de serveur
	 *
	 * @return bool Résultat
	 */
	public static function isAvailable(int $type) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM servers WHERE type = :type AND owner = ''");
		$query->bindValue(":type", $type, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] > 0;
	}
	
	/**
	 * Récupère les serveurs qui expirent prochainement
	 *
	 * @return array Résultat
	 */
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
	
	/**
	 * Récupère le propriétaire du serveur
	 *
	 * @param int $timestamp Horodatage
	 *
	 * @return string Résultat
	 */
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