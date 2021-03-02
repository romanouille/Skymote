<!DOCTYPE html>
<html lang="fr">
	<head>
		<!-- Page Title -->
		<title>VPS - Skymote</title>
		<!-- Meta Data -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?=$pageDescription?>">
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.png">
		<!-- Web Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<!-- ======= Bootstrap CSS ======= -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<!-- ======= Font Awesome CSS ======= -->
		<link rel="stylesheet" href="<?=$config["common"]["static_server"]?>/assets/css/font-awesome.min.css">
		<!-- ======= Magnific Popup CSS ======= -->
		<link rel="stylesheet" href="<?=$config["common"]["static_server"]?>/assets/plugins/magnific-popup/magnific-popup.css">
		<!-- ======= Owl Carousel CSS ======= -->
		<link rel="stylesheet" href="<?=$config["common"]["static_server"]?>/assets/plugins/owlcarousel/owl.carousel.min.css">
		<!-- ======= Main Stylesheet ======= -->
		<link rel="stylesheet" href="<?=$config["common"]["static_server"]?>/assets/css/style.css">
		<!-- ======= Custom Stylesheet ======= -->
		<link rel="stylesheet" href="<?=$config["common"]["static_server"]?>/assets/css/custom.css">
		<meta property="og:type" content="website">
		<meta property="og:url" content="https://skymote.net<?=$_SERVER["REQUEST_URI"]?>">
		<meta property="og:title" content="<?=htmlspecialchars($pageTitle)?> - Skymote">
		<meta property="og:description" content="<?=htmlspecialchars($pageDescription)?>">
		<meta property="og:image" content="https://skymote.net/logo.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw==" crossorigin="anonymous">

		<style>
			.header-main ul li a {
				text-transform:inherit
			}
			
			p, a, th {
				color:#182E56
			}
		</style>
		
<?php
if (!$dev) {
?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-YN4NKDJJJJ"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-YN4NKDJJJJ');
		</script>
		
		<script type="text/javascript">
		_atrk_opts = { atrk_acct:"9uS6u1hNdI20fn", domain:"skymote.net",dynamic: true};
		(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
		</script>
		<noscript><img src="https://certify.alexametrics.com/atrk.gif?account=9uS6u1hNdI20fn" style="display:none" height="1" width="1" alt="" /></noscript>
<?php
}
?>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader">
			<div class="box"></div>
			<div class="box"></div>
			<div class="box"></div>
			<div class="box"></div>
			<div class="box"></div>
			<div class="box"></div>
		</div>
		<!-- End Preloader -->
		<!-- OffCanvas Menu -->
		<!-- Header -->
		<header class="header fixed-top">
			<!-- Header Main -->
			<div class="header-main love-sticky">
				<div class="container">
					<div class="row align-items-center position-relative">
						<div class="col-lg-2 col-sm-3 col-5">
							<!-- Start Logo -->
							<div class="logo">
								<a href="/">
									<img src="<?=$config["common"]["static_server"]?>/assets/img/logo.png" class="main-logo" alt="" style="height:50px">
										<img src="<?=$config["common"]["static_server"]?>/assets/img/sticky-logo.png" class="sticky-logo" alt="" style="height:50px">
								</a>
							</div>
							<!-- End of Logo -->
						</div>
						<div class="col-lg-10 col-sm-9 col-7 d-flex align-items-center justify-content-end position-static">
							<div class="nav-wrapper">
								<!-- Nav -->
								<ul class="nav">
									<li><a href="/" title="Accueil">Accueil</a></li>
									<li><a href="/isp-list" title="Liste des FAI par pays">Liste des FAI par pays</a></li>
									<li><a href="/recent-allocations" title="Récentes allocations">Récentes allocations</a></li>
									<li><a href="/proxys" title="Proxys Socks5">Proxys Socks5</a></li>
									<li><a href="/scans" title="Scans">Scans</a></li>
									<li><a href="/vps" title="VPS">VPS</a></li>
									<li><a href="/account/" title="Espace client">Espace client</a>
								</ul>
								<!-- End Nav -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Header Main -->
		</header>
		<!-- End Header -->
		<div class="banner layer">
			<div class="container">
				<div class="banner-content">