<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="<?=$config["common"]["static_server"]?>/assets/css/bootstrap.min.css">

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
	
	<style>
		.header-main ul li a {
			text-transform:inherit
		}
	</style>
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
<?php
/*
    <div class="offcanvas_menu">
        <div class="offcanvas-overlay fixed-top w-100 h-100"></div>
        <div class="offcanvas-wrapper fixed-top h-100">
            <div class="offcanvas-close position-absolute">
                <i class="fa fa-times"></i>
            </div>

            <div class="offcanvas-content">
                <!-- Widget Logo -->
                <div class="widget widget_logo">
                    <a href="#"><img src="<?=$config["common"]["static_server"]?>/assets/img/offcanvas-logo.png" alt=""></a>
                </div>
                <!-- End Widget Logo -->

                <!-- Widget About -->
                <div class="widget widget_about">
                    <h3 class="widget-title">About us</h3>
                    <p>It takes more than a private internet browser to go incognito. We’ll make your real IP address.</p>
                </div>
                <!-- End Widget About -->

                <!-- Widget IP -->
                <div class="widget widget_ip">
                    <h3 class="widget-title">Your IP Address:</h3>
                    <ul>
                        <li>103.237.76.105</li>
                    </ul>
                </div>
                <!-- End Widget IP -->

                <!-- Widget About -->
                <div class="widget widget_about">
                    <h3 class="widget-title">Your ISP:</h3>
                    <p>KS Network Limited</p>
                </div>
                <!-- End Widget About -->

                <!-- Widget  Contact -->
                <div class="widget widget_contact">
                    <h3 class="widget-title">Get In Touch</h3>
                    <ul>
                        <li>
                            <span class="icon">
                                <i class="fa fa-envelope"></i>
                            </span> 
                            <a href="mailto:Your@gmail.com">Your@gmail.com</a>
                        </li>
                        <li>
                            <span class="icon">
                                <i class="fa fa-phone"></i>
                            </span> 
                            <a href="callto:(202)2555421">(202) 255 5421</a>
                        </li>
                        <li>
                            <span class="icon">
                                <i class="fa fa-map-signs"></i>
                            </span>27 Division St, New York NY 10002, USA
                        </li> 
                    </ul>
                </div>
                <!-- End Widget Contact -->
            </div>

            <!-- Widget Social Icon -->
            <div class="widget widget_social_links border-top mt-5">
                <!-- <h3 class="widget-title">Follow Us On:</h3> -->
                <div class="social-links">
                    <a class="d-inline-flex align-items-center justify-content-center" href="https://www.facebook.com">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a class="d-inline-flex align-items-center justify-content-center" href="https://twitter.com/">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a class="d-inline-flex align-items-center justify-content-center" href="https://www.linkedin.com">
                        <i class="fa fa-linkedin"></i>
                    </a>
                    <a class="d-inline-flex align-items-center justify-content-center" href="https://www.instagram.com/">
                        <i class="fa fa-instagram"></i>
                    </a>
                </div>
            </div>
            <!-- End Widget Social Icon -->
        </div>
    </div>
    <!-- End OffCanvas Menu -->
*/
?>

    <!-- Header -->
    <header class="header fixed-top">
        <!-- Header Main -->
        <div class="header-main love-sticky">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="col-lg-2 col-sm-3 col-5">
                        <!-- Start Logo -->
                        <div class="logo">
                            <a href="index.html">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/logo.png" class="main-logo" alt="">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/sticky-logo.png" class="sticky-logo" alt="">
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
								<li><a href="/vps" title="VPS Debian">VPS Debian</a></li>
								<li><a href="/scans" title="Scans">Scans</a></li>
                            </ul>
                            <!-- End Nav -->
                        </div>
