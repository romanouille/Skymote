<?php
require "Core/GeoIP.class.php";

$data = GeoIP::getProxysList();

require "Pages/Website/Proxys.php";