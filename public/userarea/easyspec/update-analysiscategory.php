<?php include('../include/headscript.php'); ?>
<?php //include("class/company.php"); 
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $UpdateQuery = new WA_MySQLi_Query($repnew);
    $UpdateQuery->Action = "update";
    $UpdateQuery->Table = "`family_analysis`";
    $UpdateQuery->bindColumn("namefamily", "s", "" . ((isset($_POST["namefamily"])) ? $_POST["namefamily"] : "") . "", "WA_DEFAULT");

    $UpdateQuery->addFilter("idfamilyanalysis", "=", "i", "" . ($_GET['idfamilyanalysis']) . "");
    $UpdateQuery->execute();
    $UpdateGoTo = "analysis-category.php";
    if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo ? rel2abs($UpdateGoTo, dirname(__FILE__)) : "";
    $UpdateQuery->redirect($UpdateGoTo);
}
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

                        <?php $idfamilyanalysis = $_GET['idfamilyanalysis']; ?>
                        <?php
                        $updatequery = new WA_MySQLi_RS("updatequery", $repnew, 0);
                        $updatequery->setQuery("SELECT * FROM family_analysis WHERE family_analysis.idfamilyanalysis='$idfamilyanalysis'");
                        $updatequery->execute();
                        ?>

                        <!-- end row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Update Category Analysis</h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <form method="post" class="form-horizontal p-t-20" id="updatebeach">

                                                    <div class="mb-3 row">
                                                        <label for="exampleInputuname3" class="col-sm-3 control-label"><?php echo $name_analysis_lang; ?></label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">

                                                                <input name="namefamily" type="text" class="form-control" id="namefamily" value="<?php echo htmlspecialchars($updatequery->getColumnVal("namefamily")); ?>">
                                                            </div>
                                                        </div>
                                                    </div>







                                                    <input name="company_id" type="hidden" id="company_id" value="<?php echo $idcompany; ?>">
                                                    <?php if ($kindofrole == '3') { ?>
                                                        <input name="preset" type="hidden" id="preset" value="Y"><?php } else { ?>
                                                        <input name="preset" type="hidden" id="preset" value="N"><?php } ?>
                                                    <td><input name="department_id" type="hidden" id="department_id"></td>


                                                    <input name="updated_at" type="hidden" id="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                                    <input name="idfamilyanalysis" type="hidden" id="idfamilyanalysis" value="<?php echo $idfamilyanalysis; ?>">

                                                    <div class="form-group row m-b-0">
                                                        <div class="offset-sm-3 col-sm-9"><br>
                                                            <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body collapse show">
                                                        <button type="button" onclick="goBack()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-backward"></i> Back</button>
                                                        <script>
                                                            function goBack() {
                                                                window.history.back();
                                                            }
                                                        </script>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>

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
            // File upload via Ajax
            $("#uploadForm").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'uploadlogorsl.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#uploadStatus').html('<img src="images/uploading.gif"/>');
                    },
                    error: function() {
                        $('#uploadStatus').html('<span style="color:#EA4335;">Images upload failed, please try again.<span>');
                    },
                    success: function(data) {
                        $('#uploadForm')[0].reset();
                        $('#uploadStatus').html('<span style="color:#28A74B;">Images uploaded successfully.<span>');
                        $('.gallery').html(data);
                    }
                });
            });

            // File type validation
            $("#fileInput").change(function() {
                var fileLength = this.files.length;
                var match = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
                var i;
                for (i = 0; i < fileLength; i++) {
                    var file = this.files[i];
                    var imagefile = file.type;
                    if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[3]))) {
                        alert('Please select a valid image file (JPEG/JPG/PNG/GIF).');
                        $("#fileInput").val('');
                        return false;
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".upload-image").click(function() {
                $(".form-horizontal").ajaxForm({
                    target: '.preview'
                }).submit();
            });
            $('#form').parsley();
        });
    </script>
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