<?php
/*
                        <div class="d-flex align-items-center mr-2 mr-sm-4">
                            <!-- Search -->
                            <div class="search-toggle ml-sm-2 mr-2 mr-sm-3">
                                <button class="search-toggle-btn">
                                    <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/search.svg" alt="" class="svg">
                                </button>

                                <div class="full-page-search">
                                    <button class="search-close-btn">
                                        <i class="fa fa-times"></i>
                                    </button>

                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8">
                                                <div class="search-form p-5">
                                                    <form action="#">
                                                        <div class="dvpn_input-wrapper">
                                                            <input type="text" placeholder="Enter Your Keyword" name="s" required>
                                                            <span class="input-icon">
                                                                <i class="fa fa-search"></i>
                                                            </span>
                                                        </div>

                                                        <div class="btn-wrap">
                                                            <span></span>
                                                            <button type="submit" class="btn">SEARCH</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search -->

                            <!-- Language -->
                            <div class="flag-dropdown">
                                <button class="dropdown-btn d-flex align-items-center" data-toggle="dropdown">
                                    <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/flag.png" alt="" class="flag">
                                    <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/down-arrow.svg" alt="" class="svg arrow">
                                </button>

                                <ul class="dropdown-menu">
                                    <li><a href="#"><img src="<?=$config["common"]["static_server"]?>/assets/img/icons/flag1.png" alt=""></a></li>
                                    <li><a href="#"><img src="<?=$config["common"]["static_server"]?>/assets/img/icons/flag2.png" alt=""></a></li>
                                    <li><a href="#"><img src="<?=$config["common"]["static_server"]?>/assets/img/icons/flag3.png" alt=""></a></li>
                                    <li><a href="#"><img src="<?=$config["common"]["static_server"]?>/assets/img/icons/flag4.png" alt=""></a></li>
                                    <li><a href="#"><img src="<?=$config["common"]["static_server"]?>/assets/img/icons/flag5.png" alt=""></a></li>
                                    <li><a href="#"><img src="<?=$config["common"]["static_server"]?>/assets/img/icons/flag6.png" alt=""></a></li>
                                </ul>
                            </div>
                            <!-- End Language -->
                        </div>

                        <!-- Menu Trigger -->
                        <div class="offcanvas-trigger ml-2 mr-2 mr-sm-0">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <!-- End Menu Trigger -->

*/
?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Main -->
    </header>
    <!-- End Header -->

    <!-- Banner -->
    <div class="banner layer">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <!-- Banner Content -->
                    <div class="banner-content">
                        <h1>VPS Debian</h1>
                        <p>Un VPS est la meilleure transition entre un hébergement mutualisé et un serveur dédié.</p>

                        <div class="banner-btn-group">
                            <div class="btn-wrap">
                                <span></span>
                                <a href="#prices" class="btn btn-white">Voir les offres</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Banner Content -->
                </div>
                <div class="col-lg-5">
                    <!-- Banner IMG -->
                    <div class="banner-img d-none d-xl-block">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/main-img.png" alt="main img" data-rjs="2" class="main-img">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/setting.png" alt="setting" data-rjs="2" class="setting-img">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/sheild.png" alt="sheild" data-rjs="2" class="sheild-img">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/lock.png" alt="lock" data-rjs="2" class="lock-img">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/card.png" alt="card" data-rjs="2" class="card-img">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/box.png" alt="box" data-rjs="2" class="box-img">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/check.png" alt="check" data-rjs="2" class="check-img">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/setting2.png" alt="setting2" data-rjs="2" class="setting2-img">
                    </div>
                    <!-- End Banner IMG -->

                    <!-- Banner IMG Responsive -->
                    <div class="banner-img-responsive d-block d-xl-none">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/banner-img.png" data-rjs="2" alt="">
                    </div>
                    <!-- End Banner IMG Responsive -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner -->

    <!-- Feature -->
    <section class="feature pt-120 pb-90" data-bg-img="<?=$config["common"]["static_server"]?>/assets/img/media/feature-bg.png">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Title -->
                    <div class="section-title title-shape text-center">
                        <h2>Caractéristiques</h2>
                        <p>Chaque VPS possède des caractéristiques qui lui sont propres.</p>
                    </div>
                    <!-- End Section Title -->
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <!-- Single Feature -->
                    <div class="single-feature">
                        <div class="feature-icon">
                            <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/easy_download_icon.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h3>Débit Internet 500Mbps mutualisé</h3>
                            <p>Chaque hyperviseur partage 500Mbps de débit Internet entre ses VPS.</p>
                        </div>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Feature -->
                    <div class="single-feature two">
                        <div class="feature-icon">
                            <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/instant_setup_icon.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h3>Activation immédiate</h3>
                            <p>Une fois le paiement effectué, le VPS est utilisable immédiatement.</p>
                        </div>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Feature -->
                    <div class="single-feature three">
                        <div class="feature-icon">
                            <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/enjoy_wordwide_icon.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h3>Bloc IPv4</h3>
                            <p>Un bloc IPv4 /29 (8 adresses) est fourni avec chaque VPS.</p>
                        </div>
                    </div>
                    <!-- End Single Feature -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Feature -->
