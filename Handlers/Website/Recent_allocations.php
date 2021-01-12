<?php
require "Core/GeoIP.class.php";

$data = GeoIP::getRecentsAllocations();

require "Pages/Website/Recent_allocations.php";