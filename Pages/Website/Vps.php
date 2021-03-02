<?php
require "Pages/Website/Layout/Start.php";
?>
<div class="row">
	<div class="col-lg-7">
		<!-- Banner Content -->
		<div class="banner-content">
			<h1>Serveurs privés virtuels</h1>
			<p>Découvrez nos offres de VPS LXC à partir de 9.99€/mois.</p>
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
						<h3>Accès root</h3>
						<p>Nous vous fournissons le compte root de votre VPS, vous donnant un contrôle total de celui-ci.</p>
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
						<h3>Livraison automatique</h3>
						<p>Les VPS sont livrés automatiquement après le paiement.</p>
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
						<h3>Disques SSD NVMe</h3>
						<p>Nous utilisons uniquement des disques SSD NVMe, plus rapides que des SSD traditionnels.</p>
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
					<h2>Choisissez entre <b>17 localisations</b> différentes</h2>
					<p>Hébergez votre VPS au plus proche de vos clients et améliorez la latence entre vous et vos applications.</p>
				</div>
				<!-- End Section Title -->
				<!-- Single Solution -->
				<div class="single-solution media align-items-center">
					<div class="img">
						<img src="<?=$config["common"]["static_server"]?>/assets/img/icons/editor.png" alt="">
					</div>
					<div class="content media-body">
						<h3>Multiples distributions</h3>
						<p>Nous fournissons de multiples distributions Linux/Windows telles que CentOS, Debian, Fedora, FreeBSD, OpenBSD, Ubuntu, Windows Server...</p>
					</div>
				</div>
				<!-- End Single Solution -->
				<!-- Single Solution -->
				<div class="single-solution media align-items-center">
					<div class="img style--two">
						<img src="<?=$config["common"]["static_server"]?>/assets/img/icons/eye.png" alt="">
					</div>
					<div class="content media-body">
						<h3>Évolutivité</h3>
						<p>Vous pouvez à tout moment passer à une offre supérieure si nécessaire.</p>
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
					<h2>Options complémentaires</h2>
					<p>Nous fournissons en option des solutions complémentaires pour vos VPS.</p>
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
						<a href="service-details.html">
							<h3>Sauvegardes</h3>
						</a>
						<p>Bénéficiez de sauvegardes automatiques de vos VPS.</p>
						<!--<a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>-->
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
						<a href="service-details.html">
							<h3>Snapshots</h3>
						</a>
						<p>Créez des instantanés de vos VPS, revenez en arrière à tout moment.</p>
						<!--<a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>-->
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
						<a href="service-details.html">
							<h3>Pare-feu</h3>
						</a>
						<p>Créez des règles firewall directement en amont de vos VPS.</p>
						<!--<a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>-->
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
						<a href="service-details.html">
							<h3>IPv4 supplémentaires</h3>
						</a>
						<p>Ajoutez jusqu'à 2 IPv4 supplémentaires par VPS.</p>
						<!--<a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>-->
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
						<a href="service-details.html">
							<h3>Anti-DDoS</h3>
						</a>
						<p>Disposez d'un anti-DDoS additionnel de 10Gbps.</p>
						<!--<a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>-->
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
						<a href="service-details.html">
							<h3>Réseaux privés</h3>
						</a>
						<p>Créez des réseaux privés entre vos VPS.</p>
						<!--<a class="btn-link" href="service-details.html">READ MORE <img src="<?=$config["common"]["static_server"]?>/assets/img/icons/right-arrow.svg" alt="" class="svg"></a>-->
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
				<div class="single-price active">
					<!--<h4 class="ribbon">Best Deal</h4>-->
					<div class="price-head">
						<h4>Mensuel</h4>
						<div class="price">
							<span class="value">9.99</span>
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
							<li>4 coeurs CPU @ 2.4GHz
							<li>8 Go RAM DDR4 ECC
							<li>50 Go SSD NVMe
							<li>100Mbps best-effort
							<li>1x IPv4
							<li>Virtualisation LXC
							<li>Debian 10
						</ul>
						<div class="btn-wrap">
							<span></span>
<?php
if (Server::isAvailable(1)) {
?>
							<a href="/account/buy/init?product=1" class="btn btn-sm">Commander</a>
<?php
} else {
?>
							<a href="#" class="btn btn-sm">Indisponible</a>
<?php
}
?>
						</div>
					</div>
				</div>
				<!-- End Single Price -->
			</div>
			<div class="col-lg-4 col-md-6">
				<!-- Single Price -->
				<div class="single-price active">
					<!--<h4 class="ribbon">Best Deal</h4>-->
					<div class="price-head">
						<h4>Mensuel</h4>
						<div class="price">
							<span class="value">19.99</span>
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
							<li>16 Go RAM DDR4 ECC
							<li>100 Go SSD NVMe
							<li>100Mbps best-effort
							<li>1x IPv4
							<li>Virtualisation LXC
							<li>Debian 10
						</ul>
						<div class="btn-wrap">
							<span></span>
<?php
if (Server::isAvailable(2)) {
?>
							<a href="/account/buy/init?product=3" class="btn btn-sm">Commander</a>
<?php
} else {
?>
							<a href="#" class="btn btn-sm">Indisponible</a>
<?php
}
?>
						</div>
					</div>
				</div>
				<!-- End Single Price -->
			</div>
			<div class="col-lg-4 col-md-6">
				<!-- Single Price -->
				<div class="single-price active">
					<!--<h4 class="ribbon">Best Deal</h4>-->
					<div class="price-head">
						<h4>Mensuel</h4>
						<div class="price">
							<span class="value">29.99</span>
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
							<li>16 coeurs CPU @ 2.4GHz
							<li>32 Go RAM DDR4 ECC
							<li>250 Go SSD NVMe
							<li>100Mbps best-effort
							<li>1x IPv4
							<li>Virtualisation LXC
							<li>Debian 10
						</ul>
						<div class="btn-wrap">
							<span></span>
<?php
if (Server::isAvailable(3)) {
?>
							<a href="/account/buy/init?product=5" class="btn btn-sm">Commander</a>
<?php
} else {
?>
							<a href="#" class="btn btn-sm">Indisponible</a>
<?php
}
?>
						</div>
					</div>
				</div>
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
					Internet leading speeds across its network.
				</p>
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
						Internet leading speeds across its network.
					</p>
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
						Internet leading speeds across its network.
					</p>
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
<?php
require "Pages/Website/Layout/End.php";