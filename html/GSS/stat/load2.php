<?php
session_start();
require_once("../../../data/conn555.php");
$errone = false;
$datesys=date("Y-m-d");
//$datesys='2020-03-04';
$rqt=$bdd->prepare("select count(id_op) AS total from operation where dat_crea='$datesys';");
$rqt->execute();
$result = $rqt->fetchAll();
$total=0;
foreach($result as $row)
{
$total=$row['total'];
}
//Latoui
$rqt1=$bdd->prepare("select r.id_user, r.nom, r.prenom,case when nb is null then 0 else nb end as freq
                     from ( select *
                            from utilisateurs as u1
                            left join ( SELECT o.id_user as id_user2,count(o.id_op)as nb
                                        from operation o, utilisateurs u
                                        where o.id_user=u.id_user and  o.dat_crea='$datesys'
                                        group by o.id_user )as res
                            on u1.id_user=res.id_user2)as r
                     where r.id_user> '18' and r.privilege in('sdt','gest')");
$rqt1->execute();
$result1 = $rqt1->fetchAll();
$data=array();
foreach($result1 as $row1)
{
$data[$row1['id_user']]=$row1['freq'];

}

$latoui = $data[19];
$amour = $data[20];
$arab = $data[23];
$zefouni = $data[24];
$zemrani = $data[25];
$bouchama = $data[26];
$mansouri = $data[28];
$bouter = $data[29];
//$rebaine = $data[33];
$bouaziz = $data[34];
$mesli = $data[49];
$haddar = $data[48];
$bachir= $data[54];
$ketir= $data[59];
$djadouri= $data[70];
$Raouf= $data[71];
$titre="SAISIE DES OPERATIONS DU : ".date("d/m/Y",strtotime($datesys))." (Total des Operations est: ".$total." )";

?>