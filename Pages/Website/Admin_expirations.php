<?php
require "Pages/Website/Layout/Start.php";
?>	
<h1>Serveurs proches de l'expiration</h1>
<table class="table table-striped">
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
			<td><a href="/account/admin/servers/expirations/mail?ip=<?=$value["ip"]?>&mode=1" title="Mail rappel" class="btn btn-sm">Mail rappel</a>&nbsp;<a href="/account/admin/servers/expirations/mail?ip=<?=$value["ip"]?>&mode=2" title="Mail expiration" class="btn btn-sm">Mail expiration</a>
<?php
}
?>
	</tbody>
</table>
<?php
require "Pages/Website/Layout/End.php";