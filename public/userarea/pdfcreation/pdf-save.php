<?php require_once('../../Connections/repnew.php'); ?>

<?php require_once('../../webassist/mysqli/rsobj.php');
require_once('../../webassist/mysqli/queryobj.php');
$idcompany = 1;
include('../class/company.php');
?>
<?php
//global variable
//include('include/generalsettings.php');

// start fpdf
require('../fpdf/fpdf.php');
include('../../languages/en/general.php');

//include('include/headscript.php');  
?>
<?php if (isset($_GET['idrsl'])) {
  $idrsl = $_GET['idrsl'];
}  ?>
<?php
$rsldet = new WA_MySQLi_RS("rsldet", $repnew, 1);
$rsldet->setQuery("SELECT * FROM rsl WHERE rsl.id='$idrsl'");
$rsldet->execute();
?>
<?php
// search material
?>
<?php
$materialrsllist = new WA_MySQLi_RS("materialrsllist", $repnew, 0);
$materialrsllist->setQuery("SELECT * FROM material_rsl LEFT JOIN material_type ON material_rsl.material_id=material_type.idmaterial_type  WHERE material_rsl.rsl_id='$idrsl' ORDER BY material_rsl.material_id");
$materialrsllist->execute();
?>
  <?php
  //start pdf
  class PDF extends FPDF
  {
    // Page header
    function Header()
    {
      // Logo
      $uplogo = '../uploadlogo/1-1659552441logo.jpg';
      $this->Image($uplogo, 5, 5, 60);
      $this->SetFont('Arial', '', 7);
      //$this->Cell(0,-5,'nome',0,0,"R");
      $this->Cell(-180, 25, 'Synoptic Table', 0, 0, "C");
      // Line break
      $this->Ln(20);
    }
    // Page footer
    function Footer()
    {
      // Position at 1.5 cm from bottom
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Helvetica', '', 8);
      // Page number
      $this->Cell(0, 10, 'TRL - Reportify.cloud - Page n.' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
  }
  // Instanciation of inherited class
  $pdf = new PDF('P', 'mm', 'A4');
  $pdf->AliasNbPages();
  $pdf->SetMargins(6, 6, 6);
  $pdf->SetAutoPageBreak(true, 8);
  $pdf->AddPage();
  $pdf->SetFont('Helvetica', '', 12);
  $titlerslcomp = 'TRL' . html_entity_decode($rsldet->getColumnVal("name")) . '- Ver. ' . html_entity_decode($rsldet->getColumnVal("version"));
  $pdf->SetFont('Helvetica', '', 9);
  $pdf->SetFont('', 'B', '14');
  $pdf->Cell(198, 6, $titlerslcomp, 0, 0, 'C');
  $pdf->Ln();
  $pdf->SetFont('', '', 9);
  $pdf->SetFillColor(232, 242, 255);
  ?>
<?php
$wa_startindex = 0;
while (!$materialrsllist->atEnd()) {
  $wa_startindex = $materialrsllist->Index;
?>
        <?php
        $pdf->Ln();
        $pdf->SetFont('', 'B', '9');
        $pdf->SetFillColor(252, 237, 210);
        $pdf->Cell(198, 6, 'Material/end use: ' . html_entity_decode($materialrsllist->getColumnVal("name_material"), ENT_QUOTES, 'UTF-8'), 1, 0, 'C', TRUE);
        $pdf->Ln();
        $pdf->Ln();


        // search analysis loop
        $idmaterial = $materialrsllist->getColumnVal("material_id"); ?>
                <?php
                $analysislistrsl = new WA_MySQLi_RS("analysislistrsl", $repnew, 0);
                $analysislistrsl->setQuery("SELECT * FROM analysis_rsl LEFT JOIN analysis ON analysis_rsl.analysis_id=analysis.idanalysis LEFT JOIN methods ON analysis_rsl.idmethods=methods.idmethods WHERE analysis_rsl.rsl_id='$idrsl' AND analysis_rsl.material_id='$idmaterial' ORDER BY analysis_rsl.analysis_id");
                $analysislistrsl->execute(); ?>
                <?php
                $wa_startindex = 0;
                while (!$analysislistrsl->atEnd()) {
                  $wa_startindex = $analysislistrsl->Index;
                ?>
<?php
                  //start loop analysis
                  $idanalysis = $analysislistrsl->getColumnVal("analysis_id");

                  $analysisnametitle = 'Analysis: ' . $analysislistrsl->getColumnVal("name_analysis");
                  $pdf->SetFillColor(195, 255, 217);
                  $pdf->SetFont('', 'B', '10');
                  $pdf->Cell(198, 6, $analysisnametitle, 1, 0, 'L', TRUE);
                  $pdf->Ln();
                  $pdf->SetFont('', 'I', '8');
                  $pdf->SetFillColor(245, 245, 245);
                  $methodsanalysisname = 'Method: ' . html_entity_decode($analysislistrsl->getColumnVal("methodsnumber"), ENT_QUOTES, 'UTF-8');
                  $pdf->Cell(198, 6, $methodsanalysisname, 1, 0, 'L', TRUE);
                  $pdf->Ln();

?>
<?php //start loop component
                  $componentanalysislist = new WA_MySQLi_RS("componentanalysislist", $repnew, 0);
                  $componentanalysislist->setQuery("SELECT * FROM analysis_component LEFT JOIN component ON analysis_component.idcomponent=component.idcomponent WHERE analysis_component.idanalysis='$idanalysis' AND analysis_component.idcompany='$idcompany' ORDER BY analysis_component.idanalysiscomponent");
                  $componentanalysislist->execute();

?>
        <?php
                  //start loop component
                  $idcomponent = $componentanalysislist->getColumnVal("idcomponent"); ?>
        <?php
                  $reqlist = new WA_MySQLi_RS("reqlist", $repnew, 0);
                  $reqlist->setQuery("SELECT * FROM requirement LEFT JOIN unit_measure ON unit_measure.id=requirement.unit_measure_id WHERE requirement.rsl_id='$idrsl' AND requirement.analysis_id='$idanalysis' AND requirement.component_id='$idcomponent'");
                  $reqlist->execute();
        ?>
<?php
                  $pdf->SetFillColor(155, 190, 255);
                  $pdf->SetFont('', 'B', '8');
                  $pdf->Cell(15, 6, 'Code', 1, 0, 'C', TRUE);
                  $pdf->Cell(83, 6, 'Component', 1, 0, 'C', TRUE);
                  $pdf->Cell(20, 6, 'CAS', 1, 0, 'C', TRUE);
                  $pdf->Cell(20, 6, 'Lower Limit', 1, 0, 'C', TRUE);
                  $pdf->Cell(20, 6, 'Upper Limit', 1, 0, 'C', TRUE);
                  $pdf->Cell(20, 6, 'LOQ', 1, 0, 'C', TRUE);
                  $pdf->Cell(20, 6, 'UM', 1, 0, 'C', TRUE);
                  $pdf->Ln();
                  $wa_startindex = 0;
                  while (!$componentanalysislist->atEnd()) {
                    $wa_startindex = $componentanalysislist->Index;
?>
        <?php
                    $pdf->SetFillColor(220, 232, 255);
                    $pdf->SetFont('', 'B', '8');
                    $pdf->Cell(15, 6, html_entity_decode($componentanalysislist->getColumnVal("component_map"), ENT_QUOTES, 'UTF-8'), 1, 0, 'L', TRUE);
                    $pdf->Cell(83, 6, html_entity_decode($componentanalysislist->getColumnVal("name_component"), ENT_QUOTES, 'UTF-8'), 1, 0, 'L', TRUE);
                    $pdf->Cell(20, 6, html_entity_decode($componentanalysislist->getColumnVal("cas_component"), ENT_QUOTES, 'UTF-8'), 1, 0, 'C', TRUE);
                    $pdf->Cell(20, 6, html_entity_decode($reqlist->getColumnVal("lowerlimit_requirements"), ENT_QUOTES, 'UTF-8'), 1, 0, 'C', TRUE);
                    $pdf->Cell(20, 6, html_entity_decode($reqlist->getColumnVal("upper_limit_requirements"), ENT_QUOTES, 'UTF-8'), 1, 0, 'C', TRUE);
                    $pdf->Cell(20, 6, html_entity_decode($reqlist->getColumnVal("loq_requirements"), ENT_QUOTES, 'UTF-8'), 1, 0, 'C', TRUE);
                    $pdf->Cell(20, 6, html_entity_decode($reqlist->getColumnVal("name"), ENT_QUOTES, 'UTF-8'), 1, 0, 'C', TRUE);
                    $pdf->Ln();


        ?>
        <?php
                    $componentanalysislist->moveNext();
                  }
                  $componentanalysislist->moveFirst(); //return RS to first record
                  unset($wa_startindex);
                  unset($wa_repeatcount);
                  $pdf->SetFillColor(245, 245, 245);
                  $pdf->SetFont('', '', '8');


                  $notevalue = 'Note: ' . html_entity_decode($analysislistrsl->getColumnVal("comment_anrsl"), ENT_QUOTES, 'UTF-8');
                  $pdf->Cell(198, 6, $notevalue, 1, 0, 'L', TRUE);

                  $pdf->Ln();
                  $pdf->Ln();
        ?>
<?php
                  $analysislistrsl->moveNext();
                }
                $analysislistrsl->moveFirst(); //return RS to first record
                unset($wa_startindex);
                unset($wa_repeatcount);
?>
        <?php

        $materialrsllist->moveNext();
      }
      $materialrsllist->moveFirst(); //return RS to first record
      unset($wa_startindex);
      unset($wa_repeatcount);
        ?>

<?php
//output pdf
$filepathname = 'rsl ' . $rsldet->getColumnVal("name") . '- Ver. ' . $rsldet->getColumnVal("version") . '.pdf';
$filename = $filepathname;
//$pdf->Output($filename,'F');
$filename1 = $filename;
$filepathname = '../trlstorage/' . $idrsl . '-' . time() . '.pdf';
$justFileName = basename($filepathname);
$pdf->Output($filepathname, 'F');

$query = "UPDATE rsl SET trlpdf = ? WHERE id = ?";
$stmt = $repnew->prepare($query);
$stmt->bind_param('si', $justFileName, $idrsl);
$stmt->execute();
$stmt->close();

$referer = $_SERVER['HTTP_REFERER'];
$separator = (parse_url($referer, PHP_URL_QUERY) == NULL) ? '?' : '&';
header('Location: ' . $referer . $separator . 'status=success');
exit;


?>

