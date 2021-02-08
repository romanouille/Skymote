<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Erreur <?=http_response_code()?></a>
	</ul>
	
	<div class="center">
		<h2>ERREUR</h2>
		<h1><?=http_response_code()?></h1>
		
<?php
switch (http_response_code()) {
	case 400:
		echo "La requête est invalide.";
		break;
		
	case 401:
		echo "Vous devez être connecté afin d'effectuer cette action.";
		break;
	
	case 403:
		echo "Accès refusé.";
		break;
		
	case 404:
		echo "Le contenu demandé est introuvable.";
		break;
		
	case 500:
		echo "Une erreur interne est survenue, veuillez réessayer.";
		break;
	
	case 503:
		echo "Cette page est temporairement indisponible, veuillez réessayer.<br>Si vous venez d'effectuer un paiement, celui-ci ne sera pas pris en compte.";
		break;
}
?>
	</div>
</div>
<?php
require "Pages/Website/Layout/End.php";