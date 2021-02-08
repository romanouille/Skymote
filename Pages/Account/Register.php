<?php
require "Pages/Account/Layout/Start.php";
?>
<form method="post" class="bg-white p-6 mx-auto border bd-default win-shadow">
    <h2 class="text-light">Créer un compte</h2>

<?php
if (isset($messages)) {
?>
    <div class="bg-blue fg-white p-3">
        <?php foreach ($messages as $id=>$message) { if ($id > 0) echo "<br>"; echo $message; }?>
    </div>
    <br>
<?php
}

if (!$success) {
?>
    <div class="form-group">
        <input type="text" name="email" data-role="input" data-prepend="<span class='mif-user'>" placeholder="Adresse e-mail" value="<?=isset($_POST["email"]) && is_string($_POST["email"]) ? htmlspecialchars($_POST["email"]) : ""?>" maxlength="100" required>
    </div>

    <div class="form-group">
        <input type="password" name="password" data-role="input" data-prepend="<span class='mif-lock'>" placeholder="Mot de passe" value="<?=isset($_POST["password"]) && is_string($_POST["password"]) ? htmlspecialchars($_POST["password"]) : ""?>" maxlength="72" required>
    </div>
	
    <div class="form-group">
        <input type="password" name="password2" data-role="input" data-prepend="<span class='mif-lock'>" placeholder="Réécrivez votre mot de passe" value="<?=isset($_POST["password2"]) && is_string($_POST["password2"]) ? htmlspecialchars($_POST["password2"]) : ""?>" maxlength="72" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="company" data-role="input" data-prepend="<span class='mif-user'>" placeholder="Entreprise" value="<?=isset($_POST["company"]) && is_string($_POST["company"]) ? htmlspecialchars($_POST["company"]) : ""?>" maxlength="100">
    </div>
	
    <div class="form-group">
        <input type="text" name="firstname" data-role="input" data-prepend="<span class='mif-user'>" placeholder="Prénom" value="<?=isset($_POST["firstname"]) && is_string($_POST["firstname"]) ? htmlspecialchars($_POST["firstname"]) : ""?>" maxlength="100" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="lastname" data-role="input" data-prepend="<span class='mif-user'>" placeholder="Nom" value="<?=isset($_POST["lastname"]) && is_string($_POST["lastname"]) ? htmlspecialchars($_POST["lastname"]) : ""?>" maxlength="100" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="address" data-role="input" data-prepend="<span class='mif-home'>" placeholder="Adresse postale" value="<?=isset($_POST["address"]) && is_string($_POST["address"]) ? htmlspecialchars($_POST["address"]) : ""?>" maxlength="100" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="postalcode" data-role="input" data-prepend="<span class='mif-home'>" placeholder="Code postal" value="<?=isset($_POST["postalcode"]) && is_string($_POST["postalcode"]) ? htmlspecialchars($_POST["postalcode"]) : ""?>" maxlength="100" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="city" data-role="input" data-prepend="<span class='mif-home'>" placeholder="Ville" value="<?=isset($_POST["city"]) && is_string($_POST["city"]) ? htmlspecialchars($_POST["city"]) : ""?>" maxlength="100" required>
    </div>
	
    <div class="form-group">
        <input type="text" name="country" data-role="input" data-prepend="<span class='mif-home'>" placeholder="Pays" value="<?=isset($_POST["country"]) && is_string($_POST["country"]) ? htmlspecialchars($_POST["country"]) : ""?>" maxlength="100" required>
    </div>

    <div class="form-group text-center">
		<?=Captcha::generate()?>
	</div>
	
    <div class="form-group">
        <input type="submit" class="button success" title="Valider" value="Valider">
        <a href="/account/login" class="button secondary place-right" title="J'ai déjà un compte">J'ai déjà un compte</a>
    </div>
<?php
} else {
?>
	<a href="/account/login" title="Connexion">Connexion</a>
<?php
}
?>
</form>
<?php
require "Pages/Account/Layout/End.php";