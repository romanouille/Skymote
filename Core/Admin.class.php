<?php
class Admin {
	/**
	 * Récupère la liste de toutes les factures créées sur le site
	 *
	 * @return array Factures
	 */
	public static function getAllInvoices() : array {
		global $db;
		
		$query = $db->prepare("SELECT id, user_email, timestamp FROM invoices ORDER BY timestamp DESC");
		$query->execute();
		$data = $query->fetchAll();
		$result = [];
		
		foreach ($data as $value) {
			$value = array_map("trim", $value);
			
			$result[] = [
				"id" => (int)$value["id"],
				"user_email" => (string)$value["user_email"],
				"timestamp" => (int)$value["timestamp"]
			];
		}
		
		return $result;
	}
}