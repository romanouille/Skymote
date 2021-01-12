<?php
require "Core/GeoIP.class.php";

$data = GeoIP::getOrgData($match[0]);
if (empty($data)) {
	http_response_code(404);
	require "Handlers/Website/Error.php";
}

require "Pages/Website/Org.php";