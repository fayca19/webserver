<?php 
session_start();

require_once("../../../data/congss.php");

$bdd =bdd();

if ($_SESSION['login']){}
else {
header("Location:../index.html?erreur=login");
}
function crypte($x){
   $crypted = '9712346565'.$x ;
   return $crypted;
}

?>

<link rel="stylesheet" href="../css/screen.css" type="text/css" media="screen" title="default" />
<div id="page-heading"><h1>Etats Statistiques</h1></div>
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
	
	
		<!--  start step-holder -->
		<div id="step-holder">
			<div class="step-no"></div>
			<div class="step-dark-left"><a href="">Parametres</a></div>
			<div class="step-dark-right">&nbsp;</div>
		</div>
		<!--  end step-holder -->
	
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
		 <th valign="top">Du:</th>
		 <td><input type="text" class="date-pick dp-applied"  id="dated" /></td>	
		 <th valign="top">Au:</th>
		 <td><input type="text" class="date-pick dp-applied"  id="datef" /></td>	
		</tr> 
		<tr>
		<th valign="top">Etat:</th>
		 <td>	<select  class="styledselect_form_1"  id="etat" >
			<option value="0">Envoyes</option>
			<option value="1">A Confirmer</option>
			<option value="2">Classes</option>
			<option value="3">Rejetes</option>
		</select>
		</td>
		<th valign="top"></th>
		<td>
			<input class="bouton2" type="button" value="Generer" onClick="genere()"/></td>
		
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
<script language="JavaScript">
Date.firstDayOfWeek = 0;
Date.format = 'dd/mm/yyyy';

$(function()
{
	$('.date-pick').datePicker({startDate:'01/01/1996'});
});
</script>

 