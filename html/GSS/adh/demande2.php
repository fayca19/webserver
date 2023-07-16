<?php session_start();
require_once("../../../data/congss.php");
$bdd=bdd();
if ($_SESSION['login']){}
else {
header("Location:../index.php?erreur=login"); // redirection en cas d'echec
}
if (isset($_REQUEST['row']) && isset($_REQUEST['row1']) && isset($_REQUEST['row2']) && isset($_REQUEST['row3']) && isset($_REQUEST['row4'])) {
$user = $_REQUEST['row'];
$adr = $_REQUEST['row1'];
$pol = $_REQUEST['row2'];
$benef = $_REQUEST['row3'];
$lien = $_REQUEST['row4'];
}
$rqt=$bdd->prepare("select   p.nom_pol,p.date_ef_pol,p.date_ech,r.*,fr.lib_tf from adherents as a, lien as l, formule as f,type_formule as fr, actes as r, polices as p, affgactprest as lp where r.id_act=f.id_act and  a.id_group= l.id_group and l.id_bar= f.id_barem and f.id_f=fr.id_tf and l.id_pol=p.id_pol and r.id_gract=lp.id_gract and lp.id_user= $user and a.id_adr=$adr");
$rqt->execute();

?>
<link rel="stylesheet" href="../css/screen.css" type="text/css" media="screen" title="default" />
<div id="page-heading"><h1>Demande de Prise en charge (<?php echo $lien; ?>)</h1></div>
<form id="form1" name="form1" method="post" onSubmit="return checkform();">

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">

		<tr>
		<th valign="top">Acte: (*)</th>
		<td>
		<select  class="styledselect_form_1" id="id_act" onchange="typesous(this)">
			<option value="">--</option>
			<?php  
			 while ($row_acte=$bdd->fetch()){ ?>
			<option value="<?php echo $row_acte['id_act']; ?> "><?php echo $row_acte['lib_act'];  ?></option>
		<?php } ?>	
		</select>
		
		
		</td>
		<th valign="top">Date-Prestation: (*)</th>
		<td><input type="text" id="dact" class="date-pick dp-applied" onblur="verifdate1(this)" /></td>
		</tr>
		<tr>
		<th valign="top">coefficient:(*)</th>
		<td><input type="text" class="inp-form" id="coef" value="1"/></td>
		<th valign="top">Montant-DZ: (*)</th>
		<td><input type="text" class="inp-form" id="frdem" /></td>
		</tr>
		<tr>
		<th valign="top">&nbsp;</th><th valign="top">&nbsp;</th><th valign="top">&nbsp;</th>
		<td><input class="bouton2" type="button" value="Envoyer" onClick="insertdem()"/></td>
		</tr>
		
		
		
		<tr><td>&nbsp;&nbsp;</td></tr>
		
	
	</table>
	<!-- end id-form  -->

	</td>
	
</tr>
<tr>
<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>
</form>

<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->
<script language="JavaScript">
function insertdem(){
var pol = "<?php echo $pol; ?>";
var user = "<?php echo $user; ?>";
var adr = "<?php echo $adr; ?>";
var benef = "<?php echo $benef; ?>";
var lien = "<?php echo $lien; ?>";
var act = document.getElementById("id_act").value;
var datact=dfrtoen(document.getElementById("dact").value);
var freel = document.getElementById("frdem").value;
var coef = document.getElementById("coef").value;
if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
if(pol && user && adr && act && datact && freel && coef){	
xhr.open("GET", "demande/insertdemb.php?r0="+pol+"&r1="+user+"&r2="+adr+"&r3="+act+"&r4="+datact+"&r5="+freel+"&r6="+benef+"&r7="+coef, false);
xhr.send(null);
alert("Demande Envoyee!");
$("#content").load('demande/instanceec.php');
}else{alert("Veuillez remplir tous les champs obligatoires (*) !");}
}


Date.firstDayOfWeek = 0;
Date.format = 'dd/mm/yyyy';

$(function()
{
	$('.date-pick').datePicker({startDate:'01/01/1996'});
});
</script>
 