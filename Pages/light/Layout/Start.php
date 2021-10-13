<!DOCTYPE html>
<html lang="fr">
	<head>
		<title><?=$pageTitle?> - Skymote</title>
		<meta charset="utf-8">
		<link href="<?=$_SERVER["REMOTE_ADDR"] == "127.0.0.1" ? "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" : "/light/css/bootstrap.min.css"?>" rel="stylesheet" media="screen">
		<style>
			body {
				padding-top:60px
			}
		</style>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="brand" href="#">Skymote</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li><a href="/">Accueil</a></li>
							<li><a href="/isp-list">Liste des FAI par pays</a></li>
							<li><a href="/recent-allocations">Récentes allocations</a></li>
							<li><a href="/api">API</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
