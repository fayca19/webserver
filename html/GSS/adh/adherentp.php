 <?php
 session_start(); 
 require_once("../../../data/congss.php");
  function crypte($x){
   $crypted = '8712346534'.$x ;
   return $crypted;
}
 if ($_SESSION['login']){}
else {
header("Location:../index.html?erreur=login");
}
$bdd =bdd();
$datesys=date("Y-m-d");
if (isset($_REQUEST['pnom'])) {
$pnom = $_REQUEST['pnom'];}
$rqt= $bdd->prepare("SELECT a.`id_adr`,a.`nom_adr`,a.`prenom_adr`,a.`date_nais_adr`,p.id_pol,p.date_ef_pol,p.date_ech FROM `adherents` as a,polices as p,groupes as g, lien as l WHERE
a.id_group=g.id_group and l.id_group=g.id_group and l.id_pol=p.id_pol and p.tp_pol='1' and `prenom_adr` like %$pnom%");
$rqt->execute();
$nb = $rqt->rowCount();

if ($nb!=0){
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/screen.css" type="text/css" media="screen" title="default" />
</head>
<body>
	<div id="page-heading">
		<h1>Resultat de la Recherche par Prenom</h1>
	</div>
	<div id="top-search">
	</div>

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="../images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="../images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<div id="content-table-inner">
			<div id="table-content">
			
				<form id="mainform" action="">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-repeat" align="center"><a>C-Police</a></th>
					<th class="table-header-repeat" align="center"><a>C-Adherent</a></th>
					<th class="table-header-repeat" align="center"><a>Nom</a>	</th>
					<th class="table-header-repeat" align="center"><a>Prenom</a></th>
					<th class="table-header-repeat" align="center"><a>Date-Naissance</a></th>
					<th class="table-header-repeat" align="center"><a>Effet</a></th>
					<th class="table-header-repeat" align="center"><a>Echeance</a></th>
					<th class="table-header-repeat" align="center"><a>Qualite</a></th>
					<th class="table-header-repeat" align="center"><a>Option</a></th>
				</tr>
				<?php 
				$i = 0;
				while ($row_res=$rqt->fetch()){
				$color = ++$i % 2 ? '#CCCCCC':'#FFFFFF'; 
				?>
				
				<tr>
				    <td bgcolor="<?php echo $color; ?>"><?php echo $row_res['id_pol']; ?></td>
					<td bgcolor="<?php echo $color; ?>"><?php echo $row_res['id_adr']; ?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center"><?php echo $row_res['nom_adr'];?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center"><?php echo $row_res['prenom_adr'];?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center"><?php echo date("d/m/Y",strtotime($row_res['date_nais_adr']));?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center"><?php echo date("d/m/Y",strtotime($row_res['date_ef_pol']));?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center"><?php echo date("d/m/Y",strtotime($row_res['date_ech']));?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center">Assure</td>
					<td class="options-width" bgcolor="<?php echo $color; ?>">
<a href="javascript:;" title="Fiche-Adherent" class="icon-14" onclick="fiche('<?php echo $row_res['id_adr'];?>');"></a>
					</td>
				</tr>

				<?php  } ?>
				</table>
				<!--  end product-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
		
			
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>
<?php
    
}else{
echo '<h2>Aucun Resultat pour cette recherche ! </h2>';
echo "<h2><a href='dencour.php'>Retour </a></h2>";
}
?>
</div>

<script language="JavaScript">
function fiche(code){

if (window.XMLHttpRequest) { 
        xhr1 = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr1 = new ActiveXObject("Microsoft.XMLHTTP");
    }
$("#content").load('adh/adherent.php?cod='+code);
}

</script>
</body>
</html>