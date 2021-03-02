<?php
class Hypervisor {
	public function __construct(int $id) {
		$this->id = $id;
	}
	
	public function getAuthPassword() : string {
		global $db;
		
		$query = $db->prepare("SELECT password FROM hypervisors WHERE id = :id");
		$query->bindValue(":id", $this->id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		return trim($data["password"]);
	}
}