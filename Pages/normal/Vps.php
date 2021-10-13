<?php
require "Pages/$version/Layout/Start.php";
?>
<h1>Créer un VPS</h1>
Afin de créer un VPS, vous devez entrer vos informations personnelles.<br><br>
<?php
if (isset($messages) && !empty($messages)) {
?>
<div class="alert alert-info">
<?php
	foreach ($messages as $id=>$message) {
		if ($id > 0) {
			echo "<br>";
		}
		
		echo $message;
	}
?>
</div>
<?php
}
?>

<form method="post">
	Prénom : <input type="text" class="form-control" name="firstname" placeholder="Prénom" required>
	Nom : <input type="text" class="form-control" name="lastname" placeholder="Nom de famille" required>
	Adresse : <input type="text" class="form-control" name="address" placeholder="Adresse postale" required>
	Code postal : <input type="text" class="form-control" name="postalcode" placeholder="Code postal" required>
	Ville : <input type="text" class="form-control" name="city" placeholder="Ville" required>
	Pays : <input type="text" class="form-control" name="country" placeholder="Pays" required>
	Entreprise : <input type="text" class="form-control" name="company" placeholder="Entreprise" required>
	<input type="submit" class="btn btn-white"><br><br>
	<p>En validant ce formulaire, vous acceptez les <a href="/legal" target="_blank" title="Conditions générales d'utilisation">conditions générales d'utilisation</a>.</p>
</form>
<?php
require "Pages/$version/Layout/End.php";