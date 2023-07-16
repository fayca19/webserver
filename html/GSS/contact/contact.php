<link rel="stylesheet" href="../css/screen.css" type="text/css" media="screen" title="default" />
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
			<div class="step-dark-left"><a href="">Contactez-Nous!</a></div>
		</div>
		<!--  end step-holder -->
	
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">

		<tr>
		<th valign="top">Adresse:</th>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<th valign="top">01 Rue Tripoli, hussein Dey Alger</th>
		</tr>
		<th valign="top">E-Mail</th>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<th valign="top">tierspayant@aglic.dz</th>
		
		</tr>
		<th valign="top">Tel:</th>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<th valign="top">(0) 21 77 30 12/14/15</th>
		</tr>
		<tr>
		<th valign="top">Fax:</th>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<th valign="top">(0) 21 77 29 56</th>
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
function genere(){
var code = document.getElementById("id_adr").value;

if (window.XMLHttpRequest) { 
        xhr1 = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr1 = new ActiveXObject("Microsoft.XMLHTTP");
    }
$("#content").load('adh/adherent.php?cod='+code);
}
function generen(){
var nom = document.getElementById("nom_adr").value;

if (window.XMLHttpRequest) { 
        xhr1 = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr1 = new ActiveXObject("Microsoft.XMLHTTP");
    }
$("#content").load('adh/adherentn.php?nom='+nom);
}
function generep(){
var pnom = document.getElementById("prenom_adr").value;

if (window.XMLHttpRequest) { 
        xhr1 = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) 
    {
        xhr1 = new ActiveXObject("Microsoft.XMLHTTP");
    }
$("#content").load('adh/adherentp.php?pnom='+pnom);
}


Date.firstDayOfWeek = 0;
Date.format = 'dd/mm/yyyy';

$(function()
{
	$('.date-pick').datePicker({startDate:'01/01/1996'});
});
</script>
 