<?php
$pageTitle = "Error ".http_response_code();
$pageDescription = "Error ".http_response_code();

require "Pages/$version/Error.php";

exit;