<?php include('../include/headscript.php'); ?>
<?php include("../class/company.php");
?>
<?php $idcomponent = $_GET['idcomponent']; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $UpdateQuery = new WA_MySQLi_Query($repnew);
    $UpdateQuery->Action = "update";
    $UpdateQuery->Table = "`component`";
    $UpdateQuery->bindColumn("name_component", "s", "" . ((isset($_POST["name_component"])) ? $_POST["name_component"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("description_component", "s", "" . ((isset($_POST["description_component"])) ? $_POST["description_component"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("cas_component", "s", "" . ((isset($_POST["cas_component"])) ? $_POST["cas_component"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("formula_component", "s", "" . ((isset($_POST["formula_component"])) ? $_POST["formula_component"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("component_family_id", "s", "" . ((isset($_POST["component_family_id"])) ? $_POST["component_family_id"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->bindColumn("update_at", "s", "" . ((isset($_POST["update_at"])) ? $_POST["update_at"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->addFilter("idcomponent", "=", "i", "" . ($_GET['idcomponent']) . "");
    $UpdateQuery->execute();
    $UpdateGoTo = "component.php";
    if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo ? rel2abs($UpdateGoTo, dirname(__FILE__)) : "";
    $UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
$updatequery = new WA_MySQLi_RS("updatequery", $repnew, 0);
$updatequery->setQuery("SELECT * FROM component WHERE component.idcomponent='$idcomponent'");
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
                                        <h5 class="header-title pb-3 mt-0">EasySpec: Edit Material/End Use</h5>


                                        <div>

                                            <form method="post" class="form-horizontal p-t-20" id="updatebeach">

                                                <div class="form-group row">
                                                    <label for="exampleInputuname3" class="col-sm-3 control-label"><?php echo $name_component_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"></span></div>
                                                            <input name="name_component" type="text" class="form-control" id="name_component" value="<?php echo ($updatequery->getColumnVal("name_component")); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="exampleInputuname3" class="col-sm-3 control-label"><?php echo $description_component_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"></span></div>
                                                            <input name="description_component" type="text" class="form-control" id="description_component" value="<?php echo ($updatequery->getColumnVal("description_component")); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="exampleInputuname3" class="col-sm-3 control-label"><?php echo $cas_component_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"></span></div>
                                                            <input name="cas_component" type="text" class="form-control" id="cas_component" value="<?php echo ($updatequery->getColumnVal("cas_component")); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="exampleInputuname3" class="col-sm-3 control-label"><?php echo $formula_component_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"></span></div>
                                                            <input name="formula_component" type="text" class="form-control" id="formula_component" value="<?php echo ($updatequery->getColumnVal("formula_component")); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="component_family_id" class="col-sm-3 control-label"><?php echo $component_family_id_lang; ?></label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"></span></div>
                                                            <select name="component_family_id" class="form-control" id="component_family_id">
                                                                <?php
                                                                // Connessione al database e selezione dei dati
                                                                $conn = new mysqli($servername, $username, $password, $database);

                                                                // Verifica se la connessione è riuscita
                                                                if ($conn->connect_error) {
                                                                    die("Connessione fallita: " . $conn->connect_error);
                                                                }

                                                                $query = "SELECT * FROM component_family ORDER BY name_componentfamily";
                                                                $result = $conn->query($query);

                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<option value='" . $row["idcomponentfamily"] . "'>" . $row["name_componentfamily"] . "</option>";
                                                                    }
                                                                } else {
                                                                    echo "<option value=''>Nessuna famiglia di componenti trovata</option>";
                                                                }

                                                                $conn->close();
                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <td><input name="created_at" type="hidden" id="created_at" value="<?php echo ($updatequery->getColumnVal("created_at")); ?>"></td>
                                                <td>
                                                    <input name="updated_at" type="hidden" id="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                                </td>

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