<?php
session_start();
require_once("../../../data/conn555.php");
$errone = false;
//$datesys=date("Y-m-d");
$datesys='2023-06-27';


///// CLASSIC
$rqt=$bdd->prepare("select count(id_op) AS t_op_classic from operation o , utilisateurs u where o.id_user = u.id_user and dat_crea='$datesys' and u.privilege in('gest');");
$rqt->execute();
$result1 = $rqt->fetchAll();
$t_op_classic=0;
foreach($result1 as $row1)
{
    $t_op_classic=$row1['t_op_classic'];

}

//TP
$rqt2=$bdd->prepare("select count(id_dem) AS t_op_tp from demande where date_tdem='$datesys' and id_user not in (13) and et_dem not in (3,5);");
$rqt2->execute();
$result2 = $rqt2->fetchAll();
$t_op_tp=0;
foreach($result2 as $row2)
{
    $t_op_tp=$row2['t_op_tp'];

}





//// CLASSIC
$rqt1=$bdd->prepare("select r.id_user, r.nom, r.prenom,r.mail ,case when nb is null then 0 else nb end as freq
FROM ( select *
       from utilisateurs as u1
       inner join ( SELECT o.id_user as id_user2,count(o.id_op)as nb
                   from operation o, utilisateurs u
                   where o.id_user=u.id_user and  o.dat_crea='$datesys'
                   group by o.id_user
                   )as res
       on u1.id_user=res.id_user2
     )as r
WHERE r.id_user > '19' and r.privilege in('gest')");
$rqt1->execute();
$result1 = $rqt1->fetchAll();
$data=array();
$datanom=array();
$datacouple=array();
foreach($result1 as $row1)
{
$data[$row1['id_user']]=$row1['freq'];
//$datanom[$row1['id_user']]=$row1['nom'].'-'.$row1['prenom'];
$datacouple=['nom'=>strtoupper($row1['nom']),"id_user"=>$row1['id_user'],"mail"=>$row1['mail'],"freq"=>$row1['freq'],'added'=>0];
array_push($datanom,$datacouple);

}

//// TP
$rqt12=$bdd->prepare("select r.id_user, r.nom, r.prenom,r.mail ,case when nb is null then 0 else nb end as freq
FROM (select *
      from utilisateurs as u1
      inner join ( SELECT d.id_atp as id_user2,count(d.id_dem)as nb
                  from demande d, utilisateurs a
                  where d.id_atp=a.id_user and  d.date_tdem='$datesys' and d.id_user not in (13) and d.et_dem not in (3,5)
                  group by d.id_atp
                )as res
      on u1.id_user=res.id_user2
      )as r

");
$rqt12->execute();
$result12 = $rqt12->fetchAll();
$data12=array();
$datanom2=array();
foreach($result12 as $row12)
{
     if($row12['id_user'] == '52'){
        $datacouple2=['nom'=>"BOUTER","id_user"=>$row12['id_user'],"mail"=>$row12['mail'],"freq"=>$row12['freq'],'added'=>0];

     }else{
        $datacouple2=['nom'=>strtoupper($row12['nom']),"id_user"=>$row12['id_user'],"mail"=>$row12['mail'],"freq"=>$row12['freq'],'added'=>0];
     }
    array_push($datanom2,$datacouple2);
}

foreach ($datanom2 as &$user){
    foreach ($datanom as &$user2){
         if(strtolower($user['mail']) == strtolower($user2['mail'])) {
             $user2['freq'] += $user['freq'];
             $user['added'] = 1;
         }
    }
}



for ($i=0; $i < count($datanom2); $i++) { 
    if ($datanom2[$i]['added'] == 1){
        unset($datanom2[$i]);
    }
}

$result = array_merge($datanom,$datanom2);

usort($result,'compare_freq');



echo json_encode(['production'=>$result,'t_op_classic'=>$t_op_classic,'t_op_tp'=>$t_op_tp]);




function compare_freq($a, $b)
{
  return strnatcmp(strtolower($b['freq']), strtolower($a['freq']));
}

?>