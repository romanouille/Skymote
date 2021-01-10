<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Erreur <?=http_response_code()?></a>
	</ul>
	
	<h1>Erreur <?=http_response_code()?></h1>
</div>
<?php
require "Pages/Website/Layout/End.php";