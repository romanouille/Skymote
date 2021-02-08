<?php
/**
 * Effectue le rendu de la page
 */
function renderPage() {
	$data = ob_get_contents();
	ob_end_clean();
	
	if (strstr($_SERVER["REQUEST_URI"], "/invoice")) {
		echo $data;
		exit;
	}
	
	preg_match_all("`<!--(.+)-->`isU", $data, $comments);
	$comments = $comments[0];
	
	foreach ($comments as $comment) {
		$data = str_replace($comment, "", $data);
	}
	
	$data = str_replace("> <", "><", str_replace("  ", "", str_replace("\n", "", str_replace("	", "", $data))));
	
	echo $data;
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
	$data = shell_exec("wget -U \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36\" -O $output $url");
}

/**
 * Génère le slug d'une chaîne
 *
 * @param string $text Chaîne
 *
 * @return string Slug
 */
function slug(string $text) : string {
	$chars = str_split("abcdefghijklmnopqrstuvwxyz0123456789-");
	$text = iconv("utf-8", "ascii//TRANSLIT//IGNORE", $text);
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