<?php 
session_start();
require_once("../../../data/congss.php");
$bdd=bdd();
header('Content-Type: text/html; charset=UTF-8');
if ($_SESSION['login']){ 
//authentification acceptee !!!


//header("Location: http://www.monsite.com");
}
else {
header("Location:../index.html?erreur=login"); // redirection en cas d'echec
}
include("convert.php");
$a1 = new chiffreEnLettre();
$errone = false;


require('fpdf.php');

if (isset($_REQUEST['r0'])) {
$r0 = $bdd->quote($_REQUEST['r0']);


}
class PDF extends FPDF
{
// En-t?te
function Header()
{
 $this->SetFont('Arial','B',10);
     $this->Image('../images/logo.png',6,4,50);
	 $this->Cell(150,5,'','O','0','L');
	 $this->SetFont('Arial','B',12);
	// $this->Cell(60,5,'MAPFRE | Assistance','O','0','L');
      $this->SetFont('Arial','B',10);
	  $this->Ln(8);
}

// Pied de page
function Footer()
{
    // Positionnement ? 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',6);
    // Num?ro de page
    $this->Cell(0,8,'Page '.$this->PageNo().'/{nb}',0,0,'C');$this->Ln(3);
	$this->Cell(0,8,"Algerian Gulf Life Insurance Company, SPA au capital social de 1.000.000.000 de dinars algériens, 01 Rue Tripoli, hussein Dey Alger,  ",0,0,'C');
	$this->Ln(2);
	$this->Cell(0,8,"RC : 16/00-1009727 B 15   NIF : 001516100972762-NIS :0015160900296000",0,0,'C');
	$this->Ln(2);
	$this->Cell(0,8,"Tel : +213 (0) 21 77 30 12/14/15 Fax : +213 (0) 21 77 29 56 Site Web : www.aglic.dz  ",0,0,'C');
	}
}
//Les requetes *****************
// Requete pour controler le beneficiaire
$query_ann = $bdd->prepare(("select id_benef from demande where  id_dem =$r0"));
$query_ann->execute();
$row_benef = $query_ann->fetch();
$id_user =$_SESSION['id_user'];
if($row_benef['id_benef']==0){
//la demande concerne l'assuré principal
$query_demande = $bdd->prepare("select d.*, u.*, p.*, c.*,a.* from demande as d, accprest as u, polices as p, actes as c, adherents as a where d.id_user=u.id_user and d.id_pol=p.id_pol and d.id_act=c.id_act and d.id_adr=a.id_adr and d.id_dem = $r0 and d.id_user= $id_user");
	//$query_demande->execute();
}else{
//la demande concerne un beneficiaire de l'assure
$query_demande = $bdd->prepare("select d.*, u.*, p.*, c.*,a.*, b.*, e.lib_tben from demande as d, accprest as u, polices as p, actes as c, adherents as a, beneficiaire as b, type_benef as e  where d.id_user=u.id_user and d.id_pol=p.id_pol and d.id_act=c.id_act and d.id_adr=a.id_adr and d.id_benef=b.id_benef and b.type_benef=e.id_tben and d.id_dem = $r0  and d.id_user=$id_user");
	//$query_demande->execute();
}
$query_demande->execute();
$row_dem = $query_demande->fetch();
// Instanciation de la classe derivee
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
//$pdf->Ln(2);
$pdf->SetFillColor(205,205,205);
$pdf->Cell(190,8,'Demande Annulée','0','0','C');$pdf->Ln();
$pdf->Cell(190,8,'Demande N° '.str_pad((int) $r0,'7',"0",STR_PAD_LEFT).'','0','0','C');$pdf->Ln();$pdf->Ln();
$pdf->SetFont('Arial','B',14);
//$pdf->Ln(2);
$pdf->SetFillColor(7,27,81);
$pdf->SetTextColor(255,255,255);
//Le Prestataire
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,5,"Prestataire",'1','1','C','1');
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(25,5,"Nom",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['nom']."",'1','0','C','1');
$pdf->Cell(25,5,"Prénom",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['prenom']."",'1','0','C','1');$pdf->Ln();
$pdf->Cell(25,5,"Adresse",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['adr_prest']."",'1','0','C','1');
$pdf->Cell(25,5,"Marque",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['mark_prest']."",'1','0','C','1');$pdf->Ln();
$pdf->Ln(10);
// Le Contrat
$pdf->SetFillColor(199,139,85);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,5,"Police d'assurance",'1','1','C','1');
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(25,5,"Police N°",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['nom_pol']."",'1','0','C','1');
$pdf->Cell(25,5,"D.Gestion",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['delais_ges_pol']."",'1','0','C','1');$pdf->Ln();
$pdf->Cell(25,5,"Effet",'1','0','C','1');$pdf->Cell(70,5,"".date("d/m/Y", strtotime($row_dem['date_ef_pol']))."",'1','0','C','1');
$pdf->Cell(25,5,"Echéance",'1','0','C','1');$pdf->Cell(70,5,"".date("d/m/Y", strtotime($row_dem['date_ech']))."",'1','0','C','1');$pdf->Ln();
$pdf->Ln(10);
// L'assuré
$pdf->SetFillColor(7,27,81);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,5,'Assuré ','1','1','C','1');
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(25,5,"Nom",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['nom_adr']."",'1','0','C','1');
$pdf->Cell(25,5,"Prénom",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['prenom_adr']."",'1','0','C','1');$pdf->Ln();
$pdf->Cell(25,5,"D.Naissance",'1','0','C','1');$pdf->Cell(70,5,"".date("d/m/Y", strtotime($row_dem['date_nais_adr']))."",'1','0','C','1');
$pdf->Cell(25,5,"Sexe",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['sexe_adr']."",'1','0','C','1');$pdf->Ln();
$pdf->Ln(10);
// Le Contrat
$pdf->SetFillColor(199,139,85);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,5,"Le Bénéficiaire",'1','1','C','1');
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
if($row_benef['id_benef']==0){
$pdf->Cell(190,5,"Assuré principal",'1','0','C','1');$pdf->Ln();
}else{
$pdf->Cell(25,5,"Nom",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['nom_benef']."",'1','0','C','1');
$pdf->Cell(25,5,"Prénom",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['prenom_benef']."",'1','0','C','1');$pdf->Ln();
$pdf->Cell(25,5,"D.Naissance",'1','0','C','1');$pdf->Cell(70,5,"".date("d/m/Y", strtotime($row_dem['date_nais_benef']))."",'1','0','C','1');
$pdf->Cell(25,5,"Qualité",'1','0','C','1');$pdf->Cell(70,5,"".$row_dem['lib_tben']."",'1','0','C','1');$pdf->Ln();
}
$pdf->Ln(10);
// L'assuré
$pdf->SetFillColor(7,27,81);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,5,'Acte','1','1','C','1');
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(25,5,"Libelle",'1','0','C','1');$pdf->Cell(165,5,"".$row_dem['lib_act']."",'1','0','C','1');$pdf->Ln();
$pdf->Cell(25,5,"Code",'1','0','C','1');$pdf->Cell(165,5,"".$row_dem['clee_act']."",'1','0','C','1');$pdf->Ln();
$pdf->Cell(25,5,"Date-Prestation",'1','0','C','1');$pdf->Cell(165,5,"".date("d/m/Y", strtotime($row_dem['date_dem']))."",'1','0','C','1');$pdf->Ln();
$pdf->Cell(25,5,"Coefficient",'1','0','C','1');$pdf->Cell(165,5,"".number_format($row_dem['coef_dem'], 2,',',' ')."",'1','0','C','1');$pdf->Ln();
$somme=$a1->ConvNumberLetter("".$row_dem['fr_dem']."",1,0);
$pdf->Cell(25,5,"MTT-Demandé",'1','0','C','1');$pdf->Cell(165,5,"".number_format($row_dem['fr_dem'], 2,',',' ')."",'1','0','C','1');$pdf->Ln();
$pdf->Cell(25,5,"MTT-D-Lettre",'1','0','C','1');$pdf->Cell(165,5,"".$somme."",'1','0','C','1');$pdf->Ln();
$somme1=$a1->ConvNumberLetter("".$row_dem['cnas_dem']."",1,0);
$pdf->Cell(25,5,"Partie-CNAS",'1','0','C','1');$pdf->Cell(165,5,"".number_format($row_dem['cnas_dem'], 2,',',' ')."",'1','0','C','1');$pdf->Ln();
$pdf->Cell(25,5,"P-CNAS-Lettre",'1','0','C','1');$pdf->Cell(165,5,"".$somme1."",'1','0','C','1');$pdf->Ln();
$somme2=$a1->ConvNumberLetter("".$row_dem['mtt_remb']."",1,0);
$pdf->Cell(25,5,"MTT-Aglic",'1','0','C','1');$pdf->Cell(165,5,"".number_format($row_dem['mtt_remb'], 2,',',' ')."",'1','0','C','1');$pdf->Ln();
$pdf->Cell(25,5,"Motif",'1','0','C','1');$pdf->Cell(165,5,"".$row_dem['mot_dem']."",'1','0','C','1');$pdf->Ln();
$pdf->Output();	
				

?>








