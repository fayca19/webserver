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
if (isset($_REQUEST['page'])) {
$page = $_REQUEST['page'];}else{$page=0;}
$bdd=bdd();
$datesys=date("Y-m-d");
if (isset($_REQUEST['cod'])) {
$cod = $_REQUEST['cod'];}
//Calcule du nombre de page
 $id_user=$_SESSION['id_user'];
$rqtc=$bdd->prepare("SELECT d.*, a.nom_adr, a.prenom_adr, c.lib_act FROM `demande` as d, `adherents` as a, `actes` as c WHERE d.id_adr=a.id_adr and d.id_act=c.id_act and et_dem < '2' and d.id_user= $id_user ORDER BY `id_dem` DESC");
$rqtc->execute();
$nbe = $rqtc->rowCount();
$nbpage=ceil($nbe/6);
//Pointeur de page
$part=$page*6;
//requete à suivre


$rqt=$bdd->prepare("SELECT d.*, a.nom_adr, a.prenom_adr, c.lib_act FROM `demande` as d, `adherents` as a, `actes` as c WHERE d.id_adr=a.id_adr and d.id_act=c.id_act and et_dem < '2' and d.id_user=$id_user ORDER BY `id_dem` DESC LIMIT $part,6");
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
<body onload="start()">
	<div id="page-heading">
		<h1>Instances-TP-En-Cours&nbsp;&nbsp;&nbsp;</h1> 
	</div>
	<div id="top-search">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td><a onclick="loadList('demande/instanceec.php')" title="Actualiser" ><img src="images/table/reload.png" width="20" height="20" alt="" /></a></td>
		<td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
		 <td><a class="icon-5"  title="Nouvelle-Demande" onclick="loadList('adh/code.php')" ></a></td>
		<td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
		<td>
		        <a class="page-far-left" title="Premiere page" onclick="fpagep('0','<?php echo $nbpage; ?>')"></a> 
				<a class="page-left" title="Page precedente" onclick="fpagep('<?php echo $page-1; ?>','<?php echo $nbpage; ?>')"></a>
				<div id="page-info">Page <strong><?php echo $page; ?></strong>/<?php echo $nbpage; ?></div>
				<a class="page-right" title="Page suivante" onclick="fpagep('<?php echo $page+1; ?>','<?php echo $nbpage; ?>')"></a>
				<a class="page-far-right" title="Derniere page" onclick="fpagep('<?php echo $nbpage-1; ?>','<?php echo $nbpage; ?>')"></a>
			</td>
			
		</tr>
		</table>
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
					<th class="table-header-repeat" align="center"><a>Etat</a></th>
					<th class="table-header-repeat" align="center"><a>C-Instance</a></th>
					<th class="table-header-repeat" align="center"><a>Nom-Prenom (Adherent)</a>	</th>
					<th class="table-header-repeat" align="center"><a>Libelle-Acte</a></th>
					<th class="table-header-repeat" align="center"><a>Date-Prestation</a></th>
					<th class="table-header-repeat" align="center"><a>Montant-Demande</a></th>
					<th class="table-header-repeat" align="center"><a>Mtt-AGLIC</a></th>
					<th class="table-header-repeat" align="center"><a>Option</a></th>
				</tr>
				<?php 
				$i = 0;
				while ($row_res=$rqt->fetch()){
				$color = ++$i % 2 ? '#CCCCCC':'#FFFFFF'; 
				?>
				<tr>
				    <td>
					<?php  if($row_res['et_dem']==0){ ?>
					<a class="icon-16" title="Demande-En-Cours"></a>
					<?php }
					 if($row_res['et_dem']==1){
					 ?>
					 <a class="icon-17" title="Demande-A-Confirmee"></a>
					 <?php } ?>
					</td>
					<td bgcolor="<?php echo $color; ?>"><?php echo $row_res['id_dem']; ?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center"><?php echo $row_res['nom_adr'].'-'.$row_res['prenom_adr'];?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center"><?php echo $row_res['lib_act'];?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center"><?php echo date("d/m/Y",strtotime($row_res['date_dem']));?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center"><?php echo $row_res['fr_dem'];?></td>
					<td  bgcolor="<?php echo $color; ?>" align="center"><?php echo $row_res['mtt_remb'];?></td>
					<td class="options-width" bgcolor="<?php echo $color; ?>">
					<a class="icon-10" title="Annuler" onclick="ddemande('<?php echo $row_res['id_dem']; ?>')"></a>
					<?php if($row_res['et_dem']==1){
					 ?>
					 <a class="icon-8" title="Confirmer la demande" onclick="vdemande('<?php echo $row_res['id_dem']; ?>')"></a>
					 <?php } ?>
					 <a class="icon-1" title="Imprimer la Demande" onclick="pdem('<?php echo crypte($row_res['id_dem']); ?>');"></a>
					 <!--<a class="icon-1" title="Mail" onclick="testmail()"></a>-->
					</td>
				</tr>
				<?php } ?> 
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
echo "<h2>Aucun Resultat</h2>"; ?>
<p><a class="icon-5"  title="Nouvelle-Demande" onclick="loadList('adh/code.php')" ></a></p>
<?php
}
?>
</div>
</body>
</html>
<script language="JavaScript">
function fpagep(page,nbpage){

if(page >=0){
if(page == nbpage){
alert("Vous ete a la derniere page!");
}else{$("#content").load('demande/instanceec.php?page='+page);}
}else{alert("Vous ete en premiere page !");}
}	
function testmail(){
if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
xhr.open("GET", "demande/mail.php", false);
xhr.send(null);
alert(xhr.responseText);


}	
</script>
 