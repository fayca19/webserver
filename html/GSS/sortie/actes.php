<?php session_start();
require_once("../../../data/congss.php");
$bdd=bdd();
if ($_SESSION['login']){}
else {
header("Location:../index.php?erreur=login"); // redirection en cas d'echec
}
if (isset($_REQUEST['row']) && isset($_REQUEST['row1'])) {
$user = $_REQUEST['row'];
$adr = $_REQUEST['row1'];

include("convert.php");
$a1 = new chiffreEnLettre();
$errone = false;

require('fpdf.php');
class PDF extends FPDF
{
// En-t?te
function Header()
{
 $this->SetFont('Arial','B',10);
     $this->Image('../images/logo.png',6,0,50);
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

// Instanciation de la classe derivee
$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(199,139,85);
$pdf->SetFont('Arial','B',15);

// Requete SQL
$query_res = $bdd->prepare("select   p.nom_pol,p.date_ef_pol,p.date_ech,r.*,fr.lib_tf from adherents as a, lien as l, formule as f,type_formule as fr, actes as r, polices as p, affgactprest as lp where r.id_act=f.id_act and  a.id_group= l.id_group and l.id_bar= f.id_barem and f.id_f=fr.id_tf and l.id_pol=p.id_pol and r.id_gract=lp.id_gract and lp.id_user=$user and a.id_adr=$adr ");

$query_res->execute();
$pdf->Cell(280,10,'Actes Supportés ','1','1','C','1');$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(70,7,'Acte','1','0','C');$pdf->Cell(30,7,'C.Acte','1','0','C');$pdf->Cell(50,7,'Police N°','1','0','C');$pdf->Cell(30,7,'Effet','1','0','C');$pdf->Cell(30,7,'Echéance','1','0','C');$pdf->Cell(70,7,'Formule-Remboursement','1','0','C');
$pdf->SetFillColor(221,221,221);
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$total=0;
while ($row_res=$query_res->fetch()){
$pdf->Cell(70,5,''.$row_res['lib_act'].'','1','0','C');$pdf->Cell(30,5,''.$row_res['clee_act'].'','1','0','C');
$pdf->Cell(50,5,''.$row_res['nom_pol'].'','1','0','C');
$pdf->Cell(30,5,"".date("d/m/Y", strtotime($row_res['date_ef_pol']))."",'1','0','C');$pdf->Cell(30,5,"".date("d/m/Y", strtotime($row_res['date_ech']))."",'1','0','C');$pdf->Cell(70,5,''.$row_res['lib_tf'].'','1','0','C');$pdf->Ln();
}

$pdf->Output();
}
?>