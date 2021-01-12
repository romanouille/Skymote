<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Liste des FAI par pays</a>
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
?>
	<table class="table striped">
		<thead>
			<tr>
				<th>AS
				<th>Nom
		</thead>
		
		<tbody>
<?php
	foreach ($data as $value) {
?>
			<tr>
				<td>AS<?=$value["id"]?>
				<td><?=htmlspecialchars($value["name"])?>
<?php
	}
?>
		</tbody>
	</table>
<?php
}
?>
</div>
<?php
require "Pages/Website/Layout/End.php";