<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Mes VPS</h1>
<?php
if (!empty($data)) {
?>
<table class="table table-striped">
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
		} elseif ($value["type"] == 2) {
			echo "Debian-2";
		} elseif ($value["type"] == 3) {
			echo "Debian-3";
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
<p>
	Vous ne possédez aucun VPS.
</p>
<?php
}

require "Pages/Website/Layout/End.php";