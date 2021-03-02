<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Admin</h1>

<p>
	<?=$message?>
</p>

<?php
if (!$success) {
?>	
<form method="post">
	<div class="form-group">
		<input type="text" class="form-control" placeholder="Mot de passe" name="password">
	</div>
	
	<div class="form-group">
		<input type="submit" class="btn btn-white" value="Valider">
	</div>
</form>
<?php
}

require "Pages/Website/Layout/End.php";