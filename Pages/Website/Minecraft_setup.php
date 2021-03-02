<?php
require "Pages/Website/Layout/Start.php";
?>
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
	
<table class="table table-striped">
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
<textarea class="form-control"><?=$console?></textarea>
<form method="post">
	<input type="hidden" name="token" value="<?=$token?>">
	<input type="hidden" name="action" value="cmd">
	<br>
	<input type="text" class="form-control" name="cmd" placeholder="Commande" required>
	<input type="submit" class="btn btn-white" value="Envoyer">
</form>

<hr>
<form method="post">
	<input type="hidden" name="token" value="<?=$token?>">
	<input type="hidden" name="action" value="renew">
	<input type="submit" class="btn btn-white" value="Renouveler pour 24h"<?=time() < $expiration ? " disabled" : ""?>>
</form>
<?php
require "Pages/Website/Layout/End.php";