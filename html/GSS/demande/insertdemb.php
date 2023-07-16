<?php
 session_start(); 
 require_once("../../../data/congss.php");
$bdd =bdd();
if ($_SESSION['login']){}
else {
header("Location:../index.html?erreur=login");
} 
$errone = false;


$datesys=date("Y-m-d");

if (isset($_REQUEST['r0']) && isset($_REQUEST['r1']) && isset($_REQUEST['r2']) && isset($_REQUEST['r3']) && isset($_REQUEST['r4']) && isset($_REQUEST['r5']) && isset($_REQUEST['r6']) ) {
$pol = $bdd->quote($_REQUEST['r0']);
$user = $bdd->quote($_REQUEST['r1']);
$adr = $bdd->quote($_REQUEST['r2']);
$act = $bdd->quote($_REQUEST['r3']);
$datact = $bdd->quote($_REQUEST['r4']);
$freel = $bdd->quote($_REQUEST['r5']);
$benef = $bdd->quote($_REQUEST['r6']);
$coef = $bdd->quote($_REQUEST['r7']);
$rqt = $bdd->prepare("INSERT INTO `demande` VALUES ('',$pol,$act,$adr,$benef,$datact,$coef,$freel,'0','0','0','', $user,$datesys,'2099-12-31','2099-12-31','2099-12-31','0','13')");
$rqt->execute();

} 
 ?>