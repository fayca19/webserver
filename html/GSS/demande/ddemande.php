<?php
 session_start(); 
 require_once("../../../data/congss.php");
$bdd=bdd();
if ($_SESSION['login']){}
else {
header("Location:../index.html?erreur=login");
} 
$errone = false;

$datesys=date("Y-m-d");
if (isset($_REQUEST['r0'])) {
$code = $bdd->quote($_REQUEST['r0']);


$rqt = $bdd->prepare("UPDATE `demande` SET et_dem='3', mot_dem='Sans-Suite', date_adem= '$datesys'  WHERE `id_dem` =  $code");
$rqt->execute();

} 
 ?>