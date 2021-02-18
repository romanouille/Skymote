<?php
class Scans {
	public static function load(int $page) : array {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "http://5.39.78.72:65534/?key=bc0e686e37d9de79a6211db252de58b7e161ac96&offset=".(($page-1)*50));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$page = curl_exec($curl);
		curl_close($curl);
		
		return json_decode($page, true);
	}
}