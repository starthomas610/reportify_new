<?php include('../include/headscript.php'); ?>
<?php //include("class/company.php"); 
?>
<?php if (isset($_POST['id'])) {
    $idrsl = $_POST['id'];
} ?>
<?php if (isset($_GET['id'])) {
    $idrsl = $_GET['id'];
} ?>

<?php
$tablequery = new WA_MySQLi_RS("tablequery", $repnew, 0);
$tablequery->setQuery("SELECT * FROM rsl LEFT JOIN rsl_category ON rsl.rsl_category_id=rsl_category.idrslcat WHERE rsl.id='$idrsl'");
$tablequery->execute();
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
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] === "POST") {

                            $idmaterial_type = $_POST['material'];
                            $idrsl = $_POST['id'];
                            include('check-mat-present.php');
                            $idmatpr = $checkmatpr->getColumnVal("idmaterial_rsl");
                            if (empty($idmatpr)) {

                                $InsertQuery = new WA_MySQLi_Query($repnew);
                                $InsertQuery->Action = "insert";
                                $InsertQuery->Table = "material_rsl";
                                $InsertQuery->bindColumn("material_id", "i", "" . ((isset($_POST["material"])) ? $_POST["material"] : "")  . "", "WA_DEFAULT");
                                $InsertQuery->bindColumn("rsl_id", "i", "" . ((isset($_POST["id"])) ? $_POST["id"] : "")  . "", "WA_DEFAULT");
                                $InsertQuery->saveInSession("");
                                $InsertQuery->execute();
                                $InsertGoTo = "";
                                if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo ? rel2abs($InsertGoTo, dirname(__FILE__)) : "";
                                $InsertQuery->redirect($InsertGoTo); ?>
                                <div class="alert alert-success"><i class="fa fa-check"></i> Material added! </div>
                            <?php
                            }
                            if (!empty($idmatpr)) {
                            ?>
                                <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Material not added. The Material was already present in the RSL. </div>
                        <?php        }
                        }
                        ?>
                        <!-- end page title end breadcrumb -->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-0">RSL <?php echo ($tablequery->getColumnVal("name")); ?> </h5>
                                        <br>

                                        <a class="btn btn-danger" href="update-rsl.php?id=<?php echo ($tablequery->getColumnVal("id")); ?>" role="button" data-toggle="tooltip" title="Edit TRL">Edit TRL</a>

                                        <a class="btn btn-danger" href="analysis.php" role="button">Analysis</a>
                                        <a class="btn btn-danger" href="material.php" role="button">Material</a>
                                        <a href="synoptic-table.php?idrsl=<?php echo ($tablequery->getColumnVal("id")); ?>"><button type="button" class="btn btn-success waves-effect waves-light" data-toggle="tooltip" title="Synoptic Table"><i class="bx bx-table font-size-16 align-middle"></i></button></a>
                                        <a href="pdfcreation/pdf-rsl.php?idrsl=<?php echo ($tablequery->getColumnVal("id")); ?>"><button type="button" class="btn btn-success waves-effect waves-light" data-toggle="tooltip" title="Print"><i class="bx bx-printer font-size-16 align-middle"></i></button></a>
                                        <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" title="Save PDF" onclick="showConfirmation(<?php echo ($tablequery->getColumnVal('id')); ?>)">
                                            <i class="fa fa-file-pdf font-size-16 align-middle"></i>
                                        </button>
                                        <!-- <a href="send-email-trl.php"> --><button type="button" id="btn_send_trl" class="btn btn-success waves-effect waves-light"><i class="bx bx-mail-send font-size-16 align-middle"></i> Send TRL to clients</button><!-- </a> -->


                                        <a class="btn btn-dark" href="javascript:void(0);" onclick="window.history.back();" role="button">Go Back</a><br><br>
                                        <div class="table-responsive">

                                            <table class="table table-striped table-sm sm-0">
                                                <thead style="background-color:pink">
                                                    <tr>
                                                        <th><strong><?php echo $name_lang; ?></strong></th>
                                                        <th><strong><?php echo $version_lang; ?></strong></th>
                                                        <th><strong><?php echo $description_lang; ?></strong></th>
                                                        <th><strong><?php echo $start_lang; ?></strong></th>
                                                        <th><strong><?php echo $end_lang; ?></strong></th>
                                                        <th><strong><?php echo $rsl_category_id_lang; ?></strong></th>
                                                        <th><strong><?php echo $active_lang; ?></strong></th>
                                                        <th><strong>PDF</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-danger">
                                                    <tr>
                                                        <td><?php echo ($tablequery->getColumnVal("name")); ?></td>
                                                        <td><?php echo ($tablequery->getColumnVal("version")); ?></td>
                                                        <td><?php echo ($tablequery->getColumnVal("description")); ?></td>
                                                        <td><?php echo ($tablequery->getColumnVal("start")); ?></td>
                                                        <td><?php echo ($tablequery->getColumnVal("end")); ?></td>
                                                        <td><?php echo ($tablequery->getColumnVal("name_rslcat")); ?></td>
                                                        <td><?php $actstatus = $tablequery->getColumnVal("active");
                                                            if ($actstatus == "Y") { ?><button type="button" class="btn btn-success waves-effect waves-light"><i class="bx bx-check-double font-size-16 align-middle"></i></button><?php } else { ?><button type="button" class="btn btn-danger waves-effect waves-light"><i class="bx bx-block font-size-16 align-middle"></i></button><?php } ?></td>
                                                        <td>
                                                            <?php
                                                            $trlpdf = $tablequery->getColumnVal("trlpdf");
                                                            if (!empty($trlpdf)) {
                                                                echo '<a href="trlstorage/' . $trlpdf . '" target="_blank"><i class="fa fa-file-pdf red-pdf-icon"></i></a>';
                                                            }
                                                            ?>
                                                        </td>
                                                </tbody>
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
                                        <h4 class="mb-0"><?php echo $materialsadd; ?> - <?php echo $materialsaddlist; ?> </h4>
                                        <br>
                                        <?php
                                        $materiallist = new WA_MySQLi_RS("materiallist", $repnew, 0);
                                        $materiallist->setQuery("SELECT * FROM material_type WHERE material_type.company_id='$idcompany' ORDER BY material_type.name_material");
                                        $materiallist->execute();
                                        ?>

                                        <form method="post" class="form-control" id="addmaterial" style="display: flex; align-items: center; justify-content: flex-start;">
                                            <select class="select2 form-control custom-select select2-hidden-accessible" name="material" id="material" style="max-width: 200px;">
                                                <?php
                                                while (!$materiallist->atEnd()) {
                                                ?>
                                                    <option value="<?php echo ($materiallist->getColumnVal("idmaterial_type")); ?>">
                                                        <?php echo ($materiallist->getColumnVal("name_material")); ?>
                                                    </option>
                                                <?php
                                                    $materiallist->moveNext();
                                                }
                                                $materiallist->moveFirst();
                                                ?>
                                            </select>

                                            <input name="idcompany" type="hidden" id="idcompany">
                                            <input name="id" type="hidden" id="id" value="<?php echo ($tablequery->getColumnVal("id")); ?>">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="document.getElementById('addmaterial').submit();" style="white-space: nowrap;">
                                                Add
                                            </button>

                                        </form>


                                        <br>

                                        <table class="table table-striped table-sm sm-0">
                                            <thead>
                                                <tr>
                                                    <th><strong><?php echo $name_material_lang; ?></strong></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tablequery2 = new WA_MySQLi_RS("tablequery2", $repnew, 0);
                                                $tablequery2->setQuery("SELECT * FROM `material_rsl` LEFT JOIN material_type ON material_rsl.material_id=material_type.idmaterial_type WHERE material_rsl.rsl_id='$idrsl'");
                                                $tablequery2->execute();
                                                ?>


                                                <?php
                                                $wa_startindex = 0;
                                                while (!$tablequery2->atEnd()) {
                                                    $wa_startindex = $tablequery2->Index;
                                                ?>
                                                    <tr>
                                                        <td><?php echo ($tablequery2->getColumnVal("name_material")); ?></td>
                                                        <td><a class="btn btn-danger" href="detail-rsl.php?idmaterial_rsl=<?php echo ($tablequery2->getColumnVal("idmaterial_rsl")); ?>&id=<?php echo ($tablequery->getColumnVal("id")); ?>&material_id=<?php echo ($tablequery2->getColumnVal("material_id")); ?>" role="button">Add/Show Analysis List</a></td>
                                                        <td>
                                                            <a class="btn btn-danger" href="javascript:void(0);" role="button" data-toggle="tooltip" title="Delete" onclick="deleteMaterial(<?php echo ($tablequery2->getColumnVal('idmaterial_rsl')); ?>, <?php echo ($tablequery->getColumnVal('id')); ?>)">C</a>
                                                        </td>
                                                    <?php $tablequery2->moveNext();
                                                }
                                                $tablequery2->moveFirst(); //return RS to first record
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

                    <script src="assets/js/jquery-2.2.4.min.js"></script>
                    <script>
                        function deleteMaterial(idMaterialRsl, id) {
                            Swal.fire({
                                title: 'Do you want to delete this material from the TRL?',
                                showCancelButton: true,
                                confirmButtonText: 'Confirm',
                                cancelButtonText: 'Close',
                                reverseButtons: false,
                                confirmButtonColor: '#d33'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Se l'utente conferma, reindirizza alla pagina di cancellazione
                                    window.location.href = 'cancel-materialrsl.php?idmaterial_rsl=' + idMaterialRsl + '&id=' + id;
                                }
                            });
                        }

                        function sendNewsletter(idRsl) {
                            Swal.fire({
                                title: 'SayTRL: Do you want to distribute the TRL to your suppliers?',
                                showCancelButton: true,
                                confirmButtonText: 'Confirm',
                                cancelButtonText: 'Close',
                                reverseButtons: false, // "Confirm" viene mostrato prima di "Close"
                                confirmButtonColor: 'blue' // Colore rosso per il pulsante di conferma
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Se l'utente conferma, reindirizza alla pagina sendnewsletter.php
                                    window.location.href = 'sendnewsletter.php?idrsl=' + idRsl;
                                }
                            });
                        }
                    </script>
                    <script>
                        $(document).ready(function() {
                            // $('[data-toggle="tooltip"]').tooltip(); 
                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#btn_send_trl').on('click', function() {
                                $('.modal-body').html('<i class="fas fa-hourglass-start"></i> Sending email. Please wait...');
                                $('#successModal').modal('show');
                                $.ajax({
                                    url: 'include/send-email-trl-ajax.php',
                                    method: 'GET',
                                    dataType: 'json',
                                    data: {
                                        "action": "get_maillist",
                                        "idcompany": "<?php echo $idcompany; ?>",
                                    },
                                    success: function(response) {
                                        if (response.length > 0) {
                                            jsonObject = response;
                                            var index = 0;
                                            var success_counter = 0;
                                            var error_counter = 0;
                                            var sending_failed = "<font color=\"tomato\"><i class=\"fas fa-exclamation-triangle\"></i> Unable to send email to the following recipient(s):<br>";
                                            /* CREATE SEPARATE COUNTER FOR PROCESSED ITEMS */
                                            var n = 0;
                                            /* Define a function to process the JSON data */
                                            function processItem() {
                                                if (index < jsonObject.length) {
                                                    var item = jsonObject[index];
                                                    index++;
                                                    $.get('send-email-trl.php', {
                                                        idrsl: '<?php echo $idrsl; ?>',
                                                        mail_id: item.id,
                                                    }, function(response) {
                                                        if (response.trim() == 'ok') {
                                                            success_counter++
                                                        } else {
                                                            /* GET EMAIL ADDRESS IF SENDING FAILED */
                                                            sending_failed += '-' + response.trim() + '<br>'
                                                            error_counter++;
                                                        }

                                                        n++
                                                        if (success_counter > 0) {
                                                            /* SHOW MESSAGE IF ATLEAST 1 EMAIL SENT SUCCESSFULLY */
                                                            $('.modal-body').text(success_counter + ' of ' + jsonObject.length + ' email(s) sent.');
                                                        }
                                                        /* IF FINISHED SENDING EMAIL */
                                                        if (n >= jsonObject.length) {
                                                            if (success_counter > 0) {
                                                                /* SHOW MESSAGE IF ATLEAST 1 EMAIL SENT SUCCESSFULLY */
                                                                $('.modal-body').append('<br><br><i class="fas fa-check-circle"></i> Finished Sending Email.');
                                                            }
                                                            if (error_counter > 0) {
                                                                if (success_counter == 0) {
                                                                    /* CLEAR MODAL BODY */
                                                                    $('.modal-body').text('');
                                                                } else {
                                                                    /* ADD SPACER */
                                                                    $('.modal-body').append("<br><br>");
                                                                }
                                                                /* SHOW EMAIL FAILED */
                                                                $('.modal-body').append(sending_failed + '</font>');
                                                            }
                                                        }
                                                    });
                                                    /* Continue the loop after 2 seconds */
                                                    setTimeout(processItem, 2000);
                                                }
                                            }
                                            /* Start the loop */
                                            processItem();
                                        } else {
                                            $('.modal-body').text('Unable to send email. No recipient found.');
                                        }
                                    },
                                    error: function() {

                                    }
                                });
                            });
                        });
                    </script>
                    <script>
                        function showConfirmation(id) {
                            Swal.fire({
                                title: 'Do you want to delete this material from the TRL?',
                                showCancelButton: true,
                                confirmButtonText: 'Confirm',
                                cancelButtonText: 'Close',
                                reverseButtons: false,
                                confirmButtonColor: '#d33'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Se l'utente conferma, reindirizza alla pagina di cancellazione
                                    window.location.href = 'cancel-materialrsl.php?idmaterial_rsl=' + idMaterialRsl + '&id=' + id;
                                }
                            });

                        }
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