
<?php
$checkmatpr = new WA_MySQLi_RS("checkmatpr", $repnew, 1);
$checkmatpr->setQuery("SELECT * FROM material_rsl WHERE material_rsl.material_id='$idmaterial_type' AND material_rsl.rsl_id='$idrsl'");
$checkmatpr->execute();
?>

