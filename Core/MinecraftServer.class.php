<?php
class MinecraftServer {
	/**
	 * Constructeur
	 *
	 * @param int $port Port
	 */
	public function __construct(int $port) {
		$this->port = $port;
		$this->sshAuth();
		$this->rconAuth();
	}
	
	/**
	 * Se connecte au serveur SSH de l'hôte hébergeant les serveurs
	 */
	public function sshAuth() {
		global $config;
		
		$this->ssh = new phpseclib\Net\SSH2($config["minecraft"]["free_server"]);
		$key = new phpseclib\Crypt\RSA();
		$key->setPassword(file_get_contents("Auth/Password"));
		$key->loadKey(file_get_contents("Auth/Private.ppk"));
		if (!$this->ssh->login("user", $key)) {
			trigger_error("Erreur auth SSH");
			return false;
		}
		
		return true;
	}
	
	/**
	 * Se connecte au serveur RCON
	 */
	public function rconAuth() {
		global $config, $db;
		
		$query = $db->prepare("SELECT rcon_password FROM minecraft_servers WHERE server_port = :server_port");
		$query->bindValue(":server_port", $this->port, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		$this->rcon = new Thedudeguy\Rcon($config["minecraft"]["free_server"], $this->port+1, trim($data["rcon_password"]), 3);
		$this->rcon->connect();
	}
	
	/**
	 * Récupère la date d'expiration du serveur
	 *
	 * @return int Date d'expiration
	 */
	public function getExpiration() : int {
		global $db;
		
		$query = $db->prepare("SELECT expiration FROM minecraft_sessions WHERE server_port = :server_port");
		$query->bindValue(":server_port", $this->port, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		return $data["expiration"];
	}
	
	/**
	 * Étend la date d'expiration du serveur
	 *
	 * @return bool Résultat
	 */
	public function extendExpiration($firstExpiration, $finalExpiration) : bool {
		global $db;
		
		$query = $db->prepare("UPDATE minecraft_sessions SET expiration = ".strtotime($firstExpiration).", final_expiration = ".strtotime($finalExpiration)." WHERE server_port = :server_port");
		$query->bindValue(":server_port", $this->port, PDO::PARAM_INT);
		
		return $query->execute();
	}
	
	/**
	* Étend la date d'expiration du serveur pour 1 mois
	*
	* @return bool Résultat
	*/
	public function extendExpirationForOneMonth() : bool {
		global $db;
		
		$query = $db->prepare("SELECT expiration FROM minecraft_sessions WHERE server_port = :server_port");
		$query->bindValue(":server_port", $this->port, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		$query = $db->prepare("UPDATE minecraft_sessions SET expiration = ".strtotime("+1 month", $data["expiration"]).", final_expiration = ".strtotime("+1 month +1 day", $data["expiration"])." WHERE server_port = :server_port");
		$query->bindValue(":server_port", $this->port, PDO::PARAM_INT);
		
		return $query->execute();
	}
	
	/**
	 * Lit la console du serveur
	 *
	 * @return string Console
	 */
	public function readConsole() : string {
		return $this->ssh->exec("cat /opt/minecraft/s{$this->port}/logs/latest.log");
	}
	
	/**
	 * Vérifie si un cookie existe
	 *
	 * @param string $cookie Cookie
	 *
	 * @return bool Résultat
	 */
	public static function cookieExists(string $cookie) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM minecraft_sessions WHERE session = :session");
		$query->bindValue(":session", $cookie, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] == 1;
	}
	
	/**
	 * Vérifie si un serveur est disponible
	 *
	 * @return bool Résultat
	 */
	public static function isServersAvailable() : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM minecraft_servers WHERE owner = ''");
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] > 0;
	}
	
	/**
	 * Récupère le port d'un serveur disponible
	 *
	 * @return int Port
	 */
	public static function getAvailableServer() : int {
		global $db;
		
		$query = $db->prepare("SELECT server_port FROM minecraft_servers WHERE owner = '' ORDER BY server_port ASC LIMIT 1");
		$query->execute();
		$data = $query->fetch();
		if (empty($data)) {
			return 0;
		}
		
		return $data["server_port"];
	}
	
	/**
	 * Crée une session et alloue un serveur à celle-ci
	 *
	 * @return string Session
	 */
	public static function createSession() : string {
		global $db;
		
		if (!self::isServersAvailable()) {
			return "";
		}
		
		$server = self::getAvailableServer();
		
		$session = sha1(microtime(1).$_SERVER["REMOTE_ADDR"].$_SERVER["REMOTE_PORT"]);
		$query = $db->prepare("INSERT INTO minecraft_sessions(session, server_port, expiration, final_expiration) VALUES(:session, :server_port, ".strtotime("+1 day").", ".strtotime("+2 days").")");
		$query->bindValue(":session", $session, PDO::PARAM_STR);
		$query->bindValue(":server_port", $server, PDO::PARAM_INT);
		$query->execute();
		
		$query = $db->prepare("UPDATE minecraft_servers SET owner = :owner WHERE server_port = :server_port");
		$query->bindValue(":owner", $session, PDO::PARAM_STR);
		$query->bindValue(":server_port", $server, PDO::PARAM_INT);
		$query->execute();
		
		$query = $db->prepare("INSERT INTO minecraft_logs(session, source_ip, source_port, server_port, timestamp) VALUES(:session, :source_ip, :source_port, :server_port, ".time().")");
		$query->bindValue(":session", $session, PDO::PARAM_STR);
		$query->bindValue(":source_ip", $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
		$query->bindValue(":source_port", $_SERVER["REMOTE_PORT"], PDO::PARAM_INT);
		$query->bindValue(":server_port", $server, PDO::PARAM_INT);
		$query->execute();
		
		return $session;
	}
	
	/**
	 * Récupère le port associé à un cookie
	 *
	 * @param string $cookie Cookie
	 *
	 * @return bool Port
	 */
	public static function cookieToPort(string $cookie) : int {
		global $db;
		
		$query = $db->prepare("SELECT server_port FROM minecraft_sessions WHERE session = :session");
		$query->bindValue(":session", $cookie, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		if (empty($data)) {
			return 0;
		}
		
		return $data["server_port"];
	}
}