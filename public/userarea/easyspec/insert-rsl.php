<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php");
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $InsertQuery = new WA_MySQLi_Query($repnew);
    $InsertQuery->Action = "insert";
    $InsertQuery->Table = "`rsl`";

    $InsertQuery->bindColumn("name", "s", "" . ((isset($_POST["name"])) ? $_POST["name"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("description", "s", "" . ((isset($_POST["description"])) ? $_POST["description"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("start", "s", "" . ((isset($_POST["start"])) ? $_POST["start"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("end", "s", "" . ((isset($_POST["end"])) ? $_POST["end"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("company_id", "s", "" . ((isset($_POST["company_id"])) ? $_POST["company_id"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("department_id", "s", "" . ((isset($_POST["department_id"])) ? $_POST["department_id"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("rsl_category_id", "s", "" . ((isset($_POST["rsl_category_id"])) ? $_POST["rsl_category_id"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("user_id", "s", "" . ((isset($_POST["user_id"])) ? $_POST["user_id"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("version", "s", "" . ((isset($_POST["version"])) ? $_POST["version"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("active", "s", "" . ((isset($_POST["active"])) ? $_POST["active"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("created_at", "s", "" . ((isset($_POST["created_at"])) ? $_POST["created_at"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("updated_at", "s", "" . ((isset($_POST["updated_at"])) ? $_POST["updated_at"] : "") . "", "WA_DEFAULT");
    $InsertQuery->saveInSession("");
    $InsertQuery->execute();

    // Get the last inserted ID
    $lastInsertedId = $repnew->insert_id;

    // Now, insert into rsllimits
    $InsertRsllimitsQuery = new WA_MySQLi_Query($repnew);
    $InsertRsllimitsQuery->Action = "insert";
    $InsertRsllimitsQuery->Table = "`rsllimits`";

    $InsertRsllimitsQuery->bindColumn("idrsl", "s", $lastInsertedId, "WA_DEFAULT");
    $InsertRsllimitsQuery->bindColumn("namersllimits", "s", "default", "WA_DEFAULT");

    $InsertRsllimitsQuery->execute();

    $InsertGoTo = "rsl.php";
    if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo ? rel2abs($InsertGoTo, dirname(__FILE__)) : "";
    $InsertQuery->redirect($InsertGoTo);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
                                                    <label for="name" class="col-md-2 col-form-label"><?php echo $name_lang; ?></label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">

                                                            <input name="name" type="text" class="form-control" id="name" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-md-2 col-form-label"><?php echo $description_lang; ?></label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">

                                                            <input name="description" type="text" class="form-control" id="description">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-md-2 col-form-label"><?php echo $start_lang; ?></label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">




                                                            <input name="start" required type="date" class="form-control" id="start">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-md-2 col-form-label"><?php echo $end_lang; ?></label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">

                                                            <input name="end" type="date" class="form-control" id="end">
                                                        </div>
                                                    </div>
                                                </div>
                                                <td><input name="company_id" type="hidden" id="company_id" value="<?php echo $idcompany; ?>"></td>
                                                <td><input name="department_id" type="hidden" id="department_id"></td>
                                                <?php
                                                //rsl category
                                                $rslcat = new WA_MySQLi_RS("rslcat", $repnew, 0);
                                                $rslcat->setQuery("SELECT * FROM rsl_category WHERE rsl_category.company_id=$idcompany");
                                                $rslcat->execute();
                                                ?>



                                                <div class="mb-3 row">
                                                    <label for="rsl_category_id" class="col-md-2 col-form-label"><?php echo $rsl_category_id_lang; ?></label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <select class="form-select" name="rsl_category_id" id="rsl_category_id">
                                                                <option value=""><?php echo $selecttitle; ?></option>
                                                                <?php
                                                                while (!$rslcat->atEnd()) { // Iterazione delle opzioni dinamiche
                                                                ?>
                                                                    <option value="<?php echo htmlspecialchars($rslcat->getColumnVal("idrslcat")); ?>">
                                                                        <?php echo htmlspecialchars($rslcat->getColumnVal("name_rslcat")); ?>
                                                                    </option>
                                                                <?php
                                                                    $rslcat->moveNext();
                                                                }
                                                                $rslcat->moveFirst(); // Riporta l'iteratore all'inizio per il riutilizzo
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <td><input name="user_id" type="hidden" id="user_id"></td>
                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-md-2 col-form-label"><?php echo $version_lang; ?></label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">

                                                            <input name="version" required type="text" class="form-control" id="version">
                                                        </div>
                                                    </div>
                                                </div>

                                                <input name="user_id" type="hidden" id="user_id"></td>
                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-md-2 col-form-label"><?php echo $rsllogoupload_lang; ?></label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" id="inputGroupFile02">
                                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="active" class="col-md-2 col-form-label"><?php echo $active_lang; ?></label>
                                                    <div class="col-md-10">
                                                        <div class="form-check">
                                                            <input name="active" type="checkbox" class="form-check-input" id="active" value="Y">
                                                            <label class="form-check-label" for="active"></label>
                                                        </div>
                                                    </div>
                                                </div>




                                                <td><input name="created_at" type="hidden" id="created_at"></td>
                                                <td><input name="updated_at" type="hidden" id="updated_at"></td>
                                                <div class="form-group row m-b-0">
                                                    <div class="offset-sm-3 col-sm-9">
                                                        <button type="submit" class="btn btn-success waves-effect waves-light">Insert</button>
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
                                    </div><!--end table-responsive-->

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