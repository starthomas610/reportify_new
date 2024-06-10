
<?php
$checkcomp = new WA_MySQLi_RS("checkcomp", $repnew, 1);
$checkcomp->setQuery("SELECT * FROM analysis_component WHERE analysis_component.idanalysis='$idanalysis'  AND analysis_component.idcomponent='$idcomponent'");
$checkcomp->execute();
?>

