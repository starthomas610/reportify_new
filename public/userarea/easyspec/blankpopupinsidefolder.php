<?php include('../include/headscript.php'); ?>
<?php include("class/company.php");
?>
?>
<?php if (isset($_GET['idanalysis'])) {
    $idanalysis = $_GET['idanalysis'];
}
if (isset($_GET['idanalysisrsl'])) {
    $idanalysisrsl = $_GET['idanalysisrsl'];
}
if (isset($_GET['idmaterial'])) {
    $idmaterial = $_GET['idmaterial'];
}
if (isset($_POST['idanalysis'])) {
    $idanalysis = $_POST['idanalysis'];
}
if (isset($_POST['idanalysisrsl'])) {
    $idanalysisrsl = $_POST['idanalysisrsl'];
}
if (isset($_POST['idmaterial'])) {
    $idmaterial = $_POST['idmaterial'];
}
if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];
}
if (isset($_POST['updmeth'])) {
    $updmeth = $_POST['updmeth'];
}



?>
<?php if (isset($updmeth)) {
    // echo "Ciao";
    $UpdateQuery = new WA_MySQLi_Query($repnew);
    $UpdateQuery->Action = "update";
    $UpdateQuery->Table = "`analysis_rsl`";
    $UpdateQuery->bindColumn("comment_anrsl", "s", "" . ((isset($_POST["comment"])) ? $_POST["comment"] : "") . "", "WA_DEFAULT");
    $UpdateQuery->addFilter("idanalysis_rsl", "=", "i", "" . ($_POST['idanalysisrsl']) . "");
    $UpdateQuery->execute();
    $UpdateGoTo = "";
    if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo ? rel2abs($UpdateGoTo, dirname(__FILE__)) : "";
    $UpdateQuery->redirect($UpdateGoTo);
}

?>


<?php
$analysisdet = new WA_MySQLi_RS("analysisdet", $repnew, 1);
$analysisdet->setQuery("SELECT * FROM analysis WHERE analysis.idanalysis='$idanalysis'");
$analysisdet->execute(); ?>
<?php
$materialdet = new WA_MySQLi_RS("materialdet", $repnew, 1);
$materialdet->setQuery("SELECT * FROM material_type WHERE material_type.idmaterial_type='$idmaterial'");
$materialdet->execute(); ?>
<?php
$analrsldet = new WA_MySQLi_RS("analrsldet", $repnew, 1);
$analrsldet->setQuery("SELECT * FROM analysis_rsl WHERE analysis_rsl.idanalysis_rsl='$idanalysisrsl'");
$analrsldet->execute();

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

        <?php //include('../include/navigationbar.php'); 
        ?>

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <?php //include('../include/topbar.php'); 
                ?>

                <div class="page-content-wrapper ">

                    <div class="container-fluid">
                    <div class="alert alert-primary" role="alert">
                <?php echo $addcommtitle; ?><?php echo ($analysisdet->getColumnVal("name_analysis")); ?><?php echo $addcommattitle; ?><?php echo $materialdet->getColumnVal("name_material"); ?>
            </div>
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
                                        <h5 class="header-title pb-3 mt-0">xxxx</h5>

                                        <div class="table-responsive">
                                        <form method="post" title="querysearch" id="querysearch">

<textarea name="comment" id="comment"><?php echo ($analrsldet->getColumnVal("comment_anrsl")); ?></textarea>
<script>
    tinymce.init({
        selector: '#comment'
    });
</script>
<input type="hidden" id="idanalysisrsl" name="idanalysisrsl" value="<?php echo $idanalysisrsl; ?>">
<input type="hidden" id="idmaterial" name="idmaterial" value="<?php echo $idmaterial; ?>">
<input type="hidden" id="idanalysis" name="idanalysis" value="<?php echo $idanalysis; ?>">
<input type="hidden" id="updmeth" name="updmeth" value="Y">
<input type="submit">
<script>
    function Setcontent() {
        var ContentSet = tinymce.get('comment').setContent('Hello World');
    }
</script>
</form>
                                        </div><!--end table-responsive-->

                                    </div>
                                </div>
                            </div>
                        </div><button onclick="self.close()" type="button" class="btn btn-success waves-effect waves-light"><?php echo $closewindowtitle; ?></button>
                        <!-- end row -->


                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <?php include('../include/footer.php'); ?>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->


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