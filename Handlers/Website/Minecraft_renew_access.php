<?php
require "Core/MinecraftServer.class.php";

if (!isset($_COOKIE["minecraft_session"]) || !MinecraftServer::cookieExists($_COOKIE["minecraft_session"])) {
	setcookie("minecraft_session", "", -86400, "/", $_SERVER["HTTP_HOST"], $_SERVER["SERVER_PORT"] == 443, true);
	header("Location: /minecraft");
	exit;
}

$pageTitle = "Renouvellement du serveur Minecraft pour 1 mois";
$pageDescription = "Renouvelez votre serveur Minecraft pour une durée de 1 mois";

// Déclaration des variables
$ident=$idp=$ids=$idd=$codes=$code1=$code2=$code3=$code4=$code5=$datas='';
$idp = $config["starpass"]["idp"];
// $ids n'est plus utilisé, mais il faut conserver la variable pour une question de compatibilité
$idd = $config["starpass"]["idd"];
$ident=$idp.";".$ids.";".$idd;
// On récupère le(s) code(s) sous la forme 'xxxxxxxx;xxxxxxxx'
if(isset($_POST['code1'])) $code1 = $_POST['code1'];
if(isset($_POST['code2'])) $code2 = ";".$_POST['code2'];
if(isset($_POST['code3'])) $code3 = ";".$_POST['code3'];
if(isset($_POST['code4'])) $code4 = ";".$_POST['code4'];
if(isset($_POST['code5'])) $code5 = ";".$_POST['code5'];
$codes=$code1.$code2.$code3.$code4.$code5;
// On récupère le champ DATAS
if(isset($_POST['DATAS'])) $datas = $_POST['DATAS'];
// On encode les trois chaines en URL
$ident=urlencode($ident);
$codes=urlencode($codes);
$datas=urlencode($datas);

/* Envoi de la requête vers le serveur StarPass
Dans la variable tab[0] on récupère la réponse du serveur
Dans la variable tab[1] on récupère l'URL d'accès ou d'erreur suivant la réponse du serveur */
$get_f=@file( "https://script.starpass.fr/check_php.php?ident=$ident&codes=$codes&DATAS=$datas" );
if(!$get_f)
{
exit( "Votre serveur n'a pas accès au serveur de StarPass, merci de contacter votre hébergeur. " );
}
$tab = explode("|",$get_f[0]);

if(!$tab[1]) $url = "https://script.starpass.fr/error.php";
else $url = $tab[1];

// dans $pays on a le pays de l'offre. exemple "fr"
$pays = $tab[2];
// dans $palier on a le palier de l'offre. exemple "Plus A"
$palier = urldecode($tab[3]);
// dans $id_palier on a l'identifiant de l'offre
$id_palier = urldecode($tab[4]);
// dans $type on a le type de l'offre. exemple "sms", "audiotel, "cb", etc.
$type = urldecode($tab[5]);
// vous pouvez à tout moment consulter la liste des paliers à l'adresse : https://script.starpass.fr/palier.php

// Si $tab[0] ne répond pas "OUI" l'accès est refusé
// On redirige sur l'URL d'erreur
if( substr($tab[0],0,3) != "OUI" )
{
       header( "Location: $url" );
       exit;
}

$port = MinecraftServer::cookieToPort($_COOKIE["minecraft_session"]);
$server = new MinecraftServer($port);
$server->extendExpirationForOneMonth();

require "Pages/Website/Minecraft_renew_access.php";