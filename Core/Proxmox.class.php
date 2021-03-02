<?php
class Proxmox {
	private $ticket, $domain, $node, $curl;
	
	public function __construct(string $domain, string $username, string $password) {
		$this->domain = $domain;
		
		$this->curl = curl_init();
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
		
		curl_setopt($this->curl, CURLOPT_URL, "https://$domain:8006/api2/extjs/access/ticket");
		
		$data = $this->query("POST", "api2/extjs/access/ticket", [
			"username" => $username,
			"password" => $password,
			"realm" => "pve"
		]);;
		
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, ["CSRFPreventionToken: {$data["data"]["CSRFPreventionToken"]}"]);
		curl_setopt($this->curl, CURLOPT_COOKIE, "PVEAuthCookie={$data["data"]["ticket"]}");
		
		$data = $this->query("GET", "api2/json/cluster/resources");
		$this->node = $data["data"][0]["node"];
	}
	
	public function query(string $method, string $uri, array $post = []) {
		curl_setopt($this->curl, CURLOPT_URL, "https://{$this->domain}:8006/$uri");
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
		
		if (!empty($post)) {
			curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($post));
		} else {
			curl_setopt($this->curl, CURLOPT_POST, false);
		}
		
		return json_decode(curl_exec($this->curl), true);
	}
	
	public function rebootContainer(int $id) : bool {
		$data = $this->getContainerData($id);
		
		if ($data["data"]["status"] == "running") {
			return $this->query("POST", "api2/extjs/nodes/{$this->node}/lxc/$id/status/reboot")["success"] == 1;
		} else {
			return $this->query("POST", "api2/extjs/nodes/{$this->node}/lxc/$id/status/start")["success"] == 1;
		}
	}
	
	public function getContainerData(int $id) : array {
		return $this->query("GET", "api2/json/nodes/{$this->node}/lxc/$id/status/current");
	}
}