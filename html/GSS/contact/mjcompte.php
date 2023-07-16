<?php session_start();

require_once("../../../data/congss.php");
if ($_SESSION['login']){ 
//authentification acceptee !!!
}
else {
header("Location:index.html?erreur=login"); // redirection en cas d'echec
}
$errone = false;
$bdd=bdd();
if (isset($_REQUEST['row']) && isset($_REQUEST['row1']) && isset($_REQUEST['row2']) && isset($_REQUEST['row3']) && isset($_REQUEST['row4'])) {
$nom = $bdd->quote($_REQUEST['row']);
$prenom = $bdd->quote($_REQUEST['row1']);
$login = $bdd->quote($_REQUEST['row2']);
$pass = $bdd->quote($_REQUEST['row3']);
$adresse = $bdd->quote($_REQUEST['row4']);

	$id_user =$_SESSION['id_user'];
$rqt = $bdd->prepare("update `accprest` set nom= $nom , prenom= $prenom , login= $login , pass=sha1($pass), adr_prest=$adresse   where id_user= $id_user") ;
$rqt->execute();

		$_SESSION['login'] = $login; 
		$_SESSION['pass'] = md5($pass); 
		$_SESSION['nom'] = $nom;
		$_SESSION['prenom'] = $prenom;
		$_SESSION['adresse'] = $adresse;

}

?>