<?php
require "Pages/$version/Layout/Start.php";
?>
<h1>List of ISPs by country</h1>
<h2>Select a country</h2><br>
	
<div class="grid">
	<div class="row">
		<div class="cell-lg-3 cell-12">
			<form method="get">
				<select name="country" class="form-select">
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
		</div>
	</div>
</div>
<br><br>
<?php
if (isset($data)) {
	if (!empty($data)) {
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Autonomous System (approximate)
			<th>Name
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
<p>
	There is no Internet service provider in this country.
</p>
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
	<a href="/isp-list?country=<?=$countryCode?>" title="<?=Locale::getDisplayRegion("-$countryCode", "en")?>"><?=Locale::getDisplayRegion("-$countryCode", "en")?></a>
<?php
	}
?>
</div>
<?php
}

require "Pages/$version/Layout/End.php";