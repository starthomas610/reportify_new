<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php");
?>
<?php if (isset($_GET['idanalysis'])) {
    $idanalysis = $_GET['idanalysis'];
}
if (isset($_GET['idanalysisrsl'])) {
    $idanalysisrsl = $_GET['idanalysisrsl'];
}
if (isset($_GET['idmaterial'])) {
    $idmaterial = $_GET['idmaterial'];
}
if ((isset($_POST['methodsname'])) && ($_POST['methodsname'] != '')) {
    $methodsname = $_POST['methodsname'];
} else {
    $methodsname = 'abracadabra';
}
if ((isset($_POST['methodsnumber'])) && ($_POST['methodsnumber'] != '')) {
    $methodsnumber = $_POST['methodsnumber'];
} else {
    $methodsnumber = 'abracadabra';
}
if (isset($_GET['updmeth'])) {
    $updmeth = $_GET['updmeth'];
}
if (isset($_GET['idmethods'])) {
    $idmethods = $_GET['idmethods'];
}
?>
<?php if (isset($updmeth)) {

    $UpdateQuery = new WA_MySQLi_Query($repnew);
    $UpdateQuery->Action = "update";
    $UpdateQuery->Table = "`analysis_rsl`";
    $UpdateQuery->bindColumn("idmethods", "i", "" . ((isset($_GET["idmethods"])) ? $_GET["idmethods"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->addFilter("idanalysis_rsl", "=", "i", "" . ($_GET['idanalysisrsl']) . "");
    $UpdateQuery->execute();
    $UpdateGoTo = "";
    if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo ? rel2abs($UpdateGoTo, dirname(__FILE__)) : "";
    $UpdateQuery->redirect($UpdateGoTo);
}
?>

<?php
//echo $methodsnumber;
//echo $methodsname;
$querybuildselect = "SELECT * FROM standards WHERE ";
if ($methodsname != 'abracadabra') {
    $querybuild2 = "standards.titlestandards LIKE '%$methodsname%'";
} else {
    $querybuild2 = "";
}
if ($methodsnumber != 'abracadabra') {
    $querybuild3 = "standards.numberstandards LIKE '%$methodsnumber%'";
} else {
    $querybuild3 = "";
}

$querybuildorder = " ORDER BY standards.numberstandards";

if (($querybuild2 != '') && (($querybuild3 != ''))) {
    $queryand1 = " AND ";
} else {
    $queryand1 = '';
}
if (($querybuild3 != '')) {
    $queryand2 = " AND ";
} else {
    $queryand2 = '';
}

if (isset($_POST['querysearchform'])) {
    $querybuildtotal = $querybuildselect . $querybuild2 . $queryand1 . $querybuild3 . $querybuildorder;
    //echo $querybuildtotal;

    //$querylist="SELECT * FROM component WHERE component.name_component LIKE '%$compname%' OR component.cas_component='$casnum'  OR component.component_family_id='$familycat'  OR component.component_family_type='$maincat' ORDER BY component.name_component";

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <?php include('../include/seo.php'); ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <?php //include('../include/navigationbar.php'); 
        ?>

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <?php //include('../include/topbar.php'); 
                ?>

                <div class="page-content-wrapper ">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-right">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            <li class="breadcrumb-item"><a href="#">Reportify</a></li>
                                            <li class="breadcrumb-item active">EasySpec</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">EasySpec</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title pb-3 mt-0">Search your method and add to the analysis: <?php echo ($analysisdet->getColumnVal("name_analysis")); ?></h5>

                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm sm-0">
                                                <thead style="background-color:#66ccff">
                                                    <tr>
                                                        <th><strong>Methods Name</strong></th>
                                                        <th><strong>Methods Number</strong></th>

                                                        <th width="200"></th>
                                                    </tr>
                                                </thead>
                                                <form method="post" title="querysearch" id="querysearch">
                                                    <input type="hidden" id="querysearchform" name="querysearchform" value="querysearchform">
                                                    <tbody class="table-primary">
                                                        <tr>
                                                            <td>
                                                                <div>
                                                                    <input class="form-control" type="text" placeholder="Methods Name" id="methodsname" name="methodsname">
                                                                </div>
                                                            </td>


                                                            <td>
                                                                <div>
                                                                    <input class="form-control" type="text" placeholder="Methods Name" id="methodsnumber" name="methodsnumber">
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
                                        </div><!--end table-responsive-->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title pb-3 mt-0">Method List</h5>

                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm sm-0">
                                                <thead>
                                                    <tr>

                                                        <th><strong>Methods Name</strong></th>
                                                        <th><strong>Methods Number</strong></th>
                                                        <th><strong>Year</strong></th>





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
                                                                <td><?php echo $searchenginequery->getColumnVal("titlestandards"); ?></td>
                                                                <td><?php echo $searchenginequery->getColumnVal("numberstandards"); ?></td>
                                                                <td><?php echo $searchenginequery->getColumnVal("yearstandards"); ?></td>





                                                                <td><a class="btn btn-danger" href="searchenginemethod.php?idanalysis=<?php echo $analysisdet->getColumnVal("idanalysis"); ?>&idmethods=<?php echo $searchenginequery->getColumnVal("idstandards"); ?>&updmeth=Y&idmaterial=<?php echo $idmaterial; ?>&idanalysisrsl=<?php echo $idanalysisrsl; ?>" role="button"><?php echo $addtitle; ?></a></td>
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
                                        </div><!--end table-responsive-->
                                        <button onclick="self.close()" type="button" class="btn btn-success waves-effect waves-light"><?php echo $closewindowtitle; ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <?php include('../include/footer.php'); ?>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->


    <!-- plugin JS  -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/modernizr.min.js"></script>
    <script src="../assets/js/detect.js"></script>
    <script src="../assets/js/fastclick.js"></script>
    <script src="../assets/js/jquery.slimscroll.js"></script>
    <script src="../assets/js/jquery.blockUI.js"></script>
    <script src="../assets/js/waves.js"></script>
    <script src="../assets/js/jquery.nicescroll.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>

    <script src="../assets/plugins/chart.js/chart.min.js"></script>
    <script src="../assets/pages/dashboard.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.js"></script>


</body>

</html>