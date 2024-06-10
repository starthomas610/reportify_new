<?php include('../include/headscript.php'); ?>

<?php include("../class/company.php"); ?>
<?php $idrsl = $_GET['id']; ?>
<?php $material_id = $_GET['material_id']; ?>
<?php $idmaterial_rsl = $_GET['idmaterial_rsl']; ?>
<?php
if (true) {
  $DeleteQuery = new WA_MySQLi_Query($repnew);
  $DeleteQuery->Action = "delete";
  $DeleteQuery->Table = "analysis_rsl";
  $DeleteQuery->addFilter("idanalysis_rsl", "=", "i", "" . ($_GET['idanalysis_rsl'])  . "");
  $DeleteQuery->execute();
  $DeleteGoTo = "detail-rsl.php?id=$idrsl&material_id=$material_id&idmaterial_rsl=$idmaterial_rsl";
  if (function_exists("rel2abs")) $DeleteGoTo = $DeleteGoTo ? rel2abs($DeleteGoTo, dirname(__FILE__)) : "";
  $DeleteQuery->redirect($DeleteGoTo);
}
?>
