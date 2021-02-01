<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>Mon compte</h1>
	<a href="/account/vps" title="Mes VPS" class="button success">Mes VPS</a><br><br>
	<a href="/account/informations" title="Mes informations personnelles" class="button success">Mes informations personnelles</a>
</div>
<?php
require "Pages/Website/Layout/End.php";