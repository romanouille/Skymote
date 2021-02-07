<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link">Admin</a>
	</ul>
	
	<h1>Admin</h1>
	
	<div class="remark primary">
		<?=$message?>
	</div>
	
<?php
if (!$success) {
?>	
	<form method="post">
		<div class="form-group">
			<label>Mot de passe d'administration</label>
			<input type="text" class="metro-input" placeholder="Mot de passe" name="password">
		</div>
		
		<div class="form-group">
			<input type="submit" class="button success" value="Valider">
		</div>
	</form>
<?php
}
?>
</div>
<?php
require "Pages/Website/Layout/End.php";