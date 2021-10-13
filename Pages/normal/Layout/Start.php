<!DOCTYPE html>
<html lang="fr">
	<head>
		<!-- Page Title -->
		<title><?=$pageTitle?> - Skymote</title>
		<!-- Meta Data -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?=$pageDescription?>">
		<!-- Favicon -->
		<link rel="shortcut icon" href="/assets/img/logo.png">
		<!-- Web Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<!-- ======= Bootstrap CSS ======= -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<!-- ======= Font Awesome CSS ======= -->
		<link rel="stylesheet" href="/assets/css/font-awesome.min.css">
		<!-- ======= Magnific Popup CSS ======= -->
		<link rel="stylesheet" href="/assets/plugins/magnific-popup/magnific-popup.css">
		<!-- ======= Owl Carousel CSS ======= -->
		<link rel="stylesheet" href="/assets/plugins/owlcarousel/owl.carousel.min.css">
		<!-- ======= Main Stylesheet ======= -->
		<link rel="stylesheet" href="/assets/css/style.css">
		<!-- ======= Custom Stylesheet ======= -->
		<link rel="stylesheet" href="/assets/css/custom.css">
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
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php
if ($_SERVER["REMOTE_ADDR"] != "127.0.0.1") {
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YN4NKDJJJJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YN4NKDJJJJ');
</script>
<?php
}
?>
	</head>
	<body>
		<!-- Preloader -->
		<!--<div class="preloader">
			<div class="box"></div>
			<div class="box"></div>
			<div class="box"></div>
			<div class="box"></div>
			<div class="box"></div>
			<div class="box"></div>
		</div>-->
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
									<img src="/assets/img/logo.png" class="main-logo" alt="" style="height:50px">
										<img src="/assets/img/logo.png" class="sticky-logo" alt="" style="height:50px">
								</a>
							</div>
							<!-- End of Logo -->
						</div>
						<div class="col-lg-10 col-sm-9 col-7 d-flex align-items-center justify-content-end position-static">
							<div class="nav-wrapper">
								<!-- Nav -->
								<ul class="nav">
									<li><a href="/" title="Home">Home</a>
									<li><a href="/isp-list" title="List of ISPs by country">List of ISPs by country</a>
									<li><a href="/recent-allocations" title="Recent allocations">Recent allocations</a>
									<li><a href="/api" title="API">API</a>
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
					<div class="d-block d-xl-none">
						<div class="alert alert-info">
							This website is not compatible with small screens.<br>In order to display the site tables correctly, we recommend that you display the site on a large screen.
						</div>
					</div>
