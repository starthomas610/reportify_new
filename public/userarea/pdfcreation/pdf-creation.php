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
$materialrsllist = new WA_MySQLi_RS("materialrsllist", $repnew, 0);
$materialrsllist->setQuery("SELECT DISTINCT material_id,name_material FROM analysis_rsl LEFT JOIN material_type ON analysis_rsl.material_id=material_type.idmaterial_type  WHERE analysis_rsl.rsl_id='$idrsl' ORDER BY analysis_rsl.material_id");
$materialrsllist->execute();
?>
<?php
$countmaterial = $materialrsllist->TotalRows;
$countotalcolumn = $countmaterial;
$colsizemod = 195 / $countotalcolumn;

?>
<?php
$idmaterial = $materialrsllist->getColumnVal("idmaterial_type");
?>
<?php // group analysis_id for specific rsl  (it will decide number of lines)
?>
<?php
$materialanalysislist = new WA_MySQLi_RS("materialanalysislist", $repnew, 0);
$materialanalysislist->setQuery("SELECT DISTINCT analysis_id FROM analysis_rsl WHERE analysis_rsl.rsl_id='$idrsl' ORDER BY analysis_rsl.analysis_id");
$materialanalysislist->execute(); ?>

        <?php

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


            $this->SetFont('Arial', 'B', 14);
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
            $this->SetFont('Arial', '', 8);

            // Page number

            $this->Cell(0, 10, 'Synoptic Table - Reportify.cloud - Page n.' . $this->PageNo() . '/{nb}', 0, 0, 'C');
          }
        }

        // Instanciation of inherited class
        $pdf = new PDF('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 9);


        //$pdf->Cell(0,0,'Ai sensi e per gli effetti dell’art. 6 del REG 01 "Regolamento per la valutazione della conformità dei Dispositivi di Protezione',0,1);


        // from here start customization based on certification required required




        //othercertificate


        $titlerslcomp = $rsldet->getColumnVal("name") . '- Ver. ' . $rsldet->getColumnVal("version");

        $pdf->SetFont('Arial', '', 9);

        $pdf->SetFont('', 'B', '10');
        $pdf->Cell(275, 6, $titlerslcomp, 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('', '', 9);
        $pdf->Cell(80, 6, 'Tests', 1, 0, 'C');
        $pdf->SetFillColor(232, 242, 255);


        $wa_startindex = 0;
        while (!$materialrsllist->atEnd()) {
          $wa_startindex = $materialrsllist->Index;


          $pdf->Cell($colsizemod, 6, $materialrsllist->getColumnVal("name_material"), 1, 0, 'C', TRUE);

          $materialrsllist->moveNext();
        }
        $materialrsllist->moveFirst(); //return RS to first record
        unset($wa_startindex);
        unset($wa_repeatcount);
        //$pdf->Cell(70,50,'Terza',1,0,'C');
        //$pdf->Cell( 70, 42, $pdf->Image('', $pdf->GetX() + 10, $pdf->GetY(), 42), 1, 0, 'C');

        $pdf->Ln();

        //start second line
        $wa_startindex = 0;
        while (!$materialanalysislist->atEnd()) {
          $wa_startindex = $materialanalysislist->Index;
          $idanalysis = ($materialanalysislist->getColumnVal("analysis_id"));
          $analysisname = new WA_MySQLi_RS("analysisname", $repnew, 1);
          $analysisname->setQuery("SELECT * FROM analysis WHERE analysis.idanalysis='$idanalysis'");
          $analysisname->execute();


          $pdf->Cell(80, 6, $analysisname->getColumnVal("name_analysis"), 1, 0, 'C');

          $idmaterialrsl = new WA_MySQLi_RS("idmaterialrsl", $repnew, 0);
          $idmaterialrsl->setQuery("SELECT DISTINCT analysis_rsl.material_id FROM analysis_rsl WHERE analysis_rsl.rsl_id='$idrsl' ORDER BY analysis_rsl.material_id");
          $idmaterialrsl->execute();

          //repeated column
          $wa_startindex = 0;
          while (!$idmaterialrsl->atEnd()) {
            $wa_startindex = $idmaterialrsl->Index;
            $idmaterial = $idmaterialrsl->getColumnVal("material_id");
            $crosscheck = new WA_MySQLi_RS("crosscheck", $repnew, 1);
            $crosscheck->setQuery("SELECT * FROM analysis_rsl WHERE analysis_rsl.analysis_id='$idanalysis'  AND analysis_rsl.rsl_id='$idrsl'  AND analysis_rsl.material_id='$idmaterial'");
            $crosscheck->execute();

            if (empty($crosscheck->getColumnVal("idanalysis_rsl"))) {
              $flagvar = "";
            } else {
              $flagvar = "X";
            }

            $pdf->Cell($colsizemod, 6, $flagvar, 1, 0, 'C', TRUE);

            $idmaterialrsl->moveNext();
          }
          $idmaterialrsl->moveFirst(); //return RS to first record
          unset($wa_startindex);
          unset($wa_repeatcount);
          $pdf->Ln();
          $materialanalysislist->moveNext();
        }
        $materialanalysislist->moveFirst(); //return RS to first record
        unset($wa_startindex);
        unset($wa_repeatcount);






        //outpt pdf

        //$pdf->Output();
        $filepathname = 'synoptictable ' . $rsldet->getColumnVal("name") . '- Ver. ' . $rsldet->getColumnVal("version") . '.pdf';
        $filename = $filepathname;
        $pdf->Output($filename, 'D');

        //$UpdateQuery = new WA_MySQLi_Query($cmctrfdb);
        //$UpdateQuery->Action = "update";
        //$UpdateQuery->Table = "`trf-details`";
        //$UpdateQuery->bindColumn("pdffilename", "s", "$filepathname", "WA_DEFAULT");
        //$UpdateQuery->addFilter("idtrfdetails", "=", "i", "".($idtrf)  ."");
        //$UpdateQuery->execute();
        //$UpdateGoTo = "";
        //if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
        //$UpdateQuery->redirect($UpdateGoTo);
        ?>

