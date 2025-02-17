<?php


include "session.php";


?>
<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="assets/images/amdech-log.jpg">
        <title><?php echo PROJECT_NAME; ?> | Admin Panel</title>

        <!-- Custom box css -->
        <link href="assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

        <!-- DataTables -->
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- jquery-confirm files -->
        <link rel="stylesheet" type="text/css" href="assets/plugins/jquery-confirm/css/jquery-confirm.css" />
        <link href="assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/select2/dist/css/select2-bootstrap.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css"
                rel="stylesheet">
        <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <link rel="stylesheet" href="assets/css/jquery.filer.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/jquery.filer-dragdropbox-theme.css" type="text/css" />
        <link rel="stylesheet" href="assets/css/jquery-filer.css" type="text/css" />


        <script src="assets/js/modernizr.min.js"></script>
        <script type="text/javascript">
                function loading() {

                }

                function unloading() {
                        document.getElementById("load").style.display = 'none';
                }
        </script>
        <style>
                #topnav .navigation-menu>li>a {
                        padding-right: 10px !important;
                }
        </style>
</head>

<body>
        <div id="load"
                style=" background:url(images/overly.png) repeat; width:100%; display:none; height:100%; position:fixed;top:0; left:0;z-index:10000; padding-top:1%; ">
                <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                                <td align="center" valign="middle">
                                        <table width="425" align="center" style="border:0px solid #f0f0f0;" border="0"
                                                cellspacing="0" cellpadding="0">
                                                <tr>
                                                        <td align="right" valign="middle">
                                                                <div align="center" class="loading"
                                                                        style="border:0px solid #fff;"> <img
                                                                                style="margin-top:150px; border-radius:6px; padding:3px; background:#fff;"
                                                                                src="images/loading_big.gif"
                                                                                alt="loading" /> <br />
                                                                        <br />
                                                                        <div id="convprogress"> </div>
                                                                </div>
                                                        </td>
                                                </tr>
                                        </table>
                                </td>
                        </tr>
                </table>
        </div>

        <?php

        include_once "navmenu-functions.php";

        $homeres_ed = getUserinfo($db, $_SESSION['UserId']); ?>

        <!-- Navigation Bar-->
        <header id="topnav">
                <div class="topbar-main">
                        <div class="container">

                                <!-- LOGO -->
                                <div class="topbar-left"> <a href="dashboard.php" class="logo"><span><img
                                                                src="assets/images/logo.svg" alt="" /></span></span></a>
                                </div>
                                <!-- End Logo container-->

                                <div class="menu-extras">
                                        <ul class="nav navbar-nav navbar-right pull-right">

                                                <li class="dropdown user-box">
                                                        <a href="javascript:;"
                                                                class="dropdown-toggle waves-effect waves-light profile "
                                                                data-toggle="dropdown" data-hover="dropdown"
                                                                data-close-others="true" aria-expanded="true">
                                                                <?php //if(file_exists(docroot.'adminusers/'.$homeres_ed['user_photo']) && $homeres_ed['user_photo'] != ''){
                                                                if ($homeres_ed['user_photo'] != '') { ?>
                                                                        <img class="img-circle user-img"
                                                                                src="<?php echo IMG_BASE_URL; ?>adminusers/<?php echo $homeres_ed['user_photo']; ?>" />
                                                                <?php } else { ?>
                                                                        <img class="img-circle user-img"
                                                                                src="<?php echo IMG_BASE_URL; ?>adminusers/user.png" />
                                                                <?php } ?>
                                                                <span class="username username-hide-mobile">
                                                                        <?php echo $_SESSION["UName"];
                                                                        echo "(" . $_SESSION["RoleName"] . ')'; ?></span>

                                                        </a>
                                                        <ul class="dropdown-menu">
                                                                <li><a href="profile.php"><i class="ti-user m-r-5"></i>
                                                                                Profile</a></li><!--
                      <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
                      <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li>-->
                                                                <li><a href="logout.php"><i
                                                                                        class="ti-power-off m-r-5"></i>
                                                                                Logout</a></li>
                                                        </ul>
                                                </li>
                                        </ul>
                                        <div class="menu-item">
                                                <!-- Mobile menu toggle-->
                                                <a class="navbar-toggle">
                                                        <div class="lines"> <span></span> <span></span> <span></span>
                                                        </div>
                                                </a>
                                                <!-- End mobile menu toggle-->
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="navbar-custom">
                        <div class="container">
                                <div id="navigation">
                                        <!-- Navigation Menu-->
                                        <ul class="navigation-menu">
                                                <li> <a href="dashboard.php" class="active"><i
                                                                        class="zmdi zmdi-view-dashboard"></i> <span>
                                                                        Dashboards </span> </a> </li>
                                                <!--<li class="has-submenu"> <a href="#"><i class="zmdi zmdi-invert-colors"></i> <span> User Interface </span> </a>
            <ul class="submenu megamenu">
                      <li>
                <ul>
                          <li><a href="ui-buttons.html">Buttons</a></li>
                          <li><a href="ui-cards.html">Cards</a></li>
                          <li><a href="ui-typography.html">Typography </a></li>
                          <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                          <li><a href="ui-material-icons.html">Material Design Icons</a></li>
                          <li><a href="ui-font-awesome-icons.html">Font Awesome</a></li>
                          <li><a href="ui-themify-icons.html">Themify Icons</a></li>
                        </ul>
              </li>
                      <li>
                <ul>
                          <li><a href="ui-modals.html">Modals</a></li>
                          <li><a href="ui-notification.html">Notification</a></li>
                          <li><a href="ui-range-slider.html">Range Slider</a></li>
                          <li><a href="ui-components.html">Components</a>
                  <li><a href="ui-sweetalert.html">Sweet Alert</a>
                  <li><a href="ui-treeview.html">Tree view</a>
                  <li><a href="ui-widgets.html">Widgets</a></li>
                        </ul>
              </li>
                    </ul>
          </li>-->
                                                <?php

                                                $reslt_mnu = getTopMenuArray($db, $_SESSION['RoleId'], $admin_id);


                                                for ($ii = 0; $ii < count($reslt_mnu); $ii++) {

                                                        if ($reslt_mnu[$ii]['moduleicon'] != '') {

                                                                $faicon = $reslt_mnu[$ii]['moduleicon'];

                                                        } else {
                                                                $faicon = 'icon-folder';
                                                        }

                                                        ?>

                                                        <li class="has-submenu">
                                                                <a href="#"><span>
                                                                                <i class="<?php echo $faicon; ?>"></i>
                                                                                <?php echo $reslt_mnu[$ii]['menuname']; ?>
                                                                        </span>
                                                                </a>
                                                                <ul class="submenu">
                                                                        <?php
                                                                        $mnuid = $reslt_mnu[$ii]['menuid'];
                                                                        $reslt_modm = getTopMenuModuleArray($db, $_SESSION['RoleId'], $admin_id, $mnuid);
                                                                        $faicon = '';
                                                                        for ($nn = 0; $nn < count($reslt_modm); $nn++) {
                                                                                $mdlnam = $reslt_modm[$nn]['modulename'];

                                                                                $mdlpath = $reslt_modm[$nn]['modulepath'];
                                                                                $mdldispname = $reslt_modm[$nn]['description'];
                                                                                ?>
                                                                                <li><a href="<?php echo $mdlpath; ?>"><i
                                                                                                        class="fa fa-angle-right"></i>
                                                                                                <?php echo $mdlnam; ?></a></li>
                                                                        <?php } ?>
                                                                </ul>
                                                        </li>
                                                <?php } ?>
                                        </ul>
                                        </li>
                                        </ul>
                                        <!-- End navigation menu  -->
                                </div>
                        </div>
                </div>
        </header>
        <div id="dummyheader"></div>
        <!-- End Navigation Bar-->