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
                                        <h5 class="header-title pb-3 mt-0">EasySpec: <?php echo $dashboard; ?></h5>
                                        <a class="btn btn-danger" href="insert-rsl.php" role="button"><?php echo $insertnewrsltitle; ?></a> <a class="btn btn-danger" href="rsl-category.php" role="button">RSL Category</a> <a class="btn btn-danger" href="material.php" role="button"><?php echo $materialstitle; ?></a> <a class="btn btn-danger" href="analysis.php" role="button">Analysis</a><?php if ($infobox == "wizard") { ?> <a class="btn btn-dark" href="rslwizard1.php" role="button">Back to Wizard</a><?php     } ?>
                                        <a href="component.php"><button type="button" class="btn btn-danger w-md waves-effect waves-light">Components</button></a>
                                        <a href="standards.php"><button type="button" class="btn btn-danger w-md waves-effect waves-light">Standards</button></a>

                                        <a href="saytrl-newsletter.php"><button type="button" class="btn btn-success w-lg waves-effect waves-light">SayTRL</button></a>
                                        <br><br>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm sm-0">
                                                <thead>
                                                    <tr>

                                                        <th><strong><?php echo $active_lang; ?></strong></th>
                                                        <th><strong><?php echo $name_lang; ?></strong></th>
                                                        <th><strong><?php echo $version_lang; ?></strong></th>
                                                        <th><strong><?php echo $description_lang; ?></strong></th>
                                                        <th><strong><?php echo $start_lang; ?></strong></th>
                                                        <th><strong><?php echo $rsl_category_id_lang; ?></strong></th>



                                                        <th width="170"></th>
                                                        <th width="120"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $rsllist = new WA_MySQLi_RS("rsl", $repnew, 0);
                                                    $rsllist->setQuery("SELECT * FROM rsl  LEFT JOIN rsl_category ON rsl.rsl_category_id=rsl_category.idrslcat WHERE rsl.company_id='$idcompany'");
                                                    $rsllist->execute();

                                                    $wa_startindex = 0;
                                                    while (!$rsllist->atEnd()) {
                                                        $wa_startindex = $rsllist->Index;
                                                    ?> <tr>
                                                            <td>
                                                                <?php $actstatus = $rsllist->getColumnVal("active");
                                                                if ($actstatus == "Y") { ?><button type="button" class="btn btn-success waves-effect waves-light" data-toggle="tooltip" title="Active"><i class="bx bx-check-double font-size-16 align-middle"></i></button><?php } else { ?><button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" title="Inactive"><i class="bx bx-block font-size-16 align-middle"></i></button><?php } ?></td>
                                                            <td><?php echo ($rsllist->getColumnVal("name")); ?></td>
                                                            <td><?php echo ($rsllist->getColumnVal("version")); ?></td>
                                                            <td><?php echo ($rsllist->getColumnVal("description")); ?></td>
                                                            <td><?php echo ($rsllist->getColumnVal("start")); ?></td>
                                                            <td><?php echo ($rsllist->getColumnVal("name_rslcat")); ?></td>



                                                            <td>
                                                                <a href="synoptic-table.php?idrsl=<?php echo ($rsllist->getColumnVal("id")); ?>"><button type="button" class="btn btn-success waves-effect waves-light" data-toggle="tooltip" title="Synoptic Table"><i class="bx bx-table font-size-16 align-middle"></i></button></a>
                                                                <a class="btn btn-success" href="material-rsl.php?id=<?php echo ($rsllist->getColumnVal("id")); ?>" role="button" data-toggle="tooltip" title="Go"><i class="fas fa-angle-double-right font-size-16 align-middle"></i></a>

                                                                <a class="btn btn-danger canc-btn" href="cancel-rsl.php?id=<?php echo ($rsllist->getColumnVal("id")); ?>" role="button" data-toggle="tooltip" title="Delete"><i class="fas fa-trash font-size-16 align-middle"></i></a>

                                                            </td>
                                                            <td>
                                                                <a class="btn btn-primary rev-btn" href="rev-rsl.php?id=<?php echo ($rsllist->getColumnVal("id")); ?>" role="button" data-toggle="tooltip" title="Revision"><i class="fa fa-history font-size-16 align-middle"></i></a>
                                                                <a class="btn btn-warning clone-btn" href="clone-rsl.php?id=<?php echo ($rsllist->getColumnVal("id")); ?>" role="button" data-toggle="tooltip" title="Clone"><i class="far fa-clone font-size-16 align-middle"></i></a>

                                                            </td>
                                                        </tr>
                                                    <?php $rsllist->moveNext();
                                                    }
                                                    $rsllist->moveFirst(); //return RS to first record
                                                    unset($wa_startindex);
                                                    unset($wa_repeatcount);

                                                    ?></tbody>
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