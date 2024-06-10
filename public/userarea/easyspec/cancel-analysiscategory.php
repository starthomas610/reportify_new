<?php include('../include/headscript.php'); ?>

<?php include("../class/company.php"); ?>
<?php
?>
<?php if (true) {
    $DeleteQuery = new WA_MySQLi_Query($repnew);
    $DeleteQuery->Action = "delete";
    $DeleteQuery->Table = "`family_analysis`";
    $DeleteQuery->addFilter("idfamilyanalysis", "=", "i", "" . ($_GET['idfamilyanalysis']) . "");
    $DeleteQuery->execute();
    $DeleteGoTo = "analysis-category.php";
    if (function_exists("rel2abs")) $DeleteGoTo = $DeleteGoTo ? rel2abs($DeleteGoTo, dirname(__FILE__)) : "";
    $DeleteQuery->redirect($DeleteGoTo);
}
?>