<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="container page">
	<ul class="breadcrumbs">
		<li class="page-item"><a href="#" class="page-link">Skymote</a>
		<li class="page-item"><a href="#" class="page-link"><?=$pageTitle?></a>
	</ul>
	
	<h1>Renouvellement du serveur Minecraft pour 1 mois</h1>
	
	<div id="starpass_<?=$config["starpass"]["idd"]?>"></div><script type="text/javascript" src="https://script.starpass.fr/script.php?idd=<?=$config["starpass"]["idd"]?>&amp;verif_en_php=1&amp;datas="></script><noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br /><a href="https://www.starpass.fr/">Micro Paiement StarPass</a></noscript>
</div>
<?php
require "Pages/Website/Layout/End.php";