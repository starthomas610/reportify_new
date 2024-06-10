<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php"); ?>

<?php if (true) {
    $DeleteQuery = new WA_MySQLi_Query($repnew);
    $DeleteQuery->Action = "delete";
    $DeleteQuery->Table = "`rsl_category`";
    $DeleteQuery->addFilter("idrslcat", "=", "i", "" . ($_GET['idrslcat']) . "");
    $DeleteQuery->execute();
    $DeleteGoTo = "rsl-category.php";
    if (function_exists("rel2abs")) $DeleteGoTo = $DeleteGoTo ? rel2abs($DeleteGoTo, dirname(__FILE__)) : "";
    $DeleteQuery->redirect($DeleteGoTo);
}
?>