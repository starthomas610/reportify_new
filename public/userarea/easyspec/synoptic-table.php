<?php include('../include/headscript.php'); ?>
<?php //include("class/company.php"); 
?>
<?php if (isset($_GET['idrsl'])) {
    $idrsl = $_GET['idrsl'];
}  ?>
<?php
$rsldet = new WA_MySQLi_RS("rsldet", $repnew, 1);
$rsldet->setQuery("SELECT * FROM rsl WHERE rsl.id='$idrsl'");
$rsldet->execute();
?>
<?php
$materialrsllist = new WA_MySQLi_RS("materialrsllist", $repnew, 0);
$materialrsllist->setQuery("SELECT DISTINCT material_id,name_material FROM analysis_rsl LEFT JOIN material_type ON analysis_rsl.material_id=material_type.idmaterial_type  WHERE analysis_rsl.rsl_id='$idrsl' ORDER BY analysis_rsl.material_id");
$materialrsllist->execute();

?>
<?php
$idmaterial = $materialrsllist->getColumnVal("idmaterial_type");
?>
<?php // group analysis_id for specific rsl  (it will decide number of lines)
?>
<?php
$materialanalysislist = new WA_MySQLi_RS("materialanalysislist", $repnew, 0);
$materialanalysislist->setQuery("SELECT DISTINCT analysis_id FROM analysis_rsl WHERE analysis_rsl.rsl_id='$idrsl' ORDER BY analysis_rsl.analysis_id");
$materialanalysislist->execute(); ?>
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
    <style>
        .table-custom tr {
            height: 40px;
            line-height: 40px;
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

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-0"><?php echo ($rsldet->getColumnVal("name")); ?>- Ver. <?php echo ($rsldet->getColumnVal("version")); ?></h5>
                                        <br>

                                        <button type="button" class="btn btn-dark" onclick="window.history.back();"><?php echo $back; ?></button>
                                        <a href="../pdfcreation/pdf-creation.php?idrsl=<?php echo $idrsl; ?>"><button type="button" class="btn btn-danger"><i class="far fa-file-pdf font-size-16 align-middle"></i></button></a>
                                        <button type="button" class="btn btn-success"><i class="far fa-file-excel font-size-16 align-middle"></i></button>
                                        <br><br>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm sm-0">
                                                <thead>

                                                    <tr>

                                                        <th><strong>Analysis</strong></th>
                                                        <?php
                                                        $wa_startindex = 0;
                                                        while (!$materialrsllist->atEnd()) {
                                                            $wa_startindex = $materialrsllist->Index;
                                                        ?>

                                                            <th><strong><?php echo ($materialrsllist->getColumnVal("name_material")); ?></strong></th>



                                                        <?php
                                                            $materialrsllist->moveNext();
                                                        }
                                                        $materialrsllist->moveFirst(); //return RS to first record
                                                        unset($wa_startindex);
                                                        unset($wa_repeatcount);
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $wa_startindex = 0;
                                                    while (!$materialanalysislist->atEnd()) {
                                                        $wa_startindex = $materialanalysislist->Index;
                                                    ?>

                                                        <tr>
                                                            <th><?php $idanalysis = ($materialanalysislist->getColumnVal("analysis_id"));
                                                                $analysisname = new WA_MySQLi_RS("analysisname", $repnew, 1);
                                                                $analysisname->setQuery("SELECT * FROM analysis WHERE analysis.idanalysis='$idanalysis'");
                                                                $analysisname->execute();
                                                                echo $analysisname->getColumnVal("name_analysis");
                                                                ?></th>
                                                            <?php //query materials
                                                            ?>
                                                            <?php
                                                            $idmaterialrsl = new WA_MySQLi_RS("idmaterialrsl", $repnew, 0);
                                                            $idmaterialrsl->setQuery("SELECT DISTINCT analysis_rsl.material_id FROM analysis_rsl WHERE analysis_rsl.rsl_id='$idrsl' ORDER BY analysis_rsl.material_id");
                                                            $idmaterialrsl->execute();
                                                            ?>
                                                            <?php
                                                            $wa_startindex = 0;
                                                            while (!$idmaterialrsl->atEnd()) {
                                                                $wa_startindex = $idmaterialrsl->Index;
                                                            ?> <td>
                                                                    <?php
                                                                    $idmaterial = $idmaterialrsl->getColumnVal("material_id");
                                                                    $crosscheck = new WA_MySQLi_RS("crosscheck", $repnew, 1);
                                                                    $crosscheck->setQuery("SELECT * FROM analysis_rsl WHERE analysis_rsl.analysis_id='$idanalysis'  AND analysis_rsl.rsl_id='$idrsl'  AND analysis_rsl.material_id='$idmaterial'");
                                                                    $crosscheck->execute(); ?>


                                                                    <?php if (empty($crosscheck->getColumnVal("idanalysis_rsl"))) {
                                                                        echo "";
                                                                    } else { ?><button type="button" class="btn btn-success waves-effect waves-light"><i class="bx bx-check-double font-size-16 align-middle"></i></button><?php } ?>
                                                                </td> <?php
                                                                        $idmaterialrsl->moveNext();
                                                                    }
                                                                    $idmaterialrsl->moveFirst(); //return RS to first record
                                                                    unset($wa_startindex);
                                                                    unset($wa_repeatcount);
                                                                        ?>
                                                        </tr>

                                                    <?php
                                                        $materialanalysislist->moveNext();
                                                    }
                                                    $materialanalysislist->moveFirst(); //return RS to first record
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

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Selezioniamo tutti i bottoni con la classe 'clone-btn'
                                let cloneBtns = document.querySelectorAll('.clone-btn');

                                // Aggiungiamo un ascoltatore d'evento a ciascun bottone
                                cloneBtns.forEach(cloneBtn => {
                                    cloneBtn.addEventListener('click', function(e) {
                                        // Preveniamo il comportamento predefinito del link
                                        e.preventDefault();

                                        Swal.fire({
                                            title: 'Clone TRL',
                                            text: "Do you want to clone the TRL?",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Proceed',
                                            cancelButtonText: 'Cancel',
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Se confermato, andiamo al link originale
                                                window.location.href = cloneBtn.getAttribute('href');
                                            }
                                        });
                                    });
                                });
                            });
                        </script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Selezioniamo tutti i bottoni con la classe 'clone-btn'
                                let cloneBtns = document.querySelectorAll('.rev-btn');

                                // Aggiungiamo un ascoltatore d'evento a ciascun bottone
                                cloneBtns.forEach(cloneBtn => {
                                    cloneBtn.addEventListener('click', function(e) {
                                        // Preveniamo il comportamento predefinito del link
                                        e.preventDefault();

                                        Swal.fire({
                                            title: 'Revise TRL',
                                            text: "Do you want to Revise the TRL?",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Proceed',
                                            cancelButtonText: 'Cancel',
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Se confermato, andiamo al link originale
                                                window.location.href = cloneBtn.getAttribute('href');
                                            }
                                        });
                                    });
                                });
                            });
                        </script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Selezioniamo tutti i bottoni con la classe 'clone-btn'
                                let cloneBtns = document.querySelectorAll('.canc-btn');

                                // Aggiungiamo un ascoltatore d'evento a ciascun bottone
                                cloneBtns.forEach(cloneBtn => {
                                    cloneBtn.addEventListener('click', function(e) {
                                        // Preveniamo il comportamento predefinito del link
                                        e.preventDefault();

                                        Swal.fire({
                                            title: 'Cancel TRL',
                                            text: "Do you want to cancel the TRL?",
                                            icon: 'danger',
                                            showCancelButton: true,
                                            confirmButtonText: 'Proceed',
                                            cancelButtonText: 'Cancel',
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Se confermato, andiamo al link originale
                                                window.location.href = cloneBtn.getAttribute('href');
                                            }
                                        });
                                    });
                                });
                            });
                        </script>
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