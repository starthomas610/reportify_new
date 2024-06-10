<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php"); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $UpdateQuery = new WA_MySQLi_Query($repnew);
    $UpdateQuery->Action = "update";
    $UpdateQuery->Table = "`template_importify`";

    $UpdateQuery->bindColumn("templatename", "s", "" . ((isset($_POST["templatename"])) ? $_POST["templatename"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("templatedescription", "s", "" . ((isset($_POST["templatedescription"])) ? $_POST["templatedescription"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("fileextension", "s", "" . ((isset($_POST["fileextension"])) ? $_POST["fileextension"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("idcompany", "i", "" . ((isset($_POST["idcompany"])) ? $_POST["idcompany"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("iduser", "i", "" . ((isset($_POST["iduser"])) ? $_POST["iduser"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("labname", "s", "" . ((isset($_POST["labname"])) ? $_POST["labname"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("modifiedon", "s", "" . ((isset($_POST["updateon"])) ? $_POST["updateon"] : "") . "", "WA_DEFAULT");

    $UpdateQuery->addFilter("idimporttemplates", "=", "i", "" . ($_GET['idimporttemplates']) . "");
    $UpdateQuery->execute();
    $UpdateGoTo = "importifydashboard.php";
    if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo ? rel2abs($UpdateGoTo, dirname(__FILE__)) : "";
    $UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
if (isset($_GET['idimporttemplates'])) {
    $idimporttemplates = $_GET['idimporttemplates'];
}
if (isset($_POST['idimporttemplates'])) {
    $idimporttemplates = $_POST['idimporttemplates'];
}

?>
<?php
$updatequery = new WA_MySQLi_RS("updatequery", $repnew, 0);
$updatequery->setQuery("SELECT * FROM template_importify WHERE template_importify.idimporttemplates='$idimporttemplates'");
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
                                            <li class="breadcrumb-item active">Importify</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Importify</h4>
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
                                                    <label for="templatename" class="col-md-2 col-form-label">Template Name</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">

                                                            <input name="templatename" type="text" class="form-control" id="templatename" value="<?php echo ($updatequery->getColumnVal("templatename")); ?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="templatedescription" class="col-md-2 col-form-label">Template Description</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">

                                                            <input name="templatedescription" type="text" class="form-control" value="<?php echo ($updatequery->getColumnVal("templatedescription")); ?>" id="templatedescription">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="fileextension" class="col-md-2 col-form-label">File Source Type</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <select name="fileextension" required class="form-control" id="fileextension">
                                                                <option value="" disabled <?php echo (!$updatequery->getColumnVal("fileextension") ? 'selected' : ''); ?>>Select file type</option>
                                                                <option value="XLS" <?php echo ($updatequery->getColumnVal("fileextension") == 'XLS' ? 'selected' : ''); ?>>XLS</option>
                                                                <option value="CSV" <?php echo ($updatequery->getColumnVal("fileextension") == 'CSV' ? 'selected' : ''); ?>>CSV</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="mb-3 row">
                                                    <label for="labname" class="col-md-2 col-form-label">Lab Name</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">

                                                            <input name="labname" type="text" class="form-control" value="<?php echo ($updatequery->getColumnVal("labname")); ?>" id="labname" required>
                                                        </div>
                                                    </div>
                                                </div>


                                                <td><input name="company_id" type="hidden" id="company_id" value="<?php echo $idcompany; ?>"></td>
                                                <?php $updateon = date('Y-m-d H:i:s'); ?>
                                                <td><input name="modifiedon" type="hidden" id="modifiedon" value="<?php echo $updateon; ?>"></td>

                                                <input name="idimporttemplates" type="hidden" id="idimporttemplates" value="<?php echo $idimporttemplates; ?>"></td>
                                                <input name="user_id" type="hidden" id="user_id" value="<?php echo $iduserlogin; ?>"></td>







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