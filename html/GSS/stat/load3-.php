<?php
session_start();
require_once("../../../data/conn555.php");
$errone = false;
$datesys=date("Y-m-d");
//$datesys='2020-03-04';
$jaune=0;$violet=0;$bleu=0;$vert=0;$orange=0;$rouge=0;
//classique
$rqt=$bdd->prepare("select count(id_op) AS s_total1 from operation where dat_crea='$datesys';");
$rqt->execute();
$result = $rqt->fetchAll();
$s_total1=0;
foreach($result as $row)
{
$s_total1=$row['s_total1'];

}

//TP
$rqt2=$bdd->prepare("select count(id_dem) AS s_total2 from demande where date_crea='$datesys';");
$rqt2->execute();
$result2 = $rqt->fetchAll();
$s_total2=0;
foreach($result2 as $row2)
{
    $s_total2=$row2['s_total2'];

}


//Classique:
$rqt1=$bdd->prepare("select r.id_user, r.nom, r.prenom,case when nb is null then 0 else nb end as freq
                     FROM ( select *
                            from utilisateurs as u1
                            left join ( SELECT o.id_user as id_user2,count(o.id_op)as nb
                                        from operation o, utilisateurs u
                                        where o.id_user=u.id_user and  o.dat_crea='$datesys'
                                        group by o.id_user
                                        )as res
                            on u1.id_user=res.id_user2
                          )as r
                     WHERE r.id_user > '18' and r.privilege in('sdt','gest')");
$rqt1->execute();
$result1 = $rqt1->fetchAll();
$data=array();
foreach($result1 as $row1)
{
$data[$row1['id_user']]=$row1['freq'];

}




//TP:
$rqt12=$bdd->prepare("select r.id_user, r.nom, r.prenom,case when nb is null then 0 else nb end as freq
                    FROM (select *
                          from accprest as u1
                          left join ( SELECT d.id_user as id_user2,count(d.id_dem)as nb
                                      from demande d, accprest a
                                      where d.id_user=a.id_user and  d.date_crea='$datesys'
                                      group by d.id_user
                                    )as res
                          on u1.id_user=res.id_user2
                          )as r
                    WHERE r.id_user in(5,6)");
$rqt12->execute();
$result12 = $rqt12->fetchAll();
$data12=array();
foreach($result12 as $row12)
{
    $data12[$row12['id_user']]=$row12['freq'];

}
$s_total=$s_total1+$s_total2;
$latoui = $data[19];
$amour = $data[20];
$arab = $data[23];
$zefouni = $data[24]+$data12[6];
$zemrani = $data[25];
$bouchama = $data[26];
$mansouri = $data[28];
$bouter = $data[29]+$data12[5];
$rebaine = $data[33];
$bouaziz = $data[34];
$mesli = $data[49];
$haddar = $data[48];

$jaune=$bouter+$rebaine;
$violet=$mansouri+$latoui;
$bleu=$arab+$amour;
$vert=$bouaziz+$mesli;
$orange=$zemrani+$bouchama;
$rouge=$zefouni;

$total=$jaune+$violet+$bleu+$vert+$orange+$rouge;
$titre="SAISIE DES OPERATION DU : ".date("d/m/Y",strtotime($datesys))." (Total des Operations est: ".$total." )";





$rqt2=$bdd->prepare("select r.id_user, r.nom, r.prenom,case when nb is null then 0 else nb end as freq 
from (select * from utilisateurs as u1 
            left join (
            select o.id_user as util, count(o.id_op) as nb
            from operation as o 
            where extract( year from o.dat_crea) =  extract( year from '$datesys') 
            and extract( week from o.dat_crea) =  extract( week from '$datesys') 
            group by o.id_user ) as res
            on u1.id_user=res.util ) as r 
            where r.id_user> '18' and r.privilege in ('sdt','gest')");
			
			
			
			
$rqt2->execute();
$result2 = $rqt2->fetchAll();
$data2=array();
foreach($result2 as $row2)
{
$data2[$row2['id_user']]=$row2['freq'];

}

$latoui2 = $data2[19];
$amour2 = $data2[20];
$arab2= $data2[23];
$zefouni2 = $data2[24];
$zemrani2 = $data2[25];
$bouchama2 = $data2[26];
$mansouri2 = $data2[28];
$bouter2 = $data2[29];
$rebaine2 = $data2[33];
$bouaziz2 = $data2[34];
$mesli2 = $data2[49];
$haddar2 = $data2[48];

$jaune2=$bouter2+$rebaine2;
$violet2=$mansouri2+$latoui2;
$bleu2=$arab2+$amour2;
$vert2=$bouaziz2+$mesli2;
$orange2=$zemrani2+$bouchama2;
$rouge2=$zefouni2;

$titre2="SAISIE HEBDOMADAIRE DES OPERATIONS";			
?>