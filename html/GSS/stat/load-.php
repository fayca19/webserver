<?php
session_start();
require_once("../../../data/conn555.php");
$errone = false;
$annee=date("Y");

$d1=$annee."-01-01";
$d2=$annee."-12-31";
$max1=0;$max2=0;$max3=0;$max4=0;$max5=0;$max6=0;$max7=0;$max8=0;$max9=0;$max10=0;$max11=0;$max12=0;$max=0;$step=1;
//Latoui
$rqt1=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq
                     from  (
                            select *
                            from mois as m
                              left join (
                                        select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb
                                        from operation as o
                                        where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='19'
                                        group by EXTRACT(MONTH FROM o.dat_crea)
                                        ) as result
                              on m.id_mois=result.mois
                              ) as r");
$rqt1->execute();
$result1 = $rqt1->fetchAll();
$data=array();
foreach($result1 as $row1)
{
$data[$row1['mois']]=$row1['freq'];
$max1=max($max1,$row1['freq']);
}
//AMOUR
$rqt2=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='20' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt2->execute();
$result2 = $rqt2->fetchAll();
$data2=array();
foreach($result2 as $row2)
{
$data2[$row2['mois']]=$row2['freq'];
$max2=max($max2,$row2['freq']);
}
//ARAB
$rqt3=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='23' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt3->execute();
$result3 = $rqt3->fetchAll();
$data3=array();
foreach($result3 as $row3)
{
$data3[$row3['mois']]=$row3['freq'];
$max3=max($max3,$row3['freq']);
}
//ZEFOUNI
$rqt4=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='24' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt4->execute();
$result4 = $rqt4->fetchAll();
$data4=array();
foreach($result4 as $row4)
{
$data4[$row4['mois']]=$row4['freq'];
$max4=max($max4,$row4['freq']);
}
//ZEmrani
$rqt5=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='25' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt5->execute();
$result5 = $rqt5->fetchAll();
$data5=array();
foreach($result5 as $row5)
{
$data5[$row5['mois']]=$row5['freq'];
$max5=max($max5,$row5['freq']);
}
//Bouchama
$rqt6=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='26' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt6->execute();
$result6 = $rqt6->fetchAll();
$data6=array();
foreach($result6 as $row6)
{
$data6[$row6['mois']]=$row6['freq'];
$max6=max($max6,$row6['freq']);
}
//MANSOURI
$rqt7=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='28' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt7->execute();
$result7 = $rqt7->fetchAll();
$data7=array();
foreach($result7 as $row7)
{
$data7[$row7['mois']]=$row7['freq'];
$max7=max($max7,$row7['freq']);
}
//BOUTER
$rqt8=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='29' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt8->execute();
$result8 = $rqt8->fetchAll();
$data8=array();
foreach($result8 as $row8)
{
$data8[$row8['mois']]=$row8['freq'];
$max8=max($max8,$row8['freq']);
}
//BACHIR
$rqt9=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='54' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt9->execute();
$result9 = $rqt9->fetchAll();
$data9=array();
foreach($result9 as $row9)
{
$data9[$row9['mois']]=$row9['freq'];
$max9=max($max9,$row9['freq']);
}
//BOUAZIZ
$rqt10=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='34' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt10->execute();
$result10 = $rqt10->fetchAll();
$data10=array();
foreach($result10 as $row10)
{
$data10[$row10['mois']]=$row10['freq'];
$max10=max($max10,$row10['freq']);
}
//MESLI
$rqt11=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='49' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt11->execute();
$result11 = $rqt11->fetchAll();
$data11=array();
foreach($result11 as $row11)
{
$data11[$row11['mois']]=$row11['freq'];
$max11=max($max11,$row11['freq']);
}
//HADDAR
$rqt12=$bdd->prepare("select r.id_mois as mois, case when r.nb is null then 0 else r.nb  end as freq from  (
select *
from mois as m left join (
select EXTRACT(MONTH FROM o.dat_crea) as mois,count(o.id_op) as nb from operation as o where   o.dat_crea>='2021-01-01' and  o.dat_crea<='2021-12-31' AND o.id_user='48' group by EXTRACT(MONTH FROM o.dat_crea)) as result on m.id_mois=result.mois) as r");
$rqt12->execute();
$result12 = $rqt12->fetchAll();
$data12=array();
foreach($result12 as $row12)
{
$data12[$row12['mois']]=$row12['freq'];
$max12=max($max12,$row12['freq']);
}





$max=max($max1,$max2,$max3,$max4,$max5,$max6,$max7,$max8,$max9,$max10,$max11,$max12);
if($max<=200){$step=100;}else{$step=200;}
$latoui = array(  $data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data[9],$data[10],$data[11],$data[12] );
$amour = array(  $data2[1],$data2[2],$data2[3],$data2[4],$data2[5],$data2[6],$data2[7],$data2[8],$data2[9],$data2[10],$data2[11],$data2[12] );
$arab = array(  $data3[1],$data3[2],$data3[3],$data3[4],$data3[5],$data3[6],$data3[7],$data3[8],$data3[9],$data3[10],$data3[11],$data3[12] );
$zefouni = array(  $data4[1],$data4[2],$data4[3],$data4[4],$data4[5],$data4[6],$data4[7],$data4[8],$data4[9],$data4[10],$data4[11],$data4[12] );
$zemrani = array(  $data5[1],$data5[2],$data5[3],$data5[4],$data5[5],$data5[6],$data5[7],$data5[8],$data5[9],$data5[10],$data5[11],$data5[12] );
$bouchama = array(  $data6[1],$data6[2],$data6[3],$data6[4],$data6[5],$data6[6],$data6[7],$data6[8],$data6[9],$data6[10],$data6[11],$data6[12] );
$mansouri = array(  $data7[1],$data7[2],$data7[3],$data7[4],$data7[5],$data7[6],$data7[7],$data7[8],$data7[9],$data7[10],$data7[11],$data7[12] );
$bouter = array(  $data8[1],$data8[2],$data8[3],$data8[4],$data8[5],$data8[6],$data8[7],$data8[8],$data8[9],$data8[10],$data8[11],$data8[12] );
$bachir = array(  $data9[1],$data9[2],$data9[3],$data9[4],$data9[5],$data9[6],$data9[7],$data9[8],$data9[9],$data9[10],$data9[11],$data9[12] );
$bouaziz = array(  $data10[1],$data10[2],$data10[3],$data10[4],$data10[5],$data10[6],$data10[7],$data10[8],$data10[9],$data10[10],$data10[11],$data10[12] );
$bouaziz = array(  $data10[1],$data10[2],$data10[3],$data10[4],$data10[5],$data10[6],$data10[7],$data10[8],$data10[9],$data10[10],$data10[11],$data10[12] );
$mesli = array(  $data11[1],$data11[2],$data11[3],$data11[4],$data11[5],$data11[6],$data11[7],$data11[8],$data11[9],$data11[10],$data11[11],$data11[12] );
$haddar = array(  $data12[1],$data12[2],$data12[3],$data12[4],$data12[5],$data12[6],$data12[7],$data12[8],$data12[9],$data12[10],$data12[11],$data12[12] );
?>