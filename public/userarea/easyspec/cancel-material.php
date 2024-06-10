<?php include('../include/headscript.php'); ?>

<?php include("../class/company.php"); ?>
<?php
$DeleteQuery = new WA_MySQLi_Query($repnew);
$DeleteQuery->Action = "delete";
$DeleteQuery->Table = "`material_type`";
$DeleteQuery->addFilter("idmaterial_type", "=", "i", "" . ($_GET['idmaterial_type']) . "");
$DeleteQuery->execute();
$DeleteGoTo = "material.php";
if (function_exists("rel2abs")) $DeleteGoTo = $DeleteGoTo ? rel2abs($DeleteGoTo, dirname(__FILE__)) : "";
$DeleteQuery->redirect($DeleteGoTo);

?>