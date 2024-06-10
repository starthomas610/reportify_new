<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php"); ?>

<?php if (true) {
    $DeleteQuery = new WA_MySQLi_Query($repnew);
    $DeleteQuery->Action = "delete";
    $DeleteQuery->Table = "`standards`";
    $DeleteQuery->addFilter("idstandards", "=", "i", "" . ($_GET['id']) . "");
    $DeleteQuery->execute();
    $DeleteGoTo = "standards.php";
    if (function_exists("rel2abs")) $DeleteGoTo = $DeleteGoTo ? rel2abs($DeleteGoTo, dirname(__FILE__)) : "";
    $DeleteQuery->redirect($DeleteGoTo);
}
?>