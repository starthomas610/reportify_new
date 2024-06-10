
<?php
$checkanpr = new WA_MySQLi_RS("checkanpr", $repnew, 1);
$checkanpr->setQuery("SELECT * FROM analysis_rsl WHERE analysis_rsl.analysis_id='$idanalysis' AND analysis_rsl.rsl_id='$idrsl' AND analysis_rsl.material_id='$idmaterial_type'");
$checkanpr->execute();
?>