<?php
require "Pages/$version/Layout/Start.php";
?>	
<h1>IP address <b><?=$ip?></b></h1>
	
<table class="table table-striped">
	<tbody>
		<tr>
			<td>Internet Service Provider
			<td><?=$data["block"]["lir"] > 0 ? "<a href=\"/isp/{$data["block"]["lir"]}-".slug($data["lir"]["name"])."\" title=\"".htmlspecialchars($data["lir"]["name"])."\">".htmlspecialchars($data["lir"]["name"])."</a>" : "*"?>
		
		<tr>
			<td>Country
			<td><?=Locale::getDisplayRegion("-{$data["lir"]["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$data["lir"]["country"]?>"></span>
		
		<tr>
			<td>Version
			<td>IPv<?=$data["block"]["version"]?>
		
		<tr>
			<td>Block
			<td><?=$data["block"]["block"]?> (<a href="/ip/<?=$data["block"]["block_start"]?>" title="<?=$data["block"]["block_start"]?>"><?=$data["block"]["block_start"]?></a> - <a href="/ip/<?=$data["block"]["block_end"]?>" title="<?=$data["block"]["block_end"]?>"><?=$data["block"]["block_end"]?></a>)
		
		<tr>
			<td>Block country
			<td><?=Locale::getDisplayRegion("-{$data["block"]["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$data["block"]["country"]?>"></span>
		
		<tr>
			<td>Autonomous System (approximate)
			<td><?=$data["block"]["lir"] > 0 ? "AS{$data["block"]["lir"]}" : "*"?>
		
		<tr>
			<td>Block creation
			<td><?=date("d/m/Y H:i:s", $data["block"]["created"])?>
		
		<tr>
			<td>Regional Internet Registry
			<td><?=$rirList[$data["block"]["rir"]]?>
	</tbody>
</table>
	
<?php
if ($data["block"]["rir"] == 4 && !empty($data["allocations"])) {
?>
<h2>Allocations</h2>

<table class="table table-striped">
	<thead>
		<th>Version
		<th>Block
		<th>Organisation
		<th>Country
		<th>Netname
		<th>Description
		<th>Remarks
		<th>Status
		<th>Created
		<th>Last modification
	</thead>
	
	<tbody>
<?php
	foreach ($data["allocations"] as $value) {
?>
		<tr>
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><a href="/org/<?=$value["org"]?>" title="<?=$value["org"]?>"><?=$value["org"]?></a>
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "fr")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
			<td><?=htmlspecialchars($value["netname"])?>
			<td><pre><?=nl2br(htmlspecialchars($value["description"]))?></pre>
			<td><pre><?=nl2br(htmlspecialchars($value["remarks"]))?></pre>
			<td><?=$value["status"]?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
	}
?>
	</tbody>
</table>
<?php
	if (!empty($data["routes"])) {
?>
<br>
<h2>Routes</h2>
<table class="table table-striped">
	<thead>
		<th>Version
		<th>Block
		<th>Description
		<th>Origin
		<th>Created
		<th>Last modificiation
	</thead>
	
	<tbody>
<?php
		foreach ($data["routes"] as $value) {
?>
		<tr>
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><pre><?=nl2br(htmlspecialchars($value["description"]))?></pre>
			<td><?=$value["origin"]?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
		}
	}
?>
	</tbody>
</table>
<?php
}

require "Pages/$version/Layout/End.php";