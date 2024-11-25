<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Liste des FAI par pays</h1>
<h2>Sélectionnez un pays</h2><br>
	
<form method="get">
	<select name="country">
<?php
foreach ($countriesName as $countryCode=>$countryName) {
?>
		<option value="<?=$countryCode?>" <?=isset($match[0]) && $match[0] == $countryCode ? " selected" : ""?>><?=$countryName?></span></option>
<?php
}
?>
	</select>
	<br><br>
					
	<input type="submit" class="btn btn-white">
</form>
<br><br>
<?php
if (isset($data)) {
	if (!empty($data)) {
?>
<table>
	<thead>
		<tr>
			<th>Autonomous System (approximatif)
			<th>Nom
	</thead>
	
	<tbody>
<?php
		foreach ($data as $value) {
?>
		<tr>
			<td>AS<?=$value["id"]?>
			<td><a href="/isp/<?=$value["id"]?>-<?=slug($value["name"])?>" title="<?=htmlspecialchars($value["name"])?>"><?=htmlspecialchars($value["name"])?></a>
<?php
		}
?>
	</tbody>
</table>
<?php
	} else {
?>
<div class="alert">
	Il n'y a aucun fournisseur d'accès Internet dans ce pays.
</div>
<?php
	}
} else {
?>
<div class="isp-list" style="font-size:10px">
<?php
	foreach ($countries as $id=>$countryCode) {
		if ($id > 0) {
			echo " - ";
		}
?>
	<a href="/isp-list?country=<?=$countryCode?>" title="<?=Locale::getDisplayRegion("-$countryCode")?>"><?=Locale::getDisplayRegion("-$countryCode", "fr")?></a>
<?php
	}
?>
</div>
<?php
}

require "Pages/Website/Layout/End.php";