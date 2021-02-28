<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>Serveur Minecraft</h1>
	
<?php
if (isset($messages) && !empty($messages)) {
?>
	<div class="remark info">
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
	
	<table class="table striped">
		<tbody>
			<tr>
				<td>IP
				<td>skymote.net:<?=$port?>
			
			<tr>
				<td>Expiration
				<td><?=date("d/m/Y H:i:s", $expiration)?>
		</tbody>
	</table>
	
	<h2>Console</h2>
	<textarea data-role="textarea"><?=$console?></textarea>
	<form method="post">
		<input type="hidden" name="token" value="<?=$token?>">
		<input type="hidden" name="action" value="cmd">
		<br>
		<input type="text" class="metro-input" name="cmd" placeholder="Commande" required><br><br>
		<input type="submit" class="button success" value="Envoyer">
	</form>
	
	<hr>
	<form method="post">
		<input type="hidden" name="token" value="<?=$token?>">
		<input type="hidden" name="action" value="renew">
		<input type="submit" class="button primary" value="Renouveler pour 24h"<?=time() < $expiration ? " disabled" : ""?>>
	</form>
	<br>

	<a href="/minecraft-renew" title="Renouveler pour 1 mois" class="button primary">Renouveler pour 1 mois</a>
</div>
<?php
require "Pages/Website/Layout/End.php";