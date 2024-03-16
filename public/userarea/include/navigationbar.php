<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center bg-logo">
                        <a href="index.html" class="logo"><i class="mdi mdi-bowling text-success"></i> Zoogler</a>
                        <!-- <a href="index.html" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
                    </div>
                </div>
                <div class="sidebar-user">
                    <img src="assets/images/users/avatar-6.jpg" alt="user" class="rounded-circle img-thumbnail mb-1">
                    <h6 class=""><?php echo $_SESSION["nameuser"]; ?> <?php echo $_SESSION["surnameuser"]; ?> </h6> 
                    <p class=" online-icon text-dark"><i class="mdi mdi-record text-success"></i>online</p>                    
                    <ul class="list-unstyled list-inline mb-0 mt-2">
                        <li class="list-inline-item">
                            <a href="../profile" class="" data-toggle="tooltip" data-placement="top" title="Profile"><i class="dripicons-user text-purple"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="" data-toggle="tooltip" data-placement="top" title="Settings"><i class="dripicons-gear text-dark"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="../logout" class="" data-toggle="tooltip" data-placement="top" title="Log out"><i class="dripicons-power text-danger"></i></a>
                        </li>
                    </ul>           
                </div>

                <div class="sidebar-inner slimscrollleft">

                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Main</li>

                            <li>
                                <a href="index.php" class="waves-effect">
                                    <i class="mdi mdi-monitor-dashboard icon nav-icon"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            <li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-bag-checked"></i> <span> <?php echo $mycompany; ?> </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="list-unstyled">
        <li><a href="mycompany.php"><?php echo $mycompany; ?></a></li>
        <li><a href="department.php"><?php echo $department; ?></a></li>
        <li><a href="contact-list.php"><?php echo $contactlist; ?></a></li>
    </ul>
</li>

<?php if (in_array(3, $activemod)) { ?>
<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="bx bxs-check-shield"></i> <span> <?php echo $rsl; ?> </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="list-unstyled">
        <li><a href="rsl.php"><?php echo $rsl; ?></a></li>
        <li><a href="analysis.php"><?php echo $analysis; ?></a></li>
        <li><a href="component.php"><?php echo $component; ?></a></li>
        <li><a href="analysistemplate.php">Analysis Template</a></li>
        <li><a href="component.php"><?php echo $newslettertrl; ?></a></li>
    </ul>
</li>
<?php } ?>

<?php if (in_array(7, $activemod)) { ?>
<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="bx bx-mail-send"></i> <span> <?php echo $saytrl; ?> </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="list-unstyled">
        <li><a href="saytrl-newsletter.php"><?php echo $newsletterlist; ?></a></li>
        <li><a href="saytrl-maillist.php"><?php echo $maillist; ?></a></li>
        <li><a href="saytrl-settings.php"><?php echo $saytrloption; ?></a></li>
    </ul>
</li>
<?php } ?>

<?php if (in_array(4, $activemod)) { ?>
<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="bx bxl-product-hunt"></i> <span> <?php echo $products; ?> </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="list-unstyled">
        <li><a href="products.php"><?php echo $products; ?></a></li>
        <li><a href="email-read.html"><?php echo $bom; ?></a></li>
        <li><a href="email-read.html"><?php echo $metadata; ?></a></li>
    </ul>
</li>
<?php } ?>

<?php if (in_array(5, $activemod)) { ?>
<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-human-queue"></i> <span> <?php echo $extcompanies; ?> </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="list-unstyled">
        <li><a href="email-inbox.html"><?php echo $extcompanies; ?></a></li>
        <li><a href="email-read.html"><?php echo $companiescontactlist; ?></a></li>
        <li><a href="email-read.html"><?php echo $categorycompanies; ?></a></li>
    </ul>
</li>
<?php } ?>

<?php if (in_array(2, $activemod)) { ?>
<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-chart-bar"></i> <span> <?php echo $statistictitle; ?> </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="list-unstyled">
        <li><a href="stats-levelone.php">StatKPI</a></li>
        <li><a href="email-read.html"><?php echo $companiescontactlist; ?></a></li>
        <li><a href="email-read.html"><?php echo $categorycompanies; ?></a></li>
    </ul>
</li>
<?php } ?>

<?php if (in_array(1, $activemod)) { ?>
<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-chart-bar"></i> <span> Rate&Go </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="list-unstyled">
        <li><a href="stats-ratego.php">Rate&GO</a></li>
        <li><a href="email-read.html"><?php echo $companiescontactlist; ?></a></li>
        <li><a href="email-read.html"><?php echo $categorycompanies; ?></a></li>
    </ul>
</li>
<?php } ?>


                        
                            
                          

                            
                           

                            
                          



                            <li class="has_sub">
                                <a href="tables-basic.html" class="waves-effect"><i class="dripicons-copy"></i><span> <?php echo $contactus; ?> </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                   
                                    <li><a href="pages-blank.html"><?php echo $contactusform; ?></a></li>
                                    <li><a href="pages-blank.html"><?php echo $supportticket; ?></a></li>
                                   
                                </ul>
                            </li>

                            <li class="menu-title">Extra</li>

                            

                            <li class="has_sub">
                                <a href="tables-basic.html" class="waves-effect"><i class="dripicons-copy"></i><span> Template </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                   
                                    <li><a href="pages-blank.html">Blank Page</a></li>
                                   
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->