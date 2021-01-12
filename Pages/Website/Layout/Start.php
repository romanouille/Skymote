<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Skymote</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw==" crossorigin="anonymous">
		<style>
* {
	font-family:"Open Sans", sans-serif
}

.put-left {
    left: 0;
    right: auto;
}

.put-right {
    left: auto;
    right: 0;
}

.app-bar {
	background-color:inherit
}

.app-bar-wrapper {
	background:rgba(9,80,132,1);
	color:#fff
}

header #right {
	margin-top:10px
}

.home {
	padding:50px 0 200px;
	background:linear-gradient(180deg, rgba(9,80,132,1) 0%, rgba(0,164,150,1) 67%);
	text-align:center;
	color:#fff
}

.home h1 {
	font-size:70px
}

.home h2 {
	margin-bottom:50px
}

.home .buttons {
	margin-top:100px
}

.card {
	text-align:center
}

.card-header {
	color:#fff;
	text-transform:uppercase;
	font-size:30px
}

.card-content {
	font-size:20px;
	padding:10px
}

.home .grid .cell-12 {
	margin-bottom:20px;
	margin-left:auto;
	margin-right:auto;
	flex:inherit;
	width:auto
}

.footer {
	background:#1e2226;
	background:linear-gradient(180deg, #1e2226 0%, black 67%);
	margin-top:50px;
	padding:10px;
	color:#838592
}

.footer .grid {
	margin-bottom:0
}

.page {
	min-height:800px;
	margin-top:20px
}
		</style>
		
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	
	<body>
		<header>
			<div class="container">
				<div class="grid">
					<div class="row">
						<div class="cell-10">
							<h2>Skymote</h2>
						</div>
						
						<!--<div class="cell" id="right">
							<a href="#" title="Espace client">Espace client</a>
						</div>-->
					</div>
				</div>
			</div>
			
			<div class="app-bar-wrapper">
				<div class="container pos-relative app-bar" data-role="appbar" data-expand-point="sm">
					<ul class="app-bar-menu">
						<li><a href="/" title="Index">Index</a>
						<li><a href="/isp-list" title="Liste des FAI par pays">Liste des FAI par pays</a>
						<li><a href="/recent-allocations" title="Récentes allocations">Récentes allocations</a>
						<li><a href="/proxys" title="Proxys Socks5">Proxys Socks5</a>
					</ul>
				</div>
			</div>
		</header>
