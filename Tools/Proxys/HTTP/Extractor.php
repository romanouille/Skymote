<?php
header("Location: http://{$_SERVER["HTTP_HOST"]}:8080".str_replace("Extractor.php", "", $_SERVER["REQUEST_URI"]));