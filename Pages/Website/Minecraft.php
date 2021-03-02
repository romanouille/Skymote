<?php
require "Pages/Website/Layout/Start.php";
?>
<h1>Serveur Minecraft</h1>
	
<?php
if (isset($messages) && !empty($messages)) {
?>
<p>
<?php
	foreach ($messages as $id=>$message) {
		if ($id > 0) {
			echo "<br>";
		}
		
		echo $message;
	}
?>
</p>
<?php
}
?>
	
<p>Créez gratuitement un serveur Minecraft vanilla pour une durée de 24h renouvelable.</p><br>

<form method="post">
	<?=Captcha::generate()?><br>
	<input type="submit" class="btn btn-white" value="Créer un serveur">
</form>
<br>

<p>
	➡️ <b>Caractéristiques de l'hôte</b>
	<ul>
		<li>2x Intel(R) Xeon(R) CPU E5-2699 v4 @ 2.20GHz/3.60GHz 22c/44t (= 44c/88t)
		<li>768 Go RAM DDR4 1866MHz ECC (4 Go de RAM maximum alloué par serveur Minecraft)
		<li>4x4 To SSD RAID 10
	</ul>
</p>
<?php
require "Pages/Website/Layout/End.php";