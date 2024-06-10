<?php include('../include/headscript.php'); ?>

<?php //include("class/company.php"); 
?>
<?php $idrsl = $_GET['id']; ?>
<?php
if (true) {
  $DeleteQuery = new WA_MySQLi_Query($repnew);
  $DeleteQuery->Action = "delete";
  $DeleteQuery->Table = "material_rsl";
  $DeleteQuery->addFilter("idmaterial_rsl", "=", "i", "" . ($_GET['idmaterial_rsl'])  . "");
  $DeleteQuery->execute();
  $DeleteGoTo = "material-rsl.php?id=$idrsl";
  if (function_exists("rel2abs")) $DeleteGoTo = $DeleteGoTo ? rel2abs($DeleteGoTo, dirname(__FILE__)) : "";
  $DeleteQuery->redirect($DeleteGoTo);
}
?>
