<?php
require "Pages/Account/Layout/Start.php";
?>
<form class="bg-white p-6 mx-auto border bd-default win-shadow">
    <h2 class="text-light">Connexion</h2>

    <div class="bg-green fg-white p-3">
        Vous êtes authentifié sous le compte <?=$_SERVER["PHP_AUTH_USER"]?>.
    </div>
	<br>
	
	<a href="/" title="Retour au site">Retour au site</a>
</form>
<?php
require "Pages/Account/Layout/End.php";