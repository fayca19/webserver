<?php
session_start(); 
ob_start();
//error_reporting(0);
require_once("../../data/congss.php");
if (isset($_POST['login']) && isset($_POST['pass'])){
	$login = (($_POST['login']));
	$pass = (sha1(($_POST['pass'])));

     //$bdd =bdd();

	$rqt = $bdd->prepare("SELECT * FROM accprest WHERE login= ? AND pass=?");
	$rqt->execute(array($login,$pass));

    $utilisateur=$rqt->fetch();

	if ($utilisateur) {	
		
		$_SESSION['id_user'] = $utilisateur['id_user']; 
		$_SESSION['login'] = $utilisateur['login']; 
		$_SESSION['pass'] = $utilisateur['pass']; 
		$_SESSION['nom'] = $utilisateur['nom'];
		$_SESSION['prenom'] = $utilisateur['prenom'];
		if($utilisateur['compte']=='A'){ header("Location:Acceuil"); 
		}else{ 
		header("Location:index.html?erreur=login");
		}		
	}
	else { 
		header("Location:index.html?erreur=login");	 
			
		
	}
}
if(isset($_GET['erreur']) && $_GET['erreur'] == 'logout'){ 
	$prenom = $_SESSION['prenom'];
	session_unset("authentification");
	session_destroy();
	header("Location:index.html?erreur=delog&prenom=$prenom");
}

?>


<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>GSS-Login </title>

  <link rel="stylesheet" href="css/resetlog.css">

    <link rel="stylesheet" href="css/stylelog.css" media="screen" type="text/css" />

</head>

<body>
 <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "login")) { // Affiche l'erreur  
	
	echo "<script type="."'text/JavaScript'"."> alert("."'Login ou mot de passe incorrect !'".");  </script>"; 
	}
	?>
<form action="" method="post" name="connect">
  <div class="wrap">
		<div class="avatar">
      <img src="images/gss.png">
		</div>
		<input type="text" id="login"  name="login" placeholder="Utilisateur" required>
		<div class="bar">
			<i></i>
		</div>
		<input type="password" id="pass" name="pass" placeholder="password" required>
		
		<button><input type="submit" class="submit-login" value="Entrer" /></button>
	</div>
</form>
</body>

</html>