<?php
ini_set('display_errors', 1);
require_once('../../Connections/repnew.php');
require_once('../../webassist/mysqli/rsobj.php');
require_once('../../webassist/mysqli/queryobj.php');

/* UPDATE EXISTING RECORD */
if ((((isset($_POST["upformname"])) ? $_POST["upformname"] : "") != "")) {
    $UpdateQuery = new WA_MySQLi_Query($repnew);
    $UpdateQuery->Action = "update";
    $UpdateQuery->Table = "requirement";
    $UpdateQuery->bindColumn("idlistrequirements", "i", "" . ((isset($_POST["idrsllimits"])) ? $_POST["idrsllimits"] : "")  . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("loq_requirements", "s", "" . ((isset($_POST["loq"])) ? $_POST["loq"] : "")  . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("lowerlimit_requirements", "s", "" . ((isset($_POST["minlim"])) ? $_POST["minlim"] : "")  . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("upper_limit_requirements", "s", "" . ((isset($_POST["maxlim"])) ? $_POST["maxlim"] : "")  . "", "WA_DEFAULT");

    /* SET UM AS NOT REQUIRED */
    $UpdateQuery->bindColumn("unit_measure_id", "i", "" . $_POST["um"] . "", FALSE);

    $UpdateQuery->addFilter("idrequirements", "=", "i", "" . ($_POST['idrequirements'])  . "");

    $UpdateQuery->execute();

    if ($repnew->error) {
        echo "ERROR: " . $repnew->error;
    } else {
        echo "SUCCESS";
    }
}

/* CREATE NEW RECORD */
if ((((isset($_POST["insformname"])) ? $_POST["insformname"] : "") != "")) {
    $checkrecord = new WA_MySQLi_RS("checkrecord", $repnew, 0);
    $checkrecord->setQuery("SELECT * FROM requirement WHERE requirement.material_id='{$_POST["material_id"]}' AND requirement.rsl_id='{$_POST["rsl_id"]}' AND requirement.analysis_id='{$_POST["analysis_id"]}' AND requirement.component_id='{$_POST["component_id"]}'");
    $checkrecord->execute();
    $idrequirements = $checkrecord->getColumnVal("idrequirements");

    $ThisQuery = new WA_MySQLi_Query($repnew);
    $ThisQuery->Table = "requirement";

    if (empty($idrequirements)) {
        /* INSERT */
        $ThisQuery->Action = "insert";

        $ThisQuery->bindColumn("material_id", "i", "" . ((isset($_POST["material_id"])) ? $_POST["material_id"] : "")  . "", "WA_DEFAULT");
        $ThisQuery->bindColumn("rsl_id", "i", "" . ((isset($_POST["rsl_id"])) ? $_POST["rsl_id"] : "")  . "", "WA_DEFAULT");
        $ThisQuery->bindColumn("analysis_id", "i", "" . ((isset($_POST["analysis_id"])) ? $_POST["analysis_id"] : "")  . "", "WA_DEFAULT");
        $ThisQuery->bindColumn("component_id", "i", "" . ((isset($_POST["component_id"])) ? $_POST["component_id"] : "")  . "", "WA_DEFAULT");
        $ThisQuery->bindColumn("idlistrequirements", "i", "" . ((isset($_POST["idrsllimits"])) ? $_POST["idrsllimits"] : "")  . "", "WA_DEFAULT");
    } else {
        /* UPDATE */
        $ThisQuery->Action = "update";
    }

    $ThisQuery->bindColumn("loq_requirements", "s", "" . ((isset($_POST["loq"])) ? $_POST["loq"] : "")  . "", "WA_DEFAULT");
    $ThisQuery->bindColumn("lowerlimit_requirements", "s", "" . ((isset($_POST["minlim"])) ? $_POST["minlim"] : "")  . "", "WA_DEFAULT");
    $ThisQuery->bindColumn("upper_limit_requirements", "s", "" . ((isset($_POST["maxlim"])) ? $_POST["maxlim"] : "")  . "", "WA_DEFAULT");

    /* SET UM AS NOT REQUIRED */
    $ThisQuery->bindColumn("unit_measure_id", "i", "" . ((isset($_POST["um"])) ? $_POST["um"] : "")  . "", FALSE);

    if (!empty($idrequirements)) {
        $ThisQuery->addFilter("idrequirements", "=", "i", "" . $idrequirements . "");
    }

    $ThisQuery->execute();


    if ($repnew->error) {
        echo "ERROR: " . $repnew->error;
    } else {
        echo "SUCCESS";
    }
}
