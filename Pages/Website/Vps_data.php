<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>VPS <?=$match[0]?></h1>
	<table class="table striped">			
		<tr>
			<td>Identifiants root
			<td>root / <?=$data["password"]?>
			
		<tr>
			<td>Expiration
			<td><?=date("d/m/Y H:i:s", $data["expiration"])?>
	</table>
	<br>
	
	<a href="/account/buy/init?product=2&service=<?=$match[0]?>" class="button primary">Renouveler le VPS pour 1 mois</a>

</div>
<?php
require "Pages/Website/Layout/End.php";