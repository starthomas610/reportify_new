<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php");
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
    <!-- Inserire nel <head> del documento HTML -->



    <!-- Bootstrap Select CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" rel="stylesheet">

    <!-- jQuery (necessario per Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

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

        <?php include('../include/navigationbar.php'); ?>

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <?php include('../include/topbar.php'); ?>

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
                        <?php

                        if ($_SERVER["REQUEST_METHOD"] === "POST") {

                            $idanalysis = $_POST['idanalysis'];
                            $idcomponent = $_POST['component'];
                            include('check-comp-present.php');
                            $idancompo = $checkcomp->getColumnVal("idanalysiscomponent");
                            if (empty($idancompo)) {

                                if ($kindofrole == '3') {

                                    $InsertQuery = new WA_MySQLi_Query($repnew);
                                    $InsertQuery->Action = "insert";
                                    $InsertQuery->Table = "analysis_componenttemplate";
                                    $InsertQuery->bindColumn("idanalysis", "i", "" . ((isset($_POST["idanalysis"])) ? $_POST["idanalysis"] : "")  . "", "WA_DEFAULT");
                                    $InsertQuery->bindColumn("idcomponent", "i", "" . ((isset($_POST["component"])) ? $_POST["component"] : "")  . "", "WA_DEFAULT");
                                    $InsertQuery->saveInSession("");
                                    $InsertQuery->execute();
                                    $InsertGoTo = "";
                                    if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo ? rel2abs($InsertGoTo, dirname(__FILE__)) : "";
                                    $InsertQuery->redirect($InsertGoTo);
                                } else {

                                    $InsertQuery = new WA_MySQLi_Query($repnew);
                                    $InsertQuery->Action = "insert";
                                    $InsertQuery->Table = "analysis_component";
                                    $InsertQuery->bindColumn("idanalysis", "i", "" . ((isset($_POST["idanalysis"])) ? $_POST["idanalysis"] : "")  . "", "WA_DEFAULT");
                                    $InsertQuery->bindColumn("idcomponent", "i", "" . ((isset($_POST["component"])) ? $_POST["component"] : "")  . "", "WA_DEFAULT");
                                    $InsertQuery->saveInSession("");
                                    $InsertQuery->execute();
                                    $InsertGoTo = "";
                                    if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo ? rel2abs($InsertGoTo, dirname(__FILE__)) : "";
                                    $InsertQuery->redirect($InsertGoTo);
                                }


                        ?>
                                <div class="alert alert-success"><i class="fa fa-check"></i> <?php echo $componentaddedtitle; ?> </div>

                            <?php
                            }
                            if (!empty($idancompo)) {
                            ?>


                                <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> <?php echo $componentnotaddedtitle; ?> </div>

                        <?php        }
                        }
                        ?>
                        <?php $idanalysis = $_GET['idanalysis']; ?><?php $tablequery = new WA_MySQLi_RS("analysis", $repnew, 0);
                                                                    $tablequery->setQuery("SELECT * FROM `analysis` WHERE analysis.idanalysis='$idanalysis'");
                                                                    $tablequery->execute();
                                                                    ?>
                        <?php
                        $componentlist = new WA_MySQLi_RS("componentlist", $repnew, 0);
                        $componentlist->setQuery("SELECT * FROM component WHERE component.company_id='$idcompany' ORDER BY component.name_component");
                        $componentlist->execute();
                        ?>
                        <?php
                        $companalysis = new WA_MySQLi_RS("companalysis", $repnew, 0);
                        $companalysis->setQuery("SELECT * FROM analysis_component LEFT JOIN component ON analysis_component.idcomponent=component.idcomponent WHERE analysis_component.idanalysis=$idanalysis ORDER BY component.name_component");
                        $companalysis->execute();
                        ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title pb-3 mt-0">EasySpec: <?php echo $dashboard; ?></h5>

                                        <div>
                                            <a class="btn btn-danger" href="update-analysis.php?idanalysis=<?php echo ($tablequery->getColumnVal("idanalysis")); ?>" role="button">Edit</a> <a class="btn btn-danger" href="analysis.php" role="button"><?php echo $analysis; ?></a> <a class="btn btn-danger" href="rsl.php" role="button">RSL</a><br><br>
                                            <h4 class="card-title">Analysis: <?php echo ($tablequery->getColumnVal("name_analysis")); ?> </h4>
                                            <h6 class="card-subtitle"><?php echo $textaddcomplist; ?><code></code></h6>
                                        </div><!--end table-responsive-->

                                        <form method="post" id="addcomp">
                                            <div class="mb-3 row">
                                                <div class="col-sm-4">
                                                    <?php echo $yourcomponentstitle; ?>
                                                    <select name="component" class="selectpicker m-b-20 m-r-10" id="component" data-style="btn-primary" data-live-search="true">
                                                        <?php while (!$componentlist->atEnd()) { ?>
                                                            <option value="<?php echo $componentlist->getColumnVal("idcomponent"); ?>">
                                                                <?php echo $componentlist->getColumnVal("name_component"); ?>
                                                            </option>
                                                        <?php $componentlist->moveNext();
                                                        }
                                                        $componentlist->moveFirst(); ?>
                                                    </select>
                                                    <input name="idanalysis" type="hidden" id="idanalysis" value="<?php echo $idanalysis; ?>">
                                                    <input name="Add" type="submit" id="Add" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </form>

                                        <a onclick="window.open('searchengine.php?idanalysis=<?php echo ($tablequery->getColumnVal("idanalysis")); ?>', '_blank', 'location=yes,height=720,width=1000,scrollbars=yes,status=yes');"><button type="button" class="btn btn-danger waves-effect waves-light"><?php echo $clickaddcomponentstitle; ?></button></a>
                                        <br><br>
                                        <div class="table-responsive">

                                            <table class="table table-striped table-sm sm-0">
                                                <thead>
                                                    <tr>

                                                        <th><?php echo $name_component_lang; ?></th>
                                                        <th><?php echo $description_component_lang; ?></th>
                                                        <th></th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $wa_startindex = 0;
                                                    while (!$companalysis->atEnd()) {
                                                        $wa_startindex = $companalysis->Index;
                                                    ?>
                                                        <tr>

                                                            <td><?php echo $companalysis->getColumnVal("name_component"); ?></td>
                                                            <td><?php echo $companalysis->getColumnVal("description_component"); ?></td>
                                                            <?php

                                                            ?>

                                                            <td><a class="btn btn-danger" href="cancel-componentanalysis.php?idanalysiscomponent=<?php echo ($companalysis->getColumnVal("idanalysiscomponent")); ?>&idanalysis=<?php echo $idanalysis; ?>" role="button">C</a></td>
                                                        </tr>
                                                    <?php
                                                        $companalysis->moveNext();
                                                    }
                                                    $companalysis->moveFirst(); //return RS to first record
                                                    unset($wa_startindex);
                                                    unset($wa_repeatcount);
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div><!--end table-responsive-->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


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
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

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