<?php
/*
    <!-- Solutions -->
    <section class="solution layer section-bg pt-120 pb-120" data-bg-img="<?=$config["common"]["static_server"]?>/assets/img/media/solution-bg.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="solution-img d-none d-xl-block">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/s_main.png" data-rjs="2" alt="">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/man.png" data-rjs="2" alt="man" class="s_man">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/woman.png" data-rjs="2" alt="woman" class="s_woman">
                    </div>
                    <div class="solution-img-responsive d-xl-none">
                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/solution-img.png" data-rjs="2" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="solution-content">
                        <!-- Section Title -->
                        <div class="section-title style--two text-left title-shape">
                            <h2>Yours simple solutions <br>online privacy.</h2>
                            <p>These speeds are its excellent. It’s rare that a "dvpn" fast connection
                                speeds across its network. Private Internet its Access is the leadings
                                provide service provider.</p>
                        </div>
                        <!-- End Section Title -->

                        <!-- Single Solution -->
                        <div class="single-solution media align-items-center">
                            <div class="img">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/editor.png" alt="">
                            </div> 
                            <div class="content media-body"> 
                                <h3>Government User</h3>
                                <p>Security providing you safety on the internet trice worldwide access in 47+ countries.</p> 
                            </div> 
                        </div>
                        <!-- End Single Solution -->

                        <!-- Single Solution -->
                        <div class="single-solution media align-items-center">
                            <div class="img style--two">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/eye.png" alt="">
                            </div> 
                            <div class="content media-body"> 
                                <h3>Hidden Hackers</h3>
                                <p>Vecurity providing you safety on the internet trice
                                    worldwide access in 36+ countries.</p> 
                            </div> 
                        </div>
                        <!-- End Single Solution -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Solutions -->

    <!-- Service -->
    <section class="service pt-120 pb-90" data-bg-img="<?=$config["common"]["static_server"]?>/assets/img/media/service-bg.png">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Title -->
                    <div class="section-title title-shape text-center">
                        <h2>Valuable Service</h2>
                        <p>These speeds are excellent. It’s rare that a fast connection safety <br />
                            Internet leading speeds across its network.</p>
                    </div>
                    <!-- End Section Title -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Single Service -->
                    <div class="single-service hover-effect">
                        <div class="service-icon">
                            <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/services_icon1.png" alt="">
                        </div>

                        <div class="service-content">
                            <a href="service-details.html"><h3>Free Services</h3></a>
                            <p>Private Internet the leading create <br>the security providing safety.</p>
                            <a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>
                        </div>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Service -->
                    <div class="single-service hover-effect two">
                        <div class="service-icon">
                            <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/services_icon2.png" alt="">
                        </div>

                        <div class="service-content">
                            <a href="service-details.html"><h3>Premium Services</h3></a>
                            <p>Private Internet the leading create <br>the security providing safety.</p>
                            <a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>
                        </div>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Service -->
                    <div class="single-service hover-effect three">
                        <div class="service-icon">
                            <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/services_icon3.png" alt="">
                        </div>

                        <div class="service-content">
                            <a href="service-details.html"><h3>Gigabit Service</h3></a>
                            <p>Private Internet the leading create <br>the security providing safety.</p>
                            <a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>
                        </div>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Service -->
                    <div class="single-service hover-effect four">
                        <div class="service-icon">
                            <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/services_icon4.png" alt="">
                        </div>

                        <div class="service-content">
                            <a href="service-details.html"><h3>Instant Setups</h3></a>
                            <p>Private Internet the leading create <br>the security providing safety.</p>
                            <a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>
                        </div>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Service -->
                    <div class="single-service hover-effect five">
                        <div class="service-icon">
                            <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/services_icon5.png" alt="">
                        </div>

                        <div class="service-content">
                            <a href="service-details.html"><h3>No Traffic Logs</h3></a>
                            <p>Private Internet the leading create <br>the security providing safety.</p>
                            <a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>
                        </div>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Service -->
                    <div class="single-service hover-effect six">
                        <div class="service-icon">
                            <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/services_icon6.png" alt="">
                        </div>

                        <div class="service-content">
                            <a href="service-details.html"><h3>No Hidden Price</h3></a>
                            <p>Private Internet the leading create <br>the security providing safety.</p>
                            <a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>
                        </div>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Service -->
*/
?>
    <!-- Pricing -->
    <section class="pricing gradient-bg position-relative pt-120 pb-90" id="prices">
        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/price-bg.png" alt="" class="section-pattern-img">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Title -->
                    <div class="section-title text-white title-shape title-shape-style-two text-center">
                        <h2>Offres</h2>
                    </div>
                    <!-- End Section Title -->
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <!-- Single Price -->
                    <!--<div class="single-price">
                        <div class="price-head">
                            <h4>Monthly</h4>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="value">3.66</span>
                                <span class="duration">/MO</span>
                            </div>
                            <h6>Save 42%</h6>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li>
                                    <del>$143.88</del>
                                    <strong>&nbsp; &nbsp;$83.88</strong>
                                </li>
                                <li>build payment every years</li>
                                <li>24/7 active support</li>
                            </ul>
                            <div class="btn-wrap">
                                <span></span>
                                <a href="#" class="btn btn-sm">Get IT NOW</a>
                            </div>
                        </div>
                    </div>-->
                    <!-- End Single Price -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Price -->
                    <div class="single-price active">
                        <!--<h4 class="ribbon">Best Deal</h4>-->
                        <div class="price-head">
                            <h4>Mensuel</h4>
                            <div class="price">
                                <span class="value">19,99</span>
								<span class="currency">€</span>
                                <span class="duration">/mois</span>
                            </div>
                            <!--<h6>Save 58%</h6>-->
                        </div>
                        <div class="price-body">
                            <ul>
                                <!--<li>
                                    <del>$432.64</del>
                                    <strong>&nbsp; &nbsp;$143.65</strong>
                                </li>-->
                                <li>8 coeurs CPU @ 2.4GHz
								<li>32 Go RAM DDR4 ECC
								<li>50 Go SSD NVMe
								<li>500Mbps best-effort
								<li>/29 (8 adresses IPv4)
								<li>Virtualisation KVM
								<li>Debian
                            </ul>
                            <div class="btn-wrap">
                                <span></span>
                                <a href="/account/buy/init?product=1" class="btn btn-sm">Commander</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Price -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Price -->
                    <!--<div class="single-price">
                        <div class="price-head">
                            <h4>Monthly</h4>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="value">6.66</span>
                                <span class="duration">/MO</span>
                            </div>
                            <h6>Save 67%</h6>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li>
                                    <del>$560.69</del>
                                    <strong>&nbsp; &nbsp;$214.69</strong>
                                </li>
                                <li>build payment every years</li>
                                <li>24/7 active support</li>
                            </ul>
                            <div class="btn-wrap">
                                <span></span>
                                <a href="#" class="btn btn-sm">Get IT NOW</a>
                            </div>
                        </div>
                    </div>-->
                    <!-- End Single Price -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing -->

