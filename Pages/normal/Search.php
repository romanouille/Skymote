<?php
require "Pages/$version/Layout/Start.php";
?>
<h1>Search results for <b><?=htmlspecialchars($match[0])?></b></h1>
<br>
	
<h2>Internet service providers</h2><br>
<?php
if (!empty($data["as"])) {
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name
			<th>Country
	</thead>
	
	<tbody>
<?php
	foreach ($data["as"] as $value) {
?>
		<tr>
			<td><a href="/isp/<?=$value["id"]?>-<?=slug($value["name"])?>" title="<?=htmlspecialchars($value["name"])?>"><?=htmlspecialchars($value["name"])?></a>
			<td><?=Locale::getDisplayRegion("-{$value["country"]}", "en")?> <span class="flag-icon flag-icon-<?=$value["country"]?>"></span>
<?php
	}
?>
	</tbody>
</table>
<?php
} else {
?>
<p>
	No AS was found for "<?=htmlspecialchars($match[0])?>".
</p>
<?php
}
?>

<br><br>

<h2>RIPE allocations</h2>
<?php
if (!empty($data["allocations"])) {
?>
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
			<td><?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>
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
<?php
} else {
?>
<p>
	No allocations was found for "<?=htmlspecialchars($match[0])?>".
</p>
<?php
}
?>

<br><br>

<h2>RIPE</h2>
<?php
if (!empty($data["ripe_as"])) {
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Organisation
			<th>Organisation sponsor
			<th>Description
			<th>Remarks
			<th>Créated
			<th>Last modification
	</thead>
	
	<tbody>
<?php
	foreach ($data["ripe_as"] as $value) {
?>
		<tr>
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
<?php
} else {
?>
<p>
	No RIPE data found for "<?=htmlspecialchars($match[0])?>".
</p>
<?php
}
?>

<br><br>
<h2>Organisations</h2>

<?php
if (!empty($data["org"])) {
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Organisation
			<th>Nom
			<th>Local Internet Registry
			<th>Created
			<th>Last modification
	</thead>
	
	<tbody>
<?php
	foreach ($data["org"] as $value) {
?>
		<tr>
			<td><a href="/org/<?=$value["org"]?>" title="<?=$value["org"]?>"><?=$value["org"]?></a>
			<td><?=htmlspecialchars($value["name"])?>
			<td><?=$value["is_lir"] ? "Yes" : "No"?>
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
	No organisation found for "<?=htmlspecialchars($match[0])?>".
</p>
<?php
}
?>

<br><br>
<h2>Routes</h2>

<?php
if (!empty($data["routes"])) {
?>
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
			<td><?=$value["version"]?>
			<td><?=$value["block"]?> (<a href="/ip/<?=$value["block_start"]?>" title="<?=$value["block_start"]?>"><?=$value["block_start"]?></a> - <a href="/ip/<?=$value["block_end"]?>" title="<?=$value["block_end"]?>"><?=$value["block_end"]?></a>)
			<td><pre><?=nl2br(htmlspecialchars($value["description"]))?></pre>
			<td>AS<?=$value["origin"]?>
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
	No route found for "<?=htmlspecialchars($match[0])?>".
</p>
<?php
}
?>
<?php
require "Pages/$version/Layout/End.php";