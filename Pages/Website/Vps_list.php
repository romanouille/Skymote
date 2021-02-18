<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>Mes VPS</h1>
<?php
if (!empty($data)) {
?>
	<table class="table striped">
		<thead>
			<tr>
				<th>IP
				<th>Offre
				<th>Expiration
		</thead>
		
		<tbody>
<?php
	foreach ($data as $value) {
?>
			<tr>
				<td><a href="/account/vps/<?=$value["ip"]?>/" title="<?=$value["ip"]?>"><?=$value["ip"]?></a>
				<td>
<?php
		if ($value["type"] == 1) {
			echo "Debian-1";
		}
?>
				<td><?=date("d/m/Y H:i:s", $value["expiration"])?>
<?php
	}
?>
		</tbody>
	</table>
<?php
} else {
?>
	<div class="remark warning">
		Vous ne possédez aucun VPS.
	</div>
<?php
}
?>
</div>
<?php
require "Pages/Website/Layout/End.php";