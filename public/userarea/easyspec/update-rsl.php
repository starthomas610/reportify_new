<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php"); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $UpdateQuery = new WA_MySQLi_Query($repnew);
    $UpdateQuery->Action = "update";
    $UpdateQuery->Table = "`rsl`";

    $UpdateQuery->bindColumn("name", "s", "" . ((isset($_POST["name"])) ? $_POST["name"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("description", "s", "" . ((isset($_POST["description"])) ? $_POST["description"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("start", "s", "" . ((isset($_POST["start"])) ? $_POST["start"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("end", "s", "" . ((isset($_POST["end"])) ? $_POST["end"] : "") . "", "WA_DEFAULT");

    $UpdateQuery->bindColumn("department_id", "s", "" . ((isset($_POST["department_id"])) ? $_POST["department_id"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("rsl_category_id", "s", "" . ((isset($_POST["rsl_category_id"])) ? $_POST["rsl_category_id"] : "") . "", "WA_DEFAULT");

    $UpdateQuery->bindColumn("version", "s", "" . ((isset($_POST["version"])) ? $_POST["version"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("active", "s", "" . ((isset($_POST["active"])) ? $_POST["active"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("created_at", "s", "" . ((isset($_POST["created_at"])) ? $_POST["created_at"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("updated_at", "s", "" . ((isset($_POST["updated_at"])) ? $_POST["updated_at"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->addFilter("id", "=", "i", "" . ($_GET['id']) . "");
    $UpdateQuery->execute();
    $UpdateGoTo = "rsl.php";
    if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo ? rel2abs($UpdateGoTo, dirname(__FILE__)) : "";
    $UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
?>
<?php
$updatequery = new WA_MySQLi_RS("updatequery", $repnew, 0);
$updatequery->setQuery("SELECT * FROM rsl LEFT JOIN rsl_category ON rsl.rsl_category_id=rsl_category.idrslcat WHERE rsl.id='$id'");
$updatequery->execute();
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
        /* select2 css */
        .select2-container {
            width: 100% !important;
        }

        .select2-selection__choice,
        .select2-selection__choice__remove {
            background-color: blue !important;
            color: white !important;
            border: 1px solid blue !important;
        }

        /* select2 css end */

        input:invalid {
            border-color: #ff0000;
            background-color: #fff7e6;
        }

        input:focus {
            background: yellow;
        }

        input:valid {
            border-color: #66ff33;
            background-color: #eeffe6;
        }

        select:invalid {
            border-color: #ff0000;
            background-color: #fff7e6;
        }

        select:focus {
            background-color: yellow;
        }

        select:valid {
            border-color: #66ff33;
            background-color: #eeffe6;
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

                                        <div>
                                            <form method="post" class="form-horizontal p-t-20" id="updatebeach">

                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-sm-3 col-form-label"><?php echo $name_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input name="name" type="text" class="form-control" id="name" value="<?php echo ($updatequery->getColumnVal("name")); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-sm-3 col-form-label"><?php echo $description_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input name="description" type="text" class="form-control" id="description" value="<?php echo ($updatequery->getColumnVal("description")); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-sm-3 col-form-label"><?php echo $start_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input name="start" type="date" class="form-control" id="start" value="<?php echo ($updatequery->getColumnVal("start")); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-sm-3 col-form-label"><?php echo $end_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input name="end" type="date" class="form-control" id="end" value="<?php echo ($updatequery->getColumnVal("end")); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input name="company_id" type="hidden" id="company_id" value="<?php echo ($updatequery->getColumnVal("company_id")); ?>">
                                                <input name="department_id" type="hidden" id="department_id" value="<?php echo ($updatequery->getColumnVal("department_id")); ?>">

                                                <?php
                                                //rsl category
                                                $rslcat = new WA_MySQLi_RS("rslcat", $repnew, 0);
                                                $rslcat->setQuery("SELECT * FROM rsl_category WHERE rsl_category.company_id=$idcompany");
                                                $rslcat->execute();
                                                ?>
                                                <div class="mb-3 row">
                                                    <label for="rsl_category_id" class="col-sm-3 col-form-label"><?php echo $rsl_category_id_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <select class="form-select" name="rsl_category_id" id="rsl_category_id">
                                                                <option value="" <?php if (!(strcmp("", ($updatequery->getColumnVal("rsl_category_id"))))) {
                                                                                        echo "selected=\"selected\"";
                                                                                    } ?>><?php echo $selecttitle; ?></option>
                                                                <?php
                                                                while (!$rslcat->atEnd()) { //dyn select
                                                                ?>
                                                                    <option value="<?php echo ($rslcat->getColumnVal("idrslcat")); ?>" <?php if (!(strcmp($rslcat->getColumnVal("idrslcat"), ($updatequery->getColumnVal("rsl_category_id"))))) {
                                                                                                                                            echo "selected=\"selected\"";
                                                                                                                                        } ?>><?php echo ($rslcat->getColumnVal("name_rslcat")); ?></option>
                                                                <?php
                                                                    $rslcat->moveNext();
                                                                } //dyn select
                                                                $rslcat->moveFirst();
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input name="user_id" type="hidden" id="user_id" value="<?php echo ($updatequery->getColumnVal("user_id")); ?>">
                                                <div class="mb-3 row">
                                                    <label for="version" class="col-sm-3 col-form-label"><?php echo $version_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input name="version" type="text" class="form-control" id="version" value="<?php echo ($updatequery->getColumnVal("version")); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="active" class="col-sm-3 col-form-label"><?php echo $active_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="form-check">
                                                            <?php $act = $updatequery->getColumnVal("active");
                                                            if ($act == "Y") { ?>
                                                                <input type="checkbox" name="active" class="form-check-input" id="active" value="Y" checked>
                                                            <?php } else { ?>
                                                                <input type="checkbox" name="active" class="form-check-input" id="active" value="Y">
                                                            <?php }  ?>
                                                            <label class="form-check-label" for="active"><?php echo $active_lang; ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input name="created_at" type="hidden" id="created_at" value="<?php echo ($updatequery->getColumnVal("created_at")); ?>">
                                                <input name="updated_at" type="hidden" id="updated_at" value="<?php echo ($updatequery->getColumnVal("updated_at")); ?>">
                                                <div class="form-group row m-b-0">
                                                    <div class="offset-sm-3 col-sm-9">
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
                                            </form>
                                        </div>
                                    </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let versionInput = document.getElementById('version');
            let originalValue = versionInput.value; // Conserviamo il valore originale per confrontarlo in seguito

            versionInput.addEventListener('change', function(e) {
                if (versionInput.value !== originalValue) { // Se il valore è cambiato...
                    e.preventDefault(); // Preveniamo ulteriori azioni

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Are you sure to change the version? If you change without revision the system will not store the previous version.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Proceed',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            originalValue = versionInput.value; // Aggiorniamo il valore originale se l'utente ha confermato il cambiamento
                        } else {
                            versionInput.value = originalValue; // Se l'utente annulla, ripristiniamo il valore originale
                        }
                    });
                }
            });
        });
    </script>

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