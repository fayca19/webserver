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
$id_pol="";
$id_act="";
$id_adr="";
$id_benef="";
$mtt_remb="";
// on recupere la demande
$rqtd = $bdd->prepare("SELECT * FROM `demande` WHERE `id_dem` =  $code");
$rqtd->execute();
while ($row_dem=$rqtd->fetch()){
$id_pol=$row_dem['id_pol'];
$id_act=$row_dem['id_act'];
$id_adr=$row_dem['id_adr'];
$id_benef=$row_dem['id_benef'];
$mtt_remb=$row_dem['mtt_remb'];
}
//On verifie si il existe deja une consommation
$rqtc = $bdd->prepare("SELECT * FROM `consom` WHERE `id_pol` = $id_pol AND `id_adr` = $id_adr AND `id_act` = $id_act AND `id_benef` = $id_benef");
$rqtc->execute();
$nb = $rqtc->rowCount();

if ($nb!=0){
// consomation existante donc M a j
//on doit recuperer la consommation existante
while ($row_con=$rqtc->fetch()){
$p_act_adr=$row_con['p_act_adr'];
$n_act_adr=$row_con['n_act_adr'];
}
// on incremente les valeur
$nombre=$n_act_adr+1;
$plafond=$p_act_adr+$mtt_remb;
// on met à jour la consommation!!
$rqtup = $bdd->prepare("UPDATE  `consom` SET p_act_adr= $plafond,n_act_adr=$nombre WHERE `id_pol` = $id_pol AND `id_adr` = $id_adr AND `id_act` = $id_act AND `id_benef` = $id_benef");
 $rqtup->execute();

}else{
// pas de consomation enregistre donc nouvelle insertion
$rqtic = $bdd->prepare("INSERT INTO `consom` VALUES ($id_pol,$id_adr,$id_act,$id_benef,$mtt_remb,'1')");
$rqtic->execute();
}
$rqt =$bdd->prepare("UPDATE `demande` set et_dem='2', date_vdem='$datesys'  WHERE `id_dem` = $code");
$rqt->execute();
} 
 ?>