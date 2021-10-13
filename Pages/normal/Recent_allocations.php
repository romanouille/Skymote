<?php
require "Pages/$version/Layout/Start.php";
?>
<h1>Recent allocations</h1>
<h2>RIPE allocations</h2>

<table class="table table-striped">
	<thead>
		<tr>
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
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "en")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
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
<br><br>

<h2>IP blocks</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Version
			<th>Block
			<th>Country
			<th>Autonomous System
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
			<td><?=$value["lir"] > 0 ? "AS{$value["lir"]}" : "*"?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=$rirList[$value["rir"]]?>
<?php
}
?>
	</tbody>
</table>
<br><br>
	
<h2>Autonomous System</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID
			<th>Regional Internet Registry
			<th>Created
	</thead>
	
	<tbody>
<?php
foreach ($data["as"] as $value) {
?>
		<tr>
			<td>AS<?=$value["id"]?>
			<td><?=$rirList[$value["rir"]]?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
<?php
}
?>
	</tbody>
</table>
<br><br>
	
<h2>Autonomous System RIPE</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID
			<th>Organisation
			<th>Organisation sponsor
			<th>Description
			<th>Remarks
			<th>Created
			<th>Last modification
	</thead>
	
	<tbody>
<?php
foreach ($data["ripeAs"] as $value) {
?>
		<tr>
			<td>AS<?=$value["id"]?>
			<td><a href="/org/<?=$value["org"]?>" title="<?=$value["org"]?>"><?=$value["org"]?></a>
			<td><a href="/org/<?=$value["sponsoring_org"]?>" title="<?=$value["sponsoring_org"]?>"><?=$value["sponsoring_org"]?></a>
			<td><pre><?=nl2br(htmlspecialchars($value["description"]))?></pre>
			<td><pre><?=nl2br(htmlspecialchars($value["remarks"]))?></pre>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
}
?>
	</tbody>
</table>
<br><br>
	
<h2>RIPE's organisations</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Organisation
			<th>Name
			<th>Local Internet Registry
			<th>Created
			<th>Last modification
	</thead>
		
	<tbody>
<?php
foreach ($data["organisations"] as $value) {
?>
		<tr>
			<td><a href="/org/<?=$value["org"]?>" title="<?=$value["org"]?>"><?=$value["org"]?></a>
			<td><?=htmlspecialchars($value["name"])?>
			<td><?=$value["is_lir"] ? "<span class=\"mif-checkmark\"></span>" : "<span class=\"mif-cross\"></span>"?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
}
?>
	</tbody>
</table>
<br><br>
	
<h2>RIPE's routes</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Version
			<th>Block
			<th>Description
			<th>Origin
			<th>Created
			<th>Last modification
	</thead>
	
	<tbody>
<?php
foreach ($data["routes"] as $value) {
?>
		<tr>
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><pre><?=nl2br(htmlspecialchars($value["description"]))?></pre>
			<td><?=$value["origin"] > 0 ? "AS{$value["origin"]}" : "*"?>
			<td><?=date("d/m/Y H:i:s", $value["created"])?>
			<td><?=date("d/m/Y H:i:s", $value["modified"])?>
<?php
}
?>
	</tbody>
</table>
<?php
require "Pages/$version/Layout/End.php";