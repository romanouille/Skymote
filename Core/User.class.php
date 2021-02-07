<?php
class User {
	public function __construct(string $email) {
		$this->email = $email;
	}
	
	public static function emailExists(string $email) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM users WHERE email = :email");
		$query->bindValue(":email", $email, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] > 0;
	}
	
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
	
	public static function checkPassword(string $email, string $password) {
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
	
	public function updateIp() : bool {
		global $db;
		
		$query = $db->prepare("INSERT INTO users_ips(email, ip, port, timestamp) VALUES(:email, :ip, :port, :timestamp)");
		$query->bindValue(":email", $this->email, PDO::PARAM_STR);
		$query->bindValue(":ip", $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
		$query->bindValue(":port", $_SERVER["REMOTE_PORT"], PDO::PARAM_INT);
		$query->bindValue(":timestamp", time(), PDO::PARAM_INT);
		return $query->execute();
	}
	
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
	
	public function setPaymentAsPaid(string $paymentId) : bool {
		global $db;
		
		$query = $db->prepare("UPDATE paypal SET paid = 1 WHERE payment_id = :payment_id");
		$query->bindValue(":payment_id", $paymentId, PDO::PARAM_STR);
		
		return $query->execute();
	}
	
	public function load() : array {
		global $db;
		
		$query = $db->prepare("SELECT firstname, lastname, address, postalcode, city, country, company FROM users WHERE email = :email");
		$query->bindValue(":email", $this->email, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		if (empty($data)) {
			return [];
		}
		
		$data = array_map("trim", $data);
		
		return $data;
	}
	
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
	
	public function hasInvoice(int $id) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM invoices WHERE user_email = :user_email AND id = :id");
		$query->bindValue(":user_email", $this->email, PDO::PARAM_STR);
		$query->bindValue(":id", $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] == 1;
	}
	
	public function allocateServer(int $type) : int {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM servers WHERE owner = '' AND type = :type");
		$query->bindValue(":type", $type, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		if ($data["nb"] == 0) {
			return 0;
		}
		
		$query = $db->prepare("SELECT id FROM servers WHERE owner = '' AND type = :type ORDER BY id ASC");
		$query->bindValue(":type", $type, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		$serverId = (int)$data["id"];
		
		$query = $db->prepare("UPDATE servers SET owner = :owner, expiration = :expiration WHERE id = :id");
		$query->bindValue(":owner", $this->email, PDO::PARAM_STR);
		$query->bindValue(":expiration", strtotime("+1 month"), PDO::PARAM_INT);
		$query->bindValue(":id", $serverId, PDO::PARAM_INT);
		$query->execute();
		
		return $serverId;
	}
	
	public function getVpsList() : array {
		global $db;
		
		$query = $db->prepare("SELECT ip, password, type, expiration FROM servers WHERE owner = :owner");
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
	
	public function hasServer(string $ip) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM servers WHERE owner = :owner AND ip = :ip");
		$query->bindValue(":owner", $this->email, PDO::PARAM_STR);
		$query->bindValue(":ip", $ip, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] == 1;
	}
	
	public function extendVpsExpiration(string $server, int $expiration) : bool {
		global $db;
		
		$query = $db->prepare("UPDATE servers SET expiration = :expiration WHERE ip = :ip");
		$query->bindValue(":expiration", $expiration, PDO::PARAM_INT);
		$query->bindValue(":ip", $server, PDO::PARAM_STR);
		return $query->execute();
	}
}