<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Évènements BGP</h1>
<table>
	<thead>
		<tr>
			<th>Version
			<th>Bloc
			<th>Pays initial
			<th>Nouveau pays
			<th>FAI initial
			<th>Nouveau FAI
			<th>Heure
	</thead>
	
	<tbody>
<?php
foreach ($data as $value) {
?>
		<tr>
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><?=Locale::getDisplayRegion("-{$value["ispBefore"]["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["ispBefore"]["country"]?>"></span>
			<td><?=Locale::getDisplayRegion("-{$value["ispAfter"]["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["ispAfter"]["country"]?>"></span>
			<td><?php if ($value["before"] > 0 && $value["ispBefore"]["name"] != "*") { ?><a href="/isp/<?=$value["before"]?>-<?=slug($value["ispBefore"]["name"])?>" title="<?=htmlspecialchars($value["ispBefore"]["name"])?>"><?=htmlspecialchars($value["ispBefore"]["name"])?></a> (AS<?=$value["before"]?>)<?php } else { echo "*"; }?>
			<td><?php if ($value["after"] > 0 && $value["ispAfter"]["name"] != "*") { ?><a href="/isp/<?=$value["after"]?>-<?=slug($value["ispAfter"]["name"])?>" title="<?=htmlspecialchars($value["ispAfter"]["name"])?>"><?=htmlspecialchars($value["ispAfter"]["name"])?></a> (AS<?=$value["after"]?>)<?php } else { echo "*"; }?>
			<td><?=date("H:i:s", $value["timestamp"])?>
<?php
}
?>
	</tbody>
</table>
<?php
require "Pages/Website/Layout/End.php";