<?php
class User {
	/**
	 * Constructeur
	 *
	 * @param string $email Adresse e-mail de l'utilisateur
	 */
	public function __construct(string $email) {
		$this->email = $email;
	}
	
	/**
	 * Vérifie si il existe un compte avec une adresse e-mail spécifique
	 *
	 * @param string $email Adresse e-mail
	 *
	 * @return bool Résultat
	 */
	public static function emailExists(string $email) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM users WHERE email = :email");
		$query->bindValue(":email", $email, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] > 0;
	}
	
	/**
	 * Crée un compte
	 *
	 * @param string $email Adresse e-mail
	 * @param string $password Mot de passe
	 * @param string $firstname Prénom
	 * @param string $lastname Nom
	 * @param string $address Adresse postale
	 * @param string $postalcode Code postal
	 * @param string $city Ville
	 * @param string $country Pays
	 * @param string $company Entreprise
	 *
	 * @return int ID du compte créé
	 */
	public static function create(string $email, string $password, string $firstname, string $lastname, string $address, string $postalcode, string $city, string $country, string $company) : int {
		global $db;
		
		$query = $db->prepare("INSERT INTO users(email, password, firstname, lastname, address, postalcode, city, country, company) VALUES(:email, :password, :firstname, :lastname, :address, :postalcode, :city, :country, :company)");
		$query->bindValue(":email", substr($email, 0, 100), PDO::PARAM_STR);
		$query->bindValue(":password", password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
		$query->bindValue(":firstname", substr($firstname, 0, 100), PDO::PARAM_STR);
		$query->bindValue(":lastname", substr($lastname, 0, 100), PDO::PARAM_STR);
		$query->bindValue(":address", substr($address, 0, 100), PDO::PARAM_STR);
		$query->bindValue(":postalcode", substr($postalcode, 0, 100), PDO::PARAM_STR);
		$query->bindValue(":city", substr($city, 0, 100), PDO::PARAM_STR);
		$query->bindValue(":country", substr($country, 0, 100), PDO::PARAM_STR);
		$query->bindValue(":company", substr($company, 0, 100), PDO::PARAM_STR);
		$query->execute();
		
		return $db->lastInsertId();
	}
	
	/**
	 * Charge les informations sur l'utilisateur
	 *
	 * @return array Résultat
	 */
	public function load() : array {
		global $db;
		
		$query = $db->prepare("SELECT firstname, lastname, company, address, postalcode, city, country FROM users WHERE email = :email");
		$query->bindValue(":email", $this->email, PDO::PARAM_STR);
		$query->execute();
		$data = array_map("trim", $query->fetch());
		$result = [
			"firstname" => (string)$data["firstname"],
			"lastname" => (string)$data["lastname"],
			"company" => (string)$data["company"],
			"address" => (string)$data["address"],
			"postalcode" => (string)$data["postalcode"],
			"city" => (string)$data["city"],
			"country" => (string)$data["country"],
			"ip" => []
		];
		
		$query = $db->prepare("SELECT ip, port, timestamp FROM users_ips WHERE email = :email ORDER BY timestamp DESC");
		$query->bindValue(":email", $this->email, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		
		foreach ($data as $value) {
			$value = array_map("trim", $value);
			
			$result["ip"][] = [
				"ip" => (string)$value["ip"],
				"port" => (int)$value["port"],
				"timestamp" => (int)$value["timestamp"]
			];
		}
		
		return $result;
	}
	
	/**
	 * Vérifie si une chaîne correspond au mot de passe d'un compte
	 *
	 * @param string $email Adresse e-mail
	 * @param string $password Mot de passe
	 *
	 * @return bool Résultat
	 */
	public static function checkPassword(string $email, string $password) : bool {
		global $db;
		
		$query = $db->prepare("SELECT password FROM users WHERE email = :email");
		$query->bindValue(":email", $email, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		if (empty($data)) {
			return [];
		}
		
		return password_verify($password, trim($data["password"]));
	}
	
	/**
	 * Insère l'adresse IP et le port source de la requête
	 *
	 * @return bool Résultat
	 */
	public function updateIp() : bool {
		global $db;
		
		$query = $db->prepare("INSERT INTO users_ips(email, ip, port, timestamp) VALUES(:email, :ip, :port, :timestamp)");
		$query->bindValue(":email", $this->email, PDO::PARAM_STR);
		$query->bindValue(":ip", $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
		$query->bindValue(":port", $_SERVER["REMOTE_PORT"], PDO::PARAM_INT);
		$query->bindValue(":timestamp", time(), PDO::PARAM_INT);
		return $query->execute();
	}
	
	/**
	 * Crée un paiement Paypal
	 *
	 * @param string $paymentId ID du paiement
	 * @param float $price Prix du produit
	 * @param string $user Adresse e-mail du compte
	 * @param int $product ID du produit
	 * @param string $service ID du service
	 *
	 * @return bool Résultat
	 */
	public function createPaypalPayment(string $paymentId, float $price, string $user, int $product, string $service = "0.0.0.0") : bool {
		global $db;
		
		$query = $db->prepare("INSERT INTO paypal(payment_id, price, user_email, product, service) VALUES(:payment_id, :price, :user_email, :product, :service)");
		$query->bindValue(":payment_id", $paymentId, PDO::PARAM_STR);
		$query->bindValue(":price", $price, PDO::PARAM_STR);
		$query->bindValue(":user_email", $user, PDO::PARAM_STR);
		$query->bindValue(":product", $product, PDO::PARAM_INT);
		$query->bindValue(":service", $service, PDO::PARAM_STR);
		
		return $query->execute();
	}
	
	/**
	 * Charge un paiement PayPal
	 *
	 * @param string $paymentId ID du paiement
	 *
	 * @return array Résultat
	 */
	public function loadPaypalPayment(string $paymentId) : array {
		global $db;
		
		$query = $db->prepare("SELECT price, product, service FROM paypal WHERE payment_id = :payment_id AND paid = 0");
		$query->bindValue(":payment_id", $paymentId, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		if (empty($data)) {
			return [];
		}
		
		$data = array_map("trim", $data);
		
		return $data;
	}
	
	/**
	 * Marque un paiement comme payé
	 *
	 * @param string $paymentId ID du paiement
	 *
	 * @return bool Résultat
	 */
	public function setPaymentAsPaid(string $paymentId) : bool {
		global $db;
		
		$query = $db->prepare("UPDATE paypal SET paid = 1 WHERE payment_id = :payment_id");
		$query->bindValue(":payment_id", $paymentId, PDO::PARAM_STR);
		
		return $query->execute();
	}
	
	/**
	 * Crée une facture
	 *
	 * @param array $products Produits
	 *
	 * @return int ID de la facture
	 */
	public function createInvoice(array $products) : int {
		global $db;
		
		$userData = $this->load();
		
		if (!empty($userData["company"])) {
			$recipient = [
				"{$userData["company"]}",
				"{$userData["firstname"]} {$userData["lastname"]}",
				"{$userData["address"]}",
				"{$userData["postalcode"]} {$userData["city"]}",
				"{$userData["country"]}"
			];
		} else {
			$recipient = [
				"{$userData["firstname"]} {$userData["lastname"]}",
				"{$userData["address"]}",
				"{$userData["postalcode"]} {$userData["city"]}",
				"{$userData["country"]}"
			];
		}
		
		$query = $db->prepare("INSERT INTO invoices(recipient, products, user_email, timestamp) VALUES(:recipient, :products, :user_email, ".time().")");
		$query->bindValue(":recipient", json_encode($recipient), PDO::PARAM_STR);
		$query->bindValue(":products", json_encode($products), PDO::PARAM_STR);
		$query->bindValue(":user_email", $this->email, PDO::PARAM_STR);
		$query->execute();
		
		return $db->lastInsertId();
	}
	
	/**
	 * Charge une facture
	 *
	 * @param int $id ID de la facture
	 *
	 * @return array Résultat
	 */
	public function loadInvoice(int $id) : array {
		global $db;
		
		$query = $db->prepare("SELECT recipient, products, timestamp FROM invoices WHERE id = :id");
		$query->bindValue(":id", $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		if (empty($data)) {
			return [];
		}
		
		$data = array_map("trim", $data);
		
		return $data;
	}
	
	/**
	 * Vérifie si l'utilisateur possède une facture
	 *
	 * @param int $id ID de la facture
	 *
	 * @return bool Résultat
	 */
	public function hasInvoice(int $id) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM invoices WHERE user_email = :user_email AND id = :id");
		$query->bindValue(":user_email", $this->email, PDO::PARAM_STR);
		$query->bindValue(":id", $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] == 1;
	}
	
	/**
	 * Alloue un serveur à l'utilisateur
	 *
	 * @param int $type Type de serveur
	 *
	 * @return int ID du serveur
	 */
	public function allocateServer(int $type) : int {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM servers WHERE owner = '' AND type = :type");
		$query->bindValue(":type", $type, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		if ($data["nb"] == 0) {
			return 0;
		}
		
		$query = $db->prepare("SELECT id, ip FROM servers WHERE owner = '' AND type = :type ORDER BY id ASC");
		$query->bindValue(":type", $type, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		$serverId = (int)$data["id"];
		
		$query = $db->prepare("UPDATE servers SET owner = :owner, expiration = :expiration WHERE id = :id");
		$query->bindValue(":owner", $this->email, PDO::PARAM_STR);
		$query->bindValue(":expiration", strtotime("+1 month"), PDO::PARAM_INT);
		$query->bindValue(":id", $serverId, PDO::PARAM_INT);
		$query->execute();
		
		$query = $db->prepare("INSERT INTO ip_logs(ip, owner, timestamp_start, timestamp_end) VALUES(:ip, :owner, ".time().", ".strtotime("+1 month").")");
		$query->bindValue(":ip", $data["ip"], PDO::PARAM_STR);
		$query->bindValue(":owner", $this->email, PDO::PARAM_STR);
		$query->execute();
		
		return $serverId;
	}
	
	/**
	 * Récupère la liste des VPS du compte
	 *
	 * @return array Résultat
	 */
	public function getVpsList() : array {
		global $db;
		
		$query = $db->prepare("SELECT ip, password, type, expiration FROM servers WHERE owner = :owner ORDER BY expiration DESC");
		$query->bindValue(":owner", $this->email, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		if (empty($data)) {
			return [];
		}
		
		foreach ($data as $id=>$value) {
			$data[$id] = array_map("trim", $data[$id]);
		}
		
		return $data;
	}
	
	/**
	 * Vérifie si l'utilisateur possède un serveur
	 *
	 * @param string $ip Adresse IP
	 *
	 * @return bool Résultat
	 */
	public function hasServer(string $ip) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM servers WHERE owner = :owner AND ip = :ip");
		$query->bindValue(":owner", $this->email, PDO::PARAM_STR);
		$query->bindValue(":ip", $ip, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] == 1;
	}
	
	/**
	 * Étend la durée d'expiration d'un VPS
	 *
	 * @param string $server IP du serveur
	 * @param int $expiration Nouvel horodatage d'expiration
	 *
	 * @return bool Résultat
	 */
	public function extendVpsExpiration(string $server, int $expiration) : bool {
		global $db;
		
		$query = $db->prepare("UPDATE servers SET expiration = :expiration WHERE ip = :ip");
		$query->bindValue(":expiration", $expiration, PDO::PARAM_INT);
		$query->bindValue(":ip", $server, PDO::PARAM_STR);
		$query->execute();
		
		$query = $db->prepare("SELECT id FROM ip_logs WHERE ip = :ip ORDER BY timestamp_start DESC LIMIT 1");
		$query->bindValue(":ip", $server, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		$query = $db->prepare("UPDATE ip_logs SET timestamp_end = :timestamp_end WHERE id = :id");
		$query->bindValue(":timestamp_end", $expiration, PDO::PARAM_INT);
		$query->bindValue(":id", $data["id"], PDO::PARAM_INT);
		$query->execute();
		
		return true;
	}
	
	/**
	 * Récupère la liste des factures de l'utilisateur
	 *
	 * @return array Résultat
	 */
	public function getInvoices() : array {
		global $db;
		
		$query = $db->prepare("SELECT id, timestamp FROM invoices WHERE user_email = :user_email ORDER BY id DESC");
		$query->bindValue(":user_email", $this->email, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetchAll();
		$result = [];
		
		foreach ($data as $value) {
			$value = array_map("trim", $value);
			
			$result[] = [
				"id" => (int)$value["id"],
				"timestamp" => (int)$value["timestamp"]
			];
		}
		
		return $result;
	}
}