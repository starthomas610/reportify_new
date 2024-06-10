<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php"); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $InsertQuery = new WA_MySQLi_Query($repnew);
    $InsertQuery->Action = "insert";
    $InsertQuery->Table = "`rsl_category`";

    $InsertQuery->bindColumn("name_rslcat", "s", "" . ((isset($_POST["name_rslcat"])) ? $_POST["name_rslcat"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("comment_rslcat", "s", "" . ((isset($_POST["comment_rslcat"])) ? $_POST["comment_rslcat"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("user_id", "s", "" . ((isset($_POST["user_id"])) ? $_POST["user_id"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("company_id", "s", "" . ((isset($_POST["company_id"])) ? $_POST["company_id"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("department_id", "s", "" . ((isset($_POST["department_id"])) ? $_POST["department_id"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("created_at", "s", "" . ((isset($_POST["created_at"])) ? $_POST["created_at"] : "") . "", "WA_DEFAULT");
    $InsertQuery->bindColumn("updated_at", "s", "" . ((isset($_POST["updated_at"])) ? $_POST["updated_at"] : "") . "", "WA_DEFAULT");
    $InsertQuery->saveInSession("");
    $InsertQuery->execute();
    $InsertGoTo = "rsl-category.php";
    if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo ? rel2abs($InsertGoTo, dirname(__FILE__)) : "";
    $InsertQuery->redirect($InsertGoTo);
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
                                                    <label for="exampleInputuname3" class="col-sm-3 control-label"><?php echo $name_rslcat_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">

                                                            <input name="name_rslcat" type="text" class="form-control" id="name_rslcat">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-sm-3 control-label"><?php echo $comment_rslcat_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">

                                                            <input name="comment_rslcat" type="text" class="form-control" id="comment_rslcat">
                                                        </div>
                                                    </div>
                                                </div>
                                                <td><input name="user_id" type="hidden" id="user_id" value="<?php echo $iduserlog; ?>"></td>
                                                <td><input name="company_id" type="hidden" id="company_id" value="<?php echo $idcompany; ?>"></td>
                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-sm-3 control-label"><?php echo $department_id_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">

                                                            <input name="department_id" type="text" class="form-control" id="department_id">
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