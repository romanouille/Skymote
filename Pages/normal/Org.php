<?php
require "Pages/$version/Layout/Start.php";
?>
<h1>Organisation <b><?=$match[0]?></b></h1>

<table class="table table-striped">
	<tbody>
		<tr>
			<td>Name
			<td><?=htmlspecialchars($data["name"])?>
			
		<tr>
			<td>Local Internet Registry
			<td><?=$data["is_lir"] ? "Oui" : "Non"?>
			
		<tr>
			<td>Created
			<td><?=date("d/m/Y H:i:s", $data["created"])?>
			
		<tr>
			<td>Last modification
			<td><?=date("d/m/Y H:i:s", $data["modified"])?>
	</tbody>
</table>
	
<h2>Allocations</h2>

<?php
if (!empty($data["allocations"])) {
?>
<table class="table striped">
	<thead>
		<tr>
			<th>Version
			<th>Block
			<th>Country
			<th>Netname
			<th>Description
			<th>Remarks
			<th>Status
			<th>Créated
			<th>Last modification
	</thead>
	
	<tbody>
<?php
	foreach ($data["allocations"] as $value) {
?>
		<tr>
			<td>IPv<?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
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
<?php
} else {
?>
<p>
	This organization has no allocations.
</p>
<?php
}

require "Pages/$version/Layout/End.php";