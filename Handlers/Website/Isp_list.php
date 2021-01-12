<?php
require "Core/GeoIP.class.php";

if (isset($match[0])) {
	if (!in_array($match[0], $countries)) {
		http_response_code(404);
		require "Handlers/Error.php";
	}
	
	$data = GeoIP::getIspList($match[0]);
}

require "Pages/Website/Isp_list.php";