<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>Serveurs proches de l'expiration</h1>
	<table class="table striped">
		<thead>
			<tr>
				<th>IP
				<th>Expiration
				<th>Actions
		</thead>
		
		<tbody>
<?php
foreach ($data as $value) {
?>
			<tr>
				<td><?=$value["ip"]?>
				<td><?=date("d/m/Y H:i:s", $value["expiration"])?>
				<td><a href="/account/admin/servers/expirations/mail?ip=<?=$value["ip"]?>&mode=1" title="Mail rappel" class="button primary">Mail rappel</a>&nbsp;<a href="/account/admin/servers/expirations/mail?ip=<?=$value["ip"]?>&mode=2" title="Mail expiration" class="button primary">Mail expiration</a>
<?php
}
?>
		</tbody>
	</table>
</div>
<?php
require "Pages/Website/Layout/End.php";