<?php
 session_start(); 
 require_once("../../../data/congss.php");
$bdd=bdd();
if ($_SESSION['login']){}
else {
header("Location:../index.html?erreur=login");
} 
$errone = false;


if (isset($_REQUEST['r0'])) {
$code = $bdd->quote($_REQUEST['r0']);


$rqt = $bdd->prepare("UPDATE `demande` SET et_dem='4' WHERE `id_dem` =  $code");
$rqt->execute();

} 
 ?>