<?php

$companydet = new WA_MySQLi_RS("companydet", $repnew, 1);
$companydet->setQuery("SELECT * FROM company WHERE company.id=$idcompany");
$companydet->execute();

// Verifica se ci sono risultati
if (empty($companydet->getColumnVal("id"))) {
  header("Location: insert-mycompany.php");
  exit;
}

$idcompany = $companydet->getColumnVal("id");
$namecompany = $companydet->getColumnVal("company_name");
$companyucode = $companydet->getColumnVal("companyucode");
?>
<?php
//check active modules
$checkmodules = new WA_MySQLi_RS("checkmodules", $repnew, 0);
$checkmodules->setQuery("SELECT * FROM activemodules LEFT JOIN modules ON activemodules.idmodules=modules.idmodules WHERE activemodules.idcompany=$idcompany AND activemodules.activemod='Y'");
$checkmodules->execute();
?>
<?php
//put active modules in array
$activemod = array();

$wa_startindex = 0;
while (!$checkmodules->atEnd()) {
  $wa_startindex = $checkmodules->Index;

  $activemod[] = $checkmodules->getColumnVal("idmodules");;

  $checkmodules->moveNext();
}
$checkmodules->moveFirst(); //return RS to first record
unset($wa_startindex);
unset($wa_repeatcount);

?>
