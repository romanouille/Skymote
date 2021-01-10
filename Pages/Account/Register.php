<?php
require "Core/Captcha.class.php";

require "Pages/Account/Layout/Start.php";
?>
<form class="bg-white p-6 mx-auto border bd-default win-shadow">
    <h2 class="text-light">Créer un compte</h2>

    <div class="bg-red fg-white p-3">
        Erreurs
    </div>
    <br>

    <div class="form-group">
        <input type="text" name="email" data-role="input" data-prepend="<span class='mif-user'>" placeholder="Adresse e-mail" required>
    </div>

    <div class="form-group">
        <input type="password" data-role="input" data-prepend="<span class='mif-lock'>" placeholder="Mot de passe" required>
    </div>
	
    <div class="form-group">
        <input type="password" data-role="input" data-prepend="<span class='mif-lock'>" placeholder="Réécrivez votre mot de passe" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="firstname" data-role="input" data-prepend="<span class='mif-user'>" placeholder="Prénom" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="lastname" data-role="input" data-prepend="<span class='mif-user'>" placeholder="Nom" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="address" data-role="input" data-prepend="<span class='mif-home'>" placeholder="Adresse postale" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="postalcode" data-role="input" data-prepend="<span class='mif-home'>" placeholder="Code postal" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="city" data-role="input" data-prepend="<span class='mif-home'>" placeholder="Ville" required>
    </div>

    <div class="form-group text-center">
		<?=Captcha::generate()?>
	</div>
	
    <div class="form-group">
        <input type="submit" class="button success" title="Valider" value="Valider">
        <a href="/account/login" class="button secondary place-right" title="J'ai déjà un compte">J'ai déjà un compte</a>
    </div>
</form>
<?php
require "Pages/Account/Layout/End.php";