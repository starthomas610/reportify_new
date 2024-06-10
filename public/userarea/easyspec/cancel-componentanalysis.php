<?php include('../include/headscript.php'); ?>

<?php include("../class/company.php");
$idanalysis = $_GET['idanalysis'];
?>

<?php
if (true) {
  $DeleteQuery = new WA_MySQLi_Query($repnew);
  $DeleteQuery->Action = "delete";
  $DeleteQuery->Table = "analysis_component";
  $DeleteQuery->addFilter("idanalysiscomponent", "=", "i", "" . ($_GET['idanalysiscomponent'])  . "");
  $DeleteQuery->execute();
  $DeleteGoTo = "update-component-list.php?idanalysis=$idanalysis";
  if (function_exists("rel2abs")) $DeleteGoTo = $DeleteGoTo ? rel2abs($DeleteGoTo, dirname(__FILE__)) : "";
  $DeleteQuery->redirect($DeleteGoTo);
}
?>
