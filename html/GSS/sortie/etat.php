<?php session_start();
require_once("../../../data/congss.php");
$bdd = bdd();
header('Content-Type: text/html; charset=UTF-8');
if ($_SESSION['login']){}
else {
header("Location:../index.html?erreur=login"); // redirection en cas d'echec
}

if (isset($_REQUEST['r0']) && isset($_REQUEST['r1']) && isset($_REQUEST['r2'])) {
$dated = $_REQUEST['r0'];
$datef = $_REQUEST['r1'];
$etat = $_REQUEST['r2'];
if($etat==0){$tetat="envoyées";}
if($etat==1){$tetat="à confirmer";}
if($etat==2){$tetat="classées";}
if($etat==3){$tetat="rejetées";}
include("convert.php");
$a1 = new chiffreEnLettre();
$errone = false;
$id_user =$_SESSION['id_user'];
$query_demande = $bdd->prepare("select d.*, c.*,a.* from demande as d, accprest as u, polices as p, actes as c, adherents as a where d.id_user=u.id_user and d.id_pol=p.id_pol and d.id_act=c.id_act and d.id_adr=a.id_adr and  d.date_dem >= '$dated' and d.date_dem <= '$datef' and d.et_dem= $etat and $id_user");
$query_demande->execute();
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
$pdf->Cell(280,10,'Etat Statistique '.$tetat.' du '.date("d/m/Y", strtotime($dated)).' au '.date("d/m/Y", strtotime($datef)) ,'1','1','L','1');
//$pdf->Cell(30,5,'User:'.$nb,'1','0','C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,5,'Demande N°','1','0','C');$pdf->Cell(80,5,'Nom-Prénom-Adhérent','1','0','C');$pdf->Cell(70,5,'Acte','1','0','C');$pdf->Cell(40,5,'Mtt-Demandé','1','0','C');$pdf->Cell(30,5,'Mtt-Supporté','1','0','C');$pdf->Cell(30,5,'Charge-CNAS','1','0','C');$pdf->Ln();
$fr=0;$cnas=0;$remb=0;
while ($row_demande =$query_demande->fetch()){
$pdf->Cell(30,5,''.str_pad((int) $row_demande['id_dem'],'7',"0",STR_PAD_LEFT).'','1','0','C');
$pdf->Cell(80,5,''.$row_demande['nom_adr'].'-'.$row_demande['prenom_adr'].'','1','0','C');
$pdf->Cell(70,5,''.$row_demande['lib_act'].'','1','0','C');
$pdf->Cell(40,5,''.number_format($row_demande['fr_dem'], 2,',',' ').'','1','0','C');$fr=$fr+$row_demande['fr_dem'];
$pdf->Cell(30,5,''.number_format($row_demande['cnas_dem'], 2,',',' ').'','1','0','C');$cnas=$cnas+$row_demande['cnas_dem'];
$pdf->Cell(30,5,''.number_format($row_demande['mtt_remb'], 2,',',' ').'','1','0','C');$remb=$remb+$row_demande['mtt_remb'];
$pdf->Ln();
}
$pdf->Cell(180,5,'TOTAUX','1','0','C');$pdf->Cell(40,5,''.number_format($fr, 2,',',' ').'','1','0','C');$pdf->Cell(30,5,''.number_format($cnas, 2,',',' ').'','1','0','C');$pdf->Cell(30,5,''.number_format($remb, 2,',',' ').'','1','0','C');

$pdf->Output();


















}
?>