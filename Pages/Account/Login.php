<?php
require "Core/Captcha.class.php";

require "Pages/Account/Layout/Start.php";
?>
<form class="bg-white p-6 mx-auto border bd-default win-shadow">
    <h2 class="text-light">Connexion</h2>

    <div class="bg-red fg-white p-3">
        Erreurs
    </div>
    <br>

    <div class="form-group">
        <input type="text" name="login" data-role="input" data-prepend="<span class='mif-user'>" placeholder="Adresse e-mail" required>
    </div>

    <div class="form-group">
        <input type="password" data-role="input" data-prepend="<span class='mif-lock'>" placeholder="Mot de passe" required>
    </div>

    <div class="form-group text-center">
		<?=Captcha::generate()?>
	</div>
    <div class="form-group">
        <input type="submit" class="button success" title="Valider" value="Valider">
        <a href="/account/register" class="button secondary place-right" title="Inscription">Inscription</a>
    </div>

    <div class="form-group">
        <a href="/account/forgotpw" title="Mot de passe oublié">Mot de passe oublié</a>
    </div>
</form>
<?php
require "Pages/Account/Layout/End.php";