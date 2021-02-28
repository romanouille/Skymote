<?php
class Vultr {
	public int $code;
	
	public function __construct(string $apiKey) {
		$this->curl = curl_init();
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, ["API-Key: $apiKey"]);
	}
	
	private function query(string $method, string $uri, array $post = []) : array {
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($this->curl, CURLOPT_URL, "https://api.vultr.com/v1/$uri");
		if (!empty($post)) {
			curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($post));
		} else {
			curl_setopt($this->curl, CURLOPT_POST, false);
		}
		
		while(1) {
			$data = json_decode(curl_exec($this->curl), true);
			$this->code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
			
			if ($this->code != 503) {
				break;
			} else {
				sleep(1);
			}
		}
		
		if (empty($data)) {
			return [];
		}
		
		return $data;
	}
	
	public function getPlans() : array {
		return $this->query("GET", "plans/list");
	}
	
	public function getRegions() : array {
		return $this->query("GET", "regions/list");
	}
	
	public function getOs() : array {
		$data = $this->query("GET", "os/list");
		foreach ($data as $id=>$value) {
			if (in_array($value["name"], ["Custom", "Snapshot", "Backup", "Application", "Marketplace App"])) {
				unset($data[$id]);
			}
		}
		
		return $data;
	}
	
	public function createInstance(string $email, string $region, string $plan, string $os, string $hostname) : array {
		global $db;
		
		$data = $this->query("POST", "server/create", ["DCID" => $region, "VPSPLANID" => $plan, "OSID" => $os, "enable_ipv6" => "yes", "label" => $hostname, "hostname" => $hostname, "notify_activate" => "no"]);
		
		$query = $db->prepare("INSERT INTO servers(id, email, hostname, expiration) VALUES(:id, :email, :hostname, ".strtotime("+28 days").")");
		$query->bindValue(":id", $data["SUBID"], PDO::PARAM_STR);
		$query->bindValue(":email", $email, PDO::PARAM_STR);
		$query->bindValue(":hostname", $hostname, PDO::PARAM_STR);
		$query->execute();
		
		return $this->getInstanceData($data["SUBID"]);
	}
	
	public function hostnameExists(string $hostname) : bool {
		global $db;
		
		$query = $db->prepare("SELECT COUNT(*) AS nb FROM servers WHERE hostname = :hostname");
		$query->bindValue(":hostname", $hostname, PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		
		return $data["nb"] == 1;
	}
	
	public function getInstanceData(int $id) : array {
		global $db;
		
		$data = $this->query("GET", "server/list?SUBID=$id");
		$data["ram"] = (int)str_replace(" MB", "", $data["ram"]);
		$data["disk"] = (int)str_replace("Virtual ", "", str_replace(" GB", "", $data["disk"]));
		
		$query = $db->prepare("SELECT expiration FROM servers WHERE id = :id");
		$query->bindValue(":id", $id, PDO::PARAM_STR);
		$query->execute();
		$data["expiration"] = (int)$query->fetch()["expiration"];
		
		return $data;
	}
	
	public function rebootInstance(int $id) : bool {
		$this->query("POST", "server/reboot", ["SUBID" => $id]);
		
		return $this->code ==  200;
	}

	public function haltInstance(int $id) : bool {
		$this->query("POST", "server/halt", ["SUBID" => $id]);
		
		return $this->code == 200;
	}
	
	public function reinstallInstance(int $id) : bool {
		$this->query("POST", "server/reinstall", ["SUBID" => $id]);
		
		return $this->code == 200;
	}
	
	public function osChange(int $id, int $os) : bool {
		$this->query("POST", "server/os_change", ["SUBID" => $id, "OSID" => $os]);
		
		return $this->code == 200;
	}
	
	public function getIpv4List(int $id) : array {
		$data = $this->query("GET", "server/list_ipv4?SUBID=$id");
		
		foreach ($data[$id] as $id2=>$ip) {
			if (strstr($ip["reverse"], "vultr.com")) {
				$this->setIpv4Reverse($id, $ip["ip"], $ip["ip"]);
			}
			
			$data[$id][$id2]["reverse"] = $ip["ip"];
		}
		
		return $data;
	}
	
	public function setIpv4Reverse(int $id, string $ip, string $reverse) : bool {
		$this->query("POST", "server/reverse_set_ipv4", ["SUBID" => $id, "ip" => $ip, "entry" => $reverse]);
		
		return $this->code == 200;
	}
	
	public function getIpv6ReverseList(int $id) : array {
		return $this->query("GET", "server/reverse_list_ipv6?SUBID=$id");
	}
	
	public function setIpv6Reverse(int $id, string $ip, string $reverse) : bool {
		$this->query("POST", "server/reverse_set_ipv6", ["SUBID" => $id, "ip" => $ip, "entry" => $reverse]);
		
		return $this->code == 200;
	}
}