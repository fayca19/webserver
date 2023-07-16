<?php
session_start();

require_once("../../data/congss.php");
$bdd=bdd();
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
	</head>
	<body id="page2">
		<div class="main">
			<header>
				<nav>
					<ul id="menu">
						<li><a href="Acceuil"><span>Acceuil</span></a></li>
						<li><a href="Demandes-En-Cours"><span>D.En-Cours</span></a></li>
						<li><a href="Demandes-Classees"><span>D.Classees</span></a></li>
						<li class="active"><a href="Statistique"><span>Statistique</span></a></li>
						<li class="last"><a href="index.html"><span>Quitter</span></a></li>
					</ul>
				</nav>
				<div id="content">
					<script>$("#content").load('etat/etat.php');</script>
				</div>
			</header>
		</div>
		<script type="text/javascript"> Cufon.now(); </script>
		<script>
			
			function loadList(page){
            $("#content").load(page);
                                   }
		</script>
		<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
        <script src="js/jquery/date.js" type="text/javascript"></script>
        <script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
        <script src="js/fct.js" type="text/javascript"></script>
	</body>
</html>