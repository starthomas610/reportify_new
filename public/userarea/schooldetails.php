<?php include('include/headscript.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <?php include('include/seo.php'); ?>

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <?php include('include/navigationbar.php'); ?>

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                   <?php include('include/topbar.php'); ?>

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">YogiWhere</a></li>
                                                <li class="breadcrumb-item active">Dashboard</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title"><?php echo $myschool; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            
                            <div class="row">
                             
                                <div class="col-lg-12">
                                    <div class="card card-body">
                                        <h4 class="card-title font-20 mt-0"><?php echo $myschool; ?></h4>
                                        <p class="font-13 text-muted">Here you can update your school details</p>
                                        <a href="#" class="btn btn-warning waves-effect waves-light"><?php echo $pagepreview; ?></a>
                                    </div>
                                </div>
                             
                               
                               
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                               
                                <div class="card">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title"><?php echo $schooldetailstitle; ?></h4>
                                            <p class="text-muted mb-4 font-13"><?php echo $updateschooldetailstitle; ?>
                                            </p>
            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="p-20">
                                                        <form action="#">
                                                            <div class="form-group">
                                                                <label><?php echo $schoolname; ?></label>
                                                                <input type="text" placeholder="<?php echo $schoolname; ?>" id="nameschool" name="nameschool" data-mask="999-99-999-9999-9" class="form-control">
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo $address; ?></label>
                                                                <input type="text" placeholder="<?php echo $address; ?>" id="address" name="address" data-mask="999-99-999-9999-9" class="form-control">
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo $country; ?></label>
                                                                <input type="text" placeholder="<?php echo $country; ?>" id="country" name="country" data-mask="999-99-999-9999-9" class="form-control">
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo $referencemeailschool; ?></label>
                                                                <input type="text" placeholder="<?php echo $referencemeailschool; ?>" id="referencemeailschool" name="referencemeailschool" data-mask="999-99-999-9999-9" class="form-control">
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo $schooldescription; ?></label>
                                                                <textarea placeholder="<?php echo $schooldescription; ?>" id="schooldescription" name="schooldescription" rows="4" class="form-control"></textarea>
                                                            </div>


                                                            
                                                    </div>
                                                </div>
            
                                                <div class="col-md-6">
                                                    <div class="p-20">
                                                        
            
                                                    <div class="form-group">
                                                                <label><?php echo $city; ?></label>
                                                                <input type="text" placeholder="<?php echo $city; ?>" id="city" name="city" data-mask="999-99-999-9999-9" class="form-control">
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo $zip; ?></label>
                                                                <input type="text" placeholder="<?php echo $zip; ?>" id="zip" name="zip" data-mask="999-99-999-9999-9" class="form-control">
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo $emailschool; ?></label>
                                                                <input type="text" placeholder="<?php echo $emailschool; ?>" id="emailschool" name="emailschool" data-mask="999-99-999-9999-9" class="form-control">
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo $referencenameschool; ?></label>
                                                                <input type="text" placeholder="<?php echo $referencenameschool; ?>" id="referencenameschool" name="referencenameschool" data-mask="999-99-999-9999-9" class="form-control">
                                                                
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
            
                                        </div>
                                    </div>
                               
                                </div>
                                
                               
                            </div>
                            
                            <!-- end row -->
                            
                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <?php include('include/footer.php'); ?>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/plugins/chart.js/chart.min.js"></script>
        <script src="assets/pages/dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        

    </body>
</html>