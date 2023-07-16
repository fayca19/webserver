<?php
session_start();

require_once("../../data/congss.php");
$bdd =bdd();
if ($_SESSION['login']){
}
else {header("Location:index.php?erreur=login");}
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
		<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
		<link rel="stylesheet" href="css/screen.css" type="text/css" media="all">
		<script type="text/javascript" src="js/jquery-1.6.js" ></script>
		<script type="text/javascript" src="js/cufon-yui.js"></script>
		<script type="text/javascript" src="js/cufon-replace.js"></script>  
		<script type="text/javascript" src="js/Vegur_300.font.js"></script>
		<script type="text/javascript" src="js/PT_Sans_700.font.js"></script>
		<script type="text/javascript" src="js/PT_Sans_400.font.js"></script>
		<script type="text/javascript" src="js/tms-0.3.js"></script>
		<script type="text/javascript" src="js/tms_presets.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="js/atooltip.jquery.js"></script>
	</head>
	<body id="page1">
		<div class="main">
			<header>
				<nav>
					<ul id="menu">
						<li class="active"><a href="Acceuil"><span>Acceuil</span></a></li>
						<li><a href="Demandes-En-Cours"><span>D.En-Cours</span></a></li>
						<li><a href="Demandes-Classees" ><span>D.Classees</span></a></li>
						<li><a href="Statistique" ><span>Statistique</span></a></li>
						<li class="last"><a href="index.html"><span>Quitter</span></a></li>
					</ul>
				</nav>
				<div id="slider">
					<ul class="items">
						
						<li>
							<img src="images/img2.jpg" alt="">
							<div class="banner">
								<span class="title"><span class="color2">Service Disponible</span><span class="color1">24h/24 - 7j/7</span></span>
								<p><a href="http://www.lalgeriennevie.com" >http://www.lalgeriennevie.com</a></p>
								<a class="button1" onClick="loadLista('contact/contact.php')">Service-Clients</a>
							</div>
						</li>
						<li>
							<img src="images/img1.jpg" alt="">
							<div class="banner">
								<span class="title"><span class="color2">Compte</span><span> prestataire de soins</span></span>
								<a class="button1" onClick="loadLista('contact/compte.php')">Parametres-Compte</a>
							</div>
						</li>
					</ul>
				</div>
			</header>
		</div>
		<script type="text/javascript"> Cufon.now(); </script>
		<script>
			$(window).load(function(){
				$('#slider')._TMS({
					banners:true,
					waitBannerAnimation:false,
					preset:'diagonalFade',
					easing:'easeOutQuad',
					pagination:true,
					duration:400,
					slideshow:8000,
					bannerShow:function(banner){
						banner.css({marginRight:-500}).stop().animate({marginRight:0}, 600)
					},
					bannerHide:function(banner){
						banner.stop().animate({marginRight:-500}, 600)
					}
					})
			})	
		</script>
		<script type="text/javascript" src="js/fct.js"></script>
	</body>
</html>