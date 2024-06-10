<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php"); ?>
<?php if (isset($_GET['idanalysis'])) {
    $idanalysis = $_GET['idanalysis'];
}
if (isset($_GET['idcomponent'])) {
    $idcomponent = $_GET['idcomponent'];
}  ?>
<?php
if (isset($_GET['idcomponent'])) {

    $checkcomponentpresent = new WA_MySQLi_RS("checkcomponentpresent", $repnew, 1);
    $checkcomponentpresent->setQuery("SELECT * FROM analysis_component WHERE analysis_component.idanalysis='$idanalysis'  AND analysis_component.idcomponent='$idcomponent'  AND analysis_component.idcompany='$idcompany'");
    $checkcomponentpresent->execute();

    if (empty($checkcomponentpresent->getColumnVal("idanalysiscomponent"))) {

        $InsertQuery = new WA_MySQLi_Query($repnew);
        $InsertQuery->Action = "insert";
        $InsertQuery->Table = "analysis_component";
        $InsertQuery->bindColumn("idanalysis", "i", "$idanalysis", "WA_DEFAULT");
        $InsertQuery->bindColumn("idcomponent", "i", "$idcomponent", "WA_DEFAULT");
        $InsertQuery->bindColumn("idcompany", "i", "$idcompany", "WA_DEFAULT");
        $InsertQuery->saveInSession("");
        $InsertQuery->execute();
        $InsertGoTo = "";
        if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo ? rel2abs($InsertGoTo, dirname(__FILE__)) : "";
        $InsertQuery->redirect($InsertGoTo);
    }
}
?>

<?php
if ($_GET['idanalysis'] != '') {
    $idanalysis = $_GET['idanalysis'];
}
//pickup post criteria search and query
if ((isset($_POST['compname'])) && ($_POST['compname'] != '')) {
    $compname = $_POST['compname'];
} else {
    $compname = 'abracadabra';
}
if ((isset($_POST['familycat'])) && ($_POST['familycat'] != '')) {
    $familycat = $_POST['familycat'];
} else {
    $familycat = 'abracadabra';
}
if ((isset($_POST['maincat'])) && ($_POST['maincat'] != '')) {
    $maincat = $_POST['maincat'];
} else {
    $maincat = 'abracadabra';
}
if ((isset($_POST['casnum'])) && ($_POST['casnum'] != '')) {
    $casnum = $_POST['casnum'];
} else {
    $casnum = 'abracadabra';
} ?>
<?php
//echo $compname;
//echo $familycat;
//echo $maincat;
//echo $casnum;
$querybuildselect = "SELECT * FROM component WHERE ";
if ($compname != 'abracadabra') {
    $querybuild2 = "component.name_component LIKE '%$compname%'";
} else {
    $querybuild2 = "";
}
if ($familycat != 'abracadabra') {
    $querybuild3 = "component.component_family_id='$familycat'";
} else {
    $querybuild3 = "";
}
if ($maincat != 'abracadabra') {
    $querybuild4 = "component.component_family_type='$maincat'";
} else {
    $querybuild4 = "";
}
if ($casnum != 'abracadabra') {
    $querybuild5 = "component.cas_component='$casnum'";
} else {
    $querybuild5 = "";
}
$querybuildorder = " ORDER BY component.name_component";

if (($querybuild2 != '') && (($querybuild3 != '') || ($querybuild4 != '') || ($querybuild5 != ''))) {
    $queryand1 = " AND ";
} else {
    $queryand1 = '';
}
if (($querybuild3 != '') && (($querybuild4 != '') || ($querybuild5 != ''))) {
    $queryand2 = " AND ";
} else {
    $queryand2 = '';
}
if (($querybuild4 != '') && ($querybuild5 != '')) {
    $queryand3 = " AND ";
} else {
    $queryand3 = '';
}


if (isset($_POST['querysearchform'])) {
    $querybuildtotal = $querybuildselect . $querybuild2 . $queryand1 . $querybuild3 . $queryand2 . $querybuild4 . $queryand3 . $querybuild5;
    //echo $querybuildtotal;

    $querylist = "SELECT * FROM component LEFT JOIN component_family ON component.component_family_id=component_family.idcomponentfamily LEFT JOIN component_family_type ON component.component_family_type=component_family_type.idcomponentfamilytype WHERE component.name_component LIKE '%$compname%' OR component.cas_component='$casnum'  OR component.component_family_id='$familycat'  OR component.component_family_type='$maincat' ORDER BY component.name_component";

    $searchenginequery = new WA_MySQLi_RS("searchenginequery", $repnew, 50);
    $searchenginequery->setQuery("$querybuildtotal");
    $searchenginequery->execute();
}
?>
<?php
$analysisdet = new WA_MySQLi_RS("analysisdet", $repnew, 1);
$analysisdet->setQuery("SELECT * FROM analysis WHERE analysis.idanalysis='$idanalysis'");
$analysisdet->execute();
?>
<?php
$fanilycatquery = new WA_MySQLi_RS("fanilycatquery", $repnew, 0);
$fanilycatquery->setQuery("SELECT * FROM component_family ORDER BY component_family.name_componentfamily");
$fanilycatquery->execute();
?>
<?php
$maincatquery = new WA_MySQLi_RS("maincatquery", $repnew, 0);
$maincatquery->setQuery("SELECT * FROM component_family_type ORDER BY component_family_type.name_componentfamilytype");
$maincatquery->execute(); ?>
<!doctype html>
<script type='text/javascript'>
    window.onunload = function() {
        window.opener.location.reload();
    }
