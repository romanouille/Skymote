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
	<div class="remark alert">
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
	
	<p>Créez gratuitement un serveur Minecraft vanilla pour une durée de 24h renouvelables.</p><br><br>
	
	<form method="post">
		<?=Captcha::generate()?><br>
		<input type="submit" class="btn success" value="Créer un serveur">
	</form>
	
	<div class="remark info">
		➡️ <b>Caractéristiques de l'hôte</b>
		<ul>
			<li>2x Intel(R) Xeon(R) CPU E5-2699 v4 @ 2.20GHz/3.60GHz 22c/44t (= 44c/88t)
			<li>768 Go RAM DDR4 1866MHz ECC (4 Go de RAM maximum alloué par serveur Minecraft)
			<li>4x4 To SSD RAID 10
		</ul>
	</div>
</div>
<?php
require "Pages/Website/Layout/End.php";