<?php
/*
    <!-- Team -->
    <section class="team pt-120 pb-140" data-bg-img="<?=$config["common"]["static_server"]?>/assets/img/media/price-bg.png">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Title -->
                    <div class="section-title title-shape text-center">
                        <h2>Service Team</h2>
                        <p>These speeds are excellent. It’s rare that a fast connection safety <br />
                            Internet leading speeds across its network.</p>
                    </div>
                    <!-- End Section Title -->
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="team-carousel owl-carousel" data-owl-margin="30" data-owl-dots="true" data-owl-autoplay="true" data-owl-responsive='{"0": {"items": "1"}, "576": {"items": "2"}, "992": {"items": "3"}}'>
                        
                        <!-- Single Team -->
                        <div class="single-team text-center">
                            <!-- Member Img -->
                            <div class="member-img">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/media/team_img1.png" data-rjs="2" alt="">
                                <a href="#" target="_blank" class="btn-rounded">
                                    <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/arrow-right.svg" alt="" class="svg">
                                </a>
                            </div>
                            <!-- End Member Img -->
    
                            <!-- Member Details -->
                            <div class="member-details">
                                <h3>Michael Niotakis</h3>
                                <p>Service Holder</p>
                            </div>
                            <!-- End Member Details -->
    
                            <!-- Social Links -->
                            <div class="social-links">
                                <a href="https://dribbble.com/" target="_blank"><i class="fa fa-dribbble"></i></a>
                                <a href="http://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="http://linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <!-- End Social Links -->
                        </div>
                        <!-- End Single Team -->
                        
                        <!-- Single Team -->
                        <div class="single-team text-center">
                            <!-- Member Img -->
                            <div class="member-img">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/media/team_img2.png" alt="" data-rjs="2" class="img-fluid">
                                <a href="#" target="_blank" class="btn-rounded">
                                    <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/arrow-right.svg" alt="" class="svg">
                                </a>
                            </div>
                            <!-- End Member Img -->
    
                            <!-- Member Details -->
                            <div class="member-details">
                                <h3>Lisa O’Keeffe</h3>
                                <p>App Designer</p>
                            </div>
                            <!-- End Member Details -->
    
                            <!-- Social Links -->
                            <div class="social-links">
                                <a href="https://dribbble.com/" target="_blank"><i class="fa fa-dribbble"></i></a>
                                <a href="http://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="http://linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <!-- End Social Links -->
                        </div>
                        <!-- End Single Team -->
                        
                        <!-- Single Team -->
                        <div class="single-team text-center">
                            <!-- Member Img -->
                            <div class="member-img">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/media/team_img3.png" data-rjs="2" alt="" class="img-fluid">
                                <a href="#" target="_blank" class="btn-rounded">
                                    <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/arrow-right.svg" alt="" class="svg">
                                </a>
                            </div>
                            <!-- End Member Img -->
    
                            <!-- Member Details -->
                            <div class="member-details">
                                <h3>Michael O’Kentd</h3>
                                <p>UX Designer</p>
                            </div>
                            <!-- End Member Details -->
    
                            <!-- Social Links -->
                            <div class="social-links">
                                <a href="https://dribbble.com/" target="_blank"><i class="fa fa-dribbble"></i></a>
                                <a href="http://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="http://linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <!-- End Social Links -->
                        </div>
                        <!-- End Single Team -->
                        
                        <!-- Single Team -->
                        <div class="single-team text-center">
                            <!-- Member Img -->
                            <div class="member-img">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/media/team_img3.png" alt="" data-rjs="2" class="img-fluid">
                                <a href="#" target="_blank" class="btn-rounded">
                                    <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/arrow-right.svg" alt="" class="svg">
                                </a>
                            </div>
                            <!-- End Member Img -->
    
                            <!-- Member Details -->
                            <div class="member-details">
                                <h3>Michael O’Kentd</h3>
                                <p>UX Designer</p>
                            </div>
                            <!-- End Member Details -->
    
                            <!-- Social Links -->
                            <div class="social-links">
                                <a href="https://dribbble.com/" target="_blank"><i class="fa fa-dribbble"></i></a>
                                <a href="http://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="http://linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <!-- End Social Links -->
                        </div>
                        <!-- End Single Team -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Team -->

    <!-- Testimonial -->
    <section class="testimonial section-bg pt-120 pb-140" data-bg-img="<?=$config["common"]["static_server"]?>/assets/img/media/testimonial-bg.png">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Title -->
                    <div class="section-title title-shape text-center">
                        <h2>Customer Feedback</h2>
                        <p>These speeds are excellent. It’s rare that a fast connection safety <br />
                            Internet leading speeds across its network.</p>
                    </div>
                    <!-- End Section Title -->
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="testimonial-carousel owl-carousel" data-owl-items="2" data-owl-margin="40" data-owl-dots="true" data-owl-autoplay="true" data-owl-responsive='{"0": {"items": "1"}, "991": {"items": "2"}}'>
                        
                        <!-- Single Testimonial -->
                        <div class="single-testimonial">
                            <!-- Quote -->
                            <div class="quote">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/quote.svg" alt="" class="svg">
                            </div>
                            <!-- End Quote -->
                            
                            <div class="testimonial-content">
                                <p>Program easy to use, I feel very safe, very affordable the I can watchs my favorites shows France its the America problem whatsoever to offer that others.</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="media review-info align-items-center">
                                    <div class="testimonial-img">
                                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/testimonial_1-2.png" data-rjs="2" alt="">
                                    </div>
                                    
                                    <div class="testimonial-name">
                                        <h4>William Blake</h4>
                                        <span>Co-Founder</span>
                                    </div>
                                </div>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Testimonial -->

                        <!-- Single Testimonial -->
                        <div class="single-testimonial">
                            <!-- Quote -->
                            <div class="quote">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/quote.svg" alt="" class="svg">
                            </div>
                            <!-- End Quote -->
                            
                            <div class="testimonial-content">
                                <p>Program easy to use, I feel very safe, very affordable the I can watchs my favorites shows France its the America problem whatsoever to offer that others.</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="media review-info align-items-center">
                                    <div class="testimonial-img">
                                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/testimonial_2.png" data-rjs="2" alt="">
                                    </div>
                                    
                                    <div class="testimonial-name">
                                        <h4>Ben Horowitz</h4>
                                        <span>Chief Officer</span>
                                    </div>
                                </div>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Testimonial -->

                        <!-- Single Testimonial -->
                        <div class="single-testimonial">
                            <!-- Quote -->
                            <div class="quote">
                                <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/quote.svg" alt="" class="svg">
                            </div>
                            <!-- End Quote -->
                            
                            <div class="testimonial-content">
                                <p>Program easy to use, I feel very safe, very affordable the I can watchs my favorites shows France its the America problem whatsoever to offer that others.</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="media review-info align-items-center">
                                    <div class="testimonial-img">
                                        <img src="<?=$config["common"]["static_server"]?>/assets/img/media/testimonial_3.png" data-rjs="2" alt="">
                                    </div>
                                    
                                    <div class="testimonial-name">
                                        <h4>Ben Horowitz</h4>
                                        <span>Project Manager</span>
                                    </div>
                                </div>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Testimonial -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonial -->

    <!-- Blog -->
    <section class="blog pt-120 pb-90" data-bg-img="<?=$config["common"]["static_server"]?>/assets/img/media/blog-bg.png">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Title -->
                    <div class="section-title title-shape text-center">
                        <h2>Latest News</h2>
                        <p>These speeds are excellent. It’s rare that a fast connection safety <br />
                            Internet leading speeds across its network.</p>
                    </div>
                    <!-- End Section Title -->
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Single Blog -->
                            <div class="single-blog">
                                <!-- Blog Image -->
                                <a href="blog-details.html" class="blog-img">
                                    <img src="<?=$config["common"]["static_server"]?>/assets/img/blog/blog_img.png" alt="" data-rjs="2" class="img-fluid">
                                </a>
                                <!-- End Blog Image -->
                                
                                <!-- Blog Content -->
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="#" class="posted">18 July</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <h3><a href="blog-details.html">One Security Solutions</a></h3>
                                    <p>She travelling acceptance men unpleasant her especially to</p>
                                    <a href="blog-details.html" class="btn-link">Read More <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>
                                </div>
                                <!-- End Blog Content -->
                            </div>
                            <!-- End Single Blog -->
                        </div>
                        <div class="col-md-6">
                            <!-- Single Blog -->
                            <div class="single-blog">
                                <!-- Blog Image -->
                                <a href="blog-details.html" class="blog-img">
                                    <img src="<?=$config["common"]["static_server"]?>/assets/img/blog/blog_img2.png" alt="" data-rjs="2" class="img-fluid">
                                </a>
                                <!-- End Blog Image -->
                                
                                <!-- Blog Content -->
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="#" class="posted">18 July</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <h3><a href="blog-details.html">Available to Presence</a></h3>
                                    <p>She travelling acceptance men unpleasant her especially to</p>
                                    <a href="blog-details.html" class="btn-link">Read More <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>
                                </div>
                                <!-- End Blog Content -->
                            </div>
                            <!-- End Single Blog -->
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- News Letter Form Wrapper -->
                    <div class="news-letter-form-wrapper text-center">
                        <h3>Get Newsletter</h3>
                        <p>Yes, I would like receive Salesforce Weekly Brief as well marketings its thats the forefront of the industry unsubscribe any time.</p>
                        <!-- Start News Letter Form -->
                        <div class="newsletter-form">
                            <form action="https://themelooks.us13.list-manage.com/subscribe/post?u=79f0b132ec25ee223bb41835f&id=f4e0e93d1d" method="post" target="_blank" id="subscribe_submit">
                                <div class="dvpn_input-wrapper">
                                    <input class="sectsubscribe-email" type="email" placeholder="Enter email address" required>
                                </div>
                                <div class="btn-wrap w-100 d-block">
                                    <span></span>
                                    <button name="sectsubscribe" class="btn btn-white w-100 d-block" type="submit">SUBSCRIBE </button>
                                </div>
                            </form>
                        </div>
                        <!-- End of News Letter Form -->
                    </div>
                    <!-- End News Letter Form Wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog -->
*/
?>
    <!-- Footer -->
    <footer class="footer">
        <!-- Footer Background Shape -->
        <div class="footer-bg-shape"></div>
        <!-- End Footer Background Shape -->

        <!-- Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <!-- Widget Contact -->
                        <div class="widget widget_contact">
                            <!-- About Widget Start -->
                            <h3 class="widget-title">Contact</h3>
                            <ul>
                                <li>
                                    <span class="icon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <a href="mailto:contact@skymote.net">contact@skymote.net</a>
                                </li>
                            </ul>

                            <!-- Social Links -->
                            <!--<div class="social-links style--two mt-4">
                                <a href="https://www.facebook.com">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="https://twitter.com/">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                                <a href="https://www.instagram.com/">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </div>-->
                            <!-- End Social Links -->
                        </div>
                        <!-- End Widget Contact -->
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <!--<div class="widget widget_nav_menu">
                            <h3 class="widget-title">Services</h3>
                            <div class="menu-dvpn-container">
                                <ul class="menu">
                                    <li><a href="#">Pricing</a></li>
                                    <li><a href="#">vpn protocol</a></li>
                                    <li><a href="#">VPN Servers</a></li>
                                    <li><a href="#">reviews</a></li>
                                    <li><a href="#">contact us</a></li>
                                </ul>
                            </div>
                        </div>-->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <!--<div class="widget widget_nav_menu">
                            <h3 class="widget-title">Solutions</h3>
                            <div class="menu-dvpn-container">
                                <ul class="menu">
                                    <li><a href="#">Stream Services</a></li>
                                    <li><a href="#">Stream sports</a></li>
                                    <li><a href="#">dvpn VPN</a></li>
                                    <li><a href="#">Fire Stick VPN</a></li>
                                    <li><a href="#">VPN for teams</a></li>
                                </ul>
                            </div>
                        </div>-->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <!--<div class="widget widget_recent_entries">
                            <h3 class="widget-title">Recent Articles</h3>
                            <ul>
                                <li>
                                    <span class="posted-on">
                                        <i class="fa fa-calendar"></i>
                                        <a href="#">18 July 2020</a>
                                    </span>
                                    <h4 class="post-title">
                                        <a href="#">Hong Kong VPN searches Here’s what it means.</a>
                                    </h4>
                                </li>
                                <li>
                                    <span class="posted-on">
                                        <i class="fa fa-calendar"></i>
                                        <a href="#">20 July 2020</a>
                                    </span>
                                    <h4 class="post-title">
                                        <a href="#">Hong Kong VPN searches Here’s what it means.</a>
                                    </h4>
                                </li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom-text text-center">
							En naviguant sur ce site, vous acceptez le stockage de cookies sur votre périphérique à des fins de statistiques.<br>
							<a href="/legal" title="Mentions légales">Mentions légales</a><br><br>
							
							<a href="https://www.abuseipdb.com/user/11790" title="AbuseIPDB is an IP address blacklist for webmasters and sysadmins to report IP addresses engaging in abusive behavior on their networks" alt="AbuseIPDB Contributor Badge">
								<img src="https://www.abuseipdb.com/contributor/11790.svg" style="width: 190px;background: #35c246 linear-gradient(rgba(255,255,255,0), rgba(255,255,255,.3) 50%, rgba(0,0,0,.2) 51%, rgba(0,0,0,0));padding: 5px;">
							</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!-- End Footer -->

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- ======= jQuery Library ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/js/jquery.min.js"></script>
    
    <!-- ======= Bootstrap Bundle JS ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/js/bootstrap.bundle.min.js"></script>

    <!-- =======  Mobile Menu JS ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/js/menu.min.js"></script>

    <!-- ======= Owl Carousel JS ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/plugins/owlcarousel/owl.carousel.min.js"></script>

    <!-- ======= Retina JS ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/plugins/retinajs/retina.min.js"></script>

    <!-- ======= Magnific Popup JS ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- ======= Waypoints JS ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/plugins/counterup/waypoints.min.js"></script>

    <!-- ======= Counter UP JS ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/plugins/counterup/jquery.counterup.min.js"></script>

    <!-- ======= Count Down Timer JS ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/plugins/countdown-timer/countdown.min.js"></script>

    <!-- ======= Google API ======= -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjkssBA3hMeFtClgslO2clWFR6bRraGz0"></script>

    <!-- ======= Main JS ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/js/main.js"></script>
    
    <!-- ======= Custom JS ======= -->
    <script src="<?=$config["common"]["static_server"]?>/assets/js/custom.js"></script>
</body>
</html>