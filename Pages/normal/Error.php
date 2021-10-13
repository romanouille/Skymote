<?php
require "Pages/$version/Layout/Start.php";
?>
<div class="center">
	<h2>ERROR</h2>
	<h1><?=http_response_code()?></h1>
	
<?php
switch (http_response_code()) {
	case 400:
		echo "The request is invalid.";
		break;
		
	case 401:
		echo "You must be connected in order to access to this section.";
		break;
	
	case 403:
		echo "Access denied.";
		break;
		
	case 404:
		echo "The requested page has been not found.";
		break;
	
	case 410:
		echo "The requested page has been deleted.";
		break;
		
	case 500:
		echo "An internal server error occured, please retry.";
		break;
	
	case 503:
		echo "This page is unavailable, please retry in a few minutes.";
		break;
}
?>
</div>
<?php
require "Pages/$version/Layout/End.php";