<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Réquisition judiciaire</h1>
<?php
if (isset($message)) {
?>
<div class="remark primary">
	<?=$message?>
</div>
<?php
}
?>
	
<form method="post">
	<div class="form-group">
		<input type="text" class="form-control" placeholder="Adresse IP" name="ip" value="<?=isset($_POST["ip"]) && is_string($_POST["ip"]) ? htmlspecialchars($_POST["ip"]) : ""?>">
	</div>
	
	<div class="form-group">
		<input type="text" class="form-control" placeholder="Horodatage" name="time" value="<?=isset($_POST["time"]) && is_string($_POST["time"]) ? htmlspecialchars($_POST["time"]) : ""?>">
	</div>
	
	<div class="form-group">
		<input type="submit" class="btn btn-white" value="Valider">
	</div>
</form>
	
<?php
if ($success) {
?>
<br>
<table class="table table-striped">
	<tbody>
		<tr>
			<td><b>Prénom</b>
			<td><?=htmlspecialchars($data["firstname"])?>
		
		<tr>
			<td><b>Nom</b>
			<td><?=htmlspecialchars($data["lastname"])?>
			
		<tr>
			<td><b>Entreprise</b>
			<td><?=!empty($data["company"]) ? htmlspecialchars($data["company"]) : ""?>
			
		<tr>
			<td><b>Adresse</b>
			<td><?=htmlspecialchars($data["address"])?>
		
		<tr>
			<td><b>Code postal</b>
			<td><?=htmlspecialchars($data["postalcode"])?>
		
		<tr>
			<td><b>Ville</b>
			<td><?=htmlspecialchars($data["city"])?>
		
		<tr>
			<td><b>Pays</b>
			<td><?=htmlspecialchars($data["country"])?>
	</tbody>
</table>
<br><br>

<p>
<b>Adresses IP</b> :<br>
<?php
	foreach ($data["ip"] as $id=>$value) {
		if ($id > 0) {
			echo "<br>";
		}
?>
	<?=$value["ip"]?>:<?=$value["port"]?> (<?=date("d/m/Y H:i:s", $value["timestamp"])?>)
<?php
	}
?>
</p>
<?php
}

require "Pages/Website/Layout/End.php";