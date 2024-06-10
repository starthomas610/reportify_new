<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php"); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $InsertQuery = new WA_MySQLi_Query($repnew);
    $InsertQuery->Action = "insert";
    $InsertQuery->Table = "`standards`";

    // Handling text inputs
    $InsertQuery->bindColumn("titlestandards", "s", $_POST["titlestandards"] ?? "", "WA_DEFAULT");
    $InsertQuery->bindColumn("numberstandards", "s", $_POST["numberstandards"] ?? "", "WA_DEFAULT");
    $InsertQuery->bindColumn("yearstandards", "i", $_POST["yearstandards"] ?? "", "WA_DEFAULT");

    // Handling the checkbox for 'status'
    $status = isset($_POST["status"]) && $_POST["status"] === "A" ? "A" : "Inactive"; // Default to 'Inactive' if not checked
    $InsertQuery->bindColumn("status", "s", $status, "WA_DEFAULT");

    // Date fields with default value of today's date
    $InsertQuery->bindColumn("activefrom", "s", $_POST["activefrom"] ?? date("Y-m-d"), "WA_DEFAULT");
    $InsertQuery->bindColumn("activeto", "s", $_POST["activeto"] ?? date("Y-m-d"), "WA_DEFAULT");

    // Handling hidden inputs
    $InsertQuery->bindColumn("company_id", "s", $_POST["company_id"] ?? "", "WA_DEFAULT");

    // Execute the query
    $InsertQuery->execute();

    // Dopo l'esecuzione dell'inserimento
    $lastInsertedId = $InsertQuery->InsertID;
    // Redirect con l'ID dello standard
    $InsertGoTo = "update-standards.php?id=$lastInsertedId";
    if (function_exists("rel2abs")) {
        $InsertGoTo = rel2abs($InsertGoTo, dirname(__FILE__));
    }
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
                                        <h5 class="header-title pb-3 mt-0">EasySpec: Insert New Standard</h5>

                                        <div>
                                            <form method="post" class="form-horizontal p-t-20" id="updatebeach">

                                                <div class="mb-3 row">
                                                    <label for="exampleInputuname3" class="col-sm-3 control-label">Title Standard</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">

                                                            <input name="titlestandards" type="text" class="form-control" id="titlestandards">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="exampleInputuname3" class="col-sm-3 control-label">Number Standard</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">

                                                            <input name="numberstandards" type="text" class="form-control" id="numberstandards">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Year Standard with year dropdown -->
                                                <div class="form-group row">
                                                    <label for="yearstandards" class="col-sm-3 control-label">Year Standard</label>
                                                    <div class="col-sm-9">
                                                        <select name="yearstandards" class="form-control" id="yearstandards">
                                                            <option value="">Select</option> <!-- Opzione predefinita -->
                                                            <?php
                                                            $currentYear = date('Y');
                                                            for ($year = $currentYear; $year >= 1900; $year--) {
                                                                echo "<option value='$year'>$year</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <!-- Status with checkbox, using inline styles for quick fixes -->
                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3 control-label">Status</label>
                                                    <div class="col-sm-2">
                                                        <input name="status" type="checkbox" class="form-check-input" id="status" value="A" style="width: 20px; height: 20px;">
                                                        <label class="form-check-label" for="status">Active</label>
                                                    </div>
                                                </div>

                                                <!-- Description with text area -->
                                                <div class="form-group row">
                                                    <label for="description" class="col-sm-3 control-label">Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="description" class="form-control" id="description" rows="4"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Active From and Active To with date pickers -->
                                                <div class="form-group row">
                                                    <label for="activefrom" class="col-sm-3 control-label">Active From</label>
                                                    <div class="col-sm-9">
                                                        <input name="activefrom" type="date" class="form-control" id="activefrom" value="<?php echo date('Y-m-d'); ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="activeto" class="col-sm-3 control-label">Active To</label>
                                                    <div class="col-sm-9">
                                                        <input name="activeto" type="date" class="form-control" id="activeto">
                                                    </div>
                                                </div>
                                        </div>
                                        <input name="company_id" type="hidden" id="company_id" value="<?php echo $idcompany; ?>">
                                        <?php if ($kindofrole == '3') { ?>
                                            <input name="preset" type="hidden" id="preset" value="Y"><?php } else { ?>
                                            <input name="preset" type="hidden" id="preset" value="N"><?php } ?>
                                        <td><input name="department_id" type="hidden" id="department_id"></td>
                                        <td><input name="created_at" type="hidden" id="created_at"></td>
                                        <td><input name="updated_at" type="hidden" id="updated_at"></td>
                                        <div class="form-group row m-b-0">
                                            <div class="offset-sm-3 col-sm-9"><br>
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