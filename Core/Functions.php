<?php
/**
 * Effectue le rendu de la page
 */
function renderPage() {
	global $data;
	
	$error = error_get_last();
	if (isset($error["message"]) && strstr($error["message"], "Maximum execution time of")) {
		header("Content-Type: text/plain;charset=utf-8");
		exit("Votre requête a générée trop de résultats.");
	}

	$page = ob_get_contents();
	ob_end_clean();

	/*if (isset($_SERVER["HTTP_ACCEPT"]) && $_SERVER["HTTP_ACCEPT"] == "application/json") {
		header("Content-Type: application/json");
		echo json_encode($data);
		exit;
	}*/
	
	preg_match_all("`<!--(.+)-->`isU", $page, $comments);
	$comments = $comments[0];
	
	foreach ($comments as $comment) {
		$page = str_replace($comment, "", $page);
	}
	
	$page = str_replace("> <", "><", str_replace("  ", "", str_replace("\n", "", str_replace("	", "", $page))));
	
	echo $page;
}

/**
 * Écrit du texte à l'écran
 * 
 * @param string $text Texte à afficher
 */
function logs(string $text) {
	echo date("[H:i:s] ")."$text\n";
}

/**
 * Télécharge un fichier
 * 
 * @param string $url URL
 * @param string $output Chemin de destination
 */
function download(string $url, string $output) {	
	shell_exec("wget -U \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36\" -O $output $url");
}

/**
 * Génère le slug d'une chaîne
 *
 * @param string $text Chaîne
 *
 * @return string Slug
 */
function slug(string $text) : string {
	$text = strtolower($text);
	
	$replace = [
		"é" => "e",
		"è" => "e",
		"ê" => "e",
		"à" => "a",
		"â" => "a",
		"ç" => "c",
		"î" => "i",
		"ô" => "o",
		"ù" => "u",
		"û" => "u"
	];
	
	foreach ($replace as $accent=>$letter) {
		$text = str_replace($accent, $letter, $text);
	}
	
	$chars = str_split("abcdefghijklmnopqrstuvwxyz0123456789-");
	$text = str_replace(" ", "-", strtolower($text));

	$text = str_split($text);
	
	foreach ($text as $id=>$char) {
		if (!in_array($char, $chars)) {
			unset($text[$id]);
		}
	}

	$text = implode("", $text);

	return $text;
}