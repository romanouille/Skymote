<?php
require "Pages/$version/Layout/Start.php";
?>
<h1><?=htmlspecialchars($data["name"])?></h1>
<table class="table table-striped">
	<tbody>
		<tr>
			<td>Country
			<td><?=Locale::getDisplayRegion("-{$data["country"]}", "en")?> <span class="flag-icon flag-icon-<?=$data["country"]?>"></span>
		
		<tr>
			<td>Autonomous System (approximate)
			<td>AS<?=$ispId?>
	</tbody>
</table>
<br><br>

<h2>IP blocks</h2>
<?php
if (!empty($data["blocks"])) {
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Version
			<th>Block
			<th>Country
			<th>Created
			<th>Regional Internet Registry
	</thead>
	
	<tbody>
<?php
	foreach ($data["blocks"] as $value) {
?>
		<tr>
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "en")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=$rirList[$value["rir"]]?>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<div class="remark alert">
	This ISP does not have an IP block.
</div>
<?php
}

require "Pages/$version/Layout/End.php";