</script>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?php echo $titlewebsite; ?></title>
    <?php //include('../include/metacont.php'); 
    ?>
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        .table-custom tr {
            height: 25px;
            line-height: 25px;
        }

        .table-custom td,
        .table-custom th {
            padding: 4px 8px;
        }

        .table-custom .btn {
            padding: 2px 15px;
            line-height: 1.7;
            font-size: 14px;
        }

        .form-row {
            display: flex;
            align-items: center;
            /* Questo allinea verticalmente gli elementi nella riga */
            gap: 10px;
            /* Questo crea una piccola distanza tra gli elementi nella riga */
        }

        .table-custom .form-control,
        .table-custom .form-select {
            height: 25px;
            /* Puoi modificare questo valore per adattarlo al tuo design */
            padding: 2px 6px;
            /* riduce la dimensione del padding */
            font-size: 14px;
            /* riduce la dimensione del font */
        }

        .table-custom .form-control-sm.analysis-input {
            height: 25px;
            /* Questo modifica la dimensione degli input con classe 'form-control-sm' e 'analysis-input' */
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
</head>


<body>
    <div id="layout-wrapper">
        <div class="page-content">
            <div class="alert alert-primary" role="alert">
                <?php echo $searcandaddtitle; ?><?php echo ($analysisdet->getColumnVal("name_analysis")); ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table table-striped table-sm sm-0">

                                    <thead style="background-color:#66ccff">
                                        <tr>
                                            <th><strong><?php echo $name_component_lang; ?></strong></th>
                                            <th><strong><?php echo $family_component_lang; ?></strong></th>
                                            <th><strong><?php echo $labfamily_component_lang; ?></strong></th>
                                            <th><strong><?php echo $cas_component_lang; ?></strong></th>
                                            <th width="200"></th>
                                        </tr>
                                    </thead>
                                    <form method="post" title="querysearch" id="querysearch">
                                        <input type="hidden" id="querysearchform" name="querysearchform" value="querysearchform">
                                        <tbody class="table-primary">
                                            <tr>
                                                <td>
                                                    <div>
                                                        <input class="form-control" type="text" placeholder="<?php echo $name_component_lang; ?>" id="compname" name="compname">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <select class="form-select" id="familycat" name="familycat">
                                                            <option value=""><?php echo $selecttitle; ?></option>
                                                            <?php
                                                            while (!$fanilycatquery->atEnd()) { //dyn select
                                                            ?>
                                                                <option value="<?php echo ($fanilycatquery->getColumnVal("idcomponentfamily")); ?>"><?php echo ($fanilycatquery->getColumnVal("name_componentfamily")); ?></option>
                                                            <?php
                                                                $fanilycatquery->moveNext();
                                                            } //dyn select
                                                            $fanilycatquery->moveFirst();
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-12">
                                                        <select class="form-select" id="maincat" name="maincat">
                                                            <option value=""><?php echo $selecttitle; ?></option>
                                                            <?php
                                                            while (!$maincatquery->atEnd()) { //dyn select
                                                            ?>
                                                                <option value="<?php echo ($maincatquery->getColumnVal("idcomponentfamilytype")); ?>"><?php echo ($maincatquery->getColumnVal("name_componentfamilytype")); ?></option>
                                                            <?php
                                                                $maincatquery->moveNext();
                                                            } //dyn select
                                                            $maincatquery->moveFirst();
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <input class="form-control" type="text" placeholder="<?php echo $cas_component_lang; ?>" id="casnum" name="casnum">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary w-md"><?php echo $searchgotitle; ?></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </form>
                                </table>
                            </div>


                            <div class="table-responsive table-custom">
                                <table class="table table-striped table-sm sm-0">
                                    <thead>
                                        <tr>

                                            <th><strong><?php echo $name_component_lang; ?></strong></th>
                                            <th><strong><?php echo $family_component_lang; ?></strong></th>
                                            <th><strong><?php echo $labfamily_component_lang; ?></strong></th>
                                            <th><strong><?php echo $cas_component_lang; ?></strong></th>




                                            <th width="200"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['querysearchform'])) {
                                            $wa_startindex = 0;
                                            while (!$searchenginequery->atEnd()) {
                                                $wa_startindex = $searchenginequery->Index;
                                        ?>
                                                <tr>
                                                    <td><?php echo $searchenginequery->getColumnVal("name_component"); ?></td>
                                                    <td><?php echo $searchenginequery->getColumnVal("name_componentfamily"); ?></td>
                                                    <td><?php echo $searchenginequery->getColumnVal("name_componentfamilytype"); ?></td>
                                                    <td><?php echo $searchenginequery->getColumnVal("cas_component"); ?></td>




                                                    <td><a class="btn btn-danger" href="searchengine.php?idanalysis=<?php echo $analysisdet->getColumnVal("idanalysis"); ?>&idcomponent=<?php echo $searchenginequery->getColumnVal("idcomponent"); ?>" role="button"><?php echo $addtitle; ?></a></td>
                                                </tr>
                                        <?php
                                                $searchenginequery->moveNext();
                                            }
                                            $searchenginequery->moveFirst(); //return RS to first record
                                            unset($wa_startindex);
                                            unset($wa_repeatcount);
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><button onclick="self.close()" type="button" class="btn btn-success waves-effect waves-light"><?php echo $closewindowtitle; ?></button>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/eva-icons/eva.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>