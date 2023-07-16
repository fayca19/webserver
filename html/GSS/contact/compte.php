<?php
session_start();

require_once("../../../data/congss.php");
if ($_SESSION['login']){}
else {
header("Location:index.html?erreur=login");
}
$bdd =bdd();
$id_user=$_SESSION['id_user'];
$rqt=$bdd->prepare("SELECT * FROM `accprest` WHERE id_user= $id_user");
$rqt->execute();
$nb = $rqt->rowCount();
;
while ($row_res=$rqt->fetch()){
$nom=$row_res['nom'];
$prenom=$row_res['prenom'];
$login=$row_res['login'];
$adresse=$row_res['adr_prest'];
}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/screen.css" type="text/css" media="screen" title="default" />
</head>
<body> 
<div id="content">
<div id="page-heading"><h1>Compte Prestataire</h1></div>

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
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content" >
<form id="form1" name="form1" method="post" onSubmit="return checkform();">
<p>Modification des informations Utilisateur</p>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<td>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>&nbsp;</tr>
		
		<th valign="top">Nom: (*)</th>
		 <td><input type="text" id="nuser" class="inp-form" onblur="verif(this)"  value="<?php echo $nom ?>"/></td>
		 <th valign="top">Presom: (*)</th>
		 <td><input type="text" id="puser" class="inp-form" onblur="verif(this)"value="<?php echo $prenom ?>"  /></td>
		 </tr>
		 <tr>
		 <th valign="top">Adresse:</th>
		 <td><input type="text" id="euser" class="inp-form"  value="<?php echo $adresse ?>"  /></td>	
		 <th valign="top">Login: (*)</th>
		 <td><input type="text" id="luser" class="inp-form" onblur="verif(this)"value="<?php echo $login ?>" disabled="disabled"/></td>
		 </tr>
		 <tr>
		 <th valign="top">Password: (*) </th>
		 <td><input type="text" id="pwuser" class="inp-form" onblur="verif(this)" /></td>
		  <th valign="top">&nbsp;</th>
		<td valign="top"><input class="bouton2" type="button" value="Enregistrer" onClick="update()"/></td>
		</tr>
			
</table> </td></table>
</form>
</div>
  <div class="clear"></div>
		</div>
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
<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
</body>
</html>