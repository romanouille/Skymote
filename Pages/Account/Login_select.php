<?php
require "Core/Captcha.class.php";

require "Pages/Account/Layout/Start.php";
?>
<form class="bg-white p-6 mx-auto border bd-default win-shadow">
    <h2 class="text-light">Connexion</h2>

    <div class="bg-red fg-white p-3">
        Vous devez vous authentifier. <a href="<?=$_SERVER["REQUEST_URI"]?>" title="Actualiser">Actualiser</a>
    </div>
    <br>

    <div class="form-group">
        <a href="/account/register" class="button secondary place-right" title="Inscription">Inscription</a>
    </div>

    <div class="form-group">
        <a href="/account/forgotpw" title="Mot de passe oublié">Mot de passe oublié</a>
    </div>
</form>
<?php
require "Pages/Account/Layout/End.php";