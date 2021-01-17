<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>Liste des FAI par pays</h1>
	<h2>Sélectionnez un pays</h2>
	
	<div class="grid">
		<div class="row">
			<div class="cell-lg-3 cell-12">
				<form method="get">
					<select name="country" data-role="select">
<?php
foreach ($countries as $countryCode) {
?>
						<option value="<?=$countryCode?>" data-template="<span class='flag-icon flag-icon-<?=$countryCode?>'></span>&nbsp;$1"<?=isset($match[0]) && $match[0] == $countryCode ? " selected" : ""?>><?=Locale::getDisplayRegion("-$countryCode", "fr")?></span></option>
<?php
}
?>
					</select>
					<br>
					
					<input type="submit" class="button success">
				</form>
			</div>
		</div>
	</div>
	
<?php
if (isset($data)) {
	if (!empty($data)) {
?>
	<table class="table striped">
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
	<div class="remark alert">
		Il n'y a aucun fournisseur d'accès Internet dans ce pays.
	</div>
<?php
	}
} else {
?>
	<div class="isp-list">
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
?>
</div>
<?php
require "Pages/Website/Layout/End.php";