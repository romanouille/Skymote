<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>Espace client</h1>
	<a href="/account/vps" title="Mes VPS" class="button primary">Mes VPS</a>&nbsp;
	<a href="/account/invoices" title="Factures" class="button primary">Factures</a><br><br>
	
	Si vous avez besoin de contacter un administrateur, veuillez envoyer un mail à l'adresse <a href="mailto:contact@skymote.net" title="contact@skymote.net">contact@skymote.net</a>.
</div>
<?php
require "Pages/Website/Layout/End.php";