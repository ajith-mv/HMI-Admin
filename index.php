<?php
ob_start();
ob_flush();
error_reporting(0);
session_start();

if (!empty($_SESSION["UserId"]) && $_SESSION["UserId"] != '' && $_REQUEST['err'] != 'ses') {
    header("location:dashboard.php");
    exit();
}


extract($_POST);
$error = "";
if (isset($_REQUEST['err'])) {
    $err = $_REQUEST['err'];
    if ($err == "invup") {
        $error = '<div class="alert alert-danger alert-dismissable"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button">X</button> Invalid Username/Password!  </div>';
    } elseif ($err == "invu") {
        $error = '<div class="alert alert-danger alert-dismissable"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button">X</button> Invalid Username!  </div>';
    } elseif ($err == "lo") {
        $error = '<div class="alert alert-success alert-dismissable"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button">X</button> You have Successfully logged out !  </div>';
    } elseif ($err == "invp") {
        $error = '<div class="alert alert-danger alert-dismissable"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button">X</button> Invalid Password!  </div>';
    } elseif ($err == "ac") {
        $error = '<div class="alert alert-info alert-dismissable"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button">X</button> Not Activated Your account!  </div>';
    } elseif ($err == "ses") {
        $error = '<div class="alert alert-info alert-dismissable"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button">X</button> Session Time Out! Please ReLogin. </div>';
    } elseif ($err == "rstpwdsucc") {
        $error = '<div class="alert alert-success alert-dismissable"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button">X</button> Your Password Reset Successfully!</div>';
    } elseif ($err == "rstpwdfail") {
        $error = '<div class="alert alert-info alert-dismissable"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button">X</button> Your Password Reset Not to be Done Please Try Again!</div>';
    } else {
        $error = "";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="assets/images/amdech-log.jpg">
    <!-- App title -->
    <title>HMI | Admin Panel</title>

    <!-- App CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>
</head>

<body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div align="center">
            <img src="assets/images/logo.svg" class="img-responsive">
        </div>
        <div class="m-t-40 card-box">
            <div class="text-center">
                <h3 class="text-uppercase font-bold m-b-0">Sign In</h3>
            </div>
            <div class="panel-body">
                <form method="post" class="form-horizontal m-t-10" id="jvalidate" action="dashboard.php">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" name="username" id="username"
                                placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" name="password" id="password"
                                placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <input type="hidden" name="submt" id="submt" value="login" />
                            <input type="submit" name="submit" id="submit" value="Sign In"
                                class="btn btn-custom waves-effect waves-light text-uppercase">
                        </div>
                    </div>
                    <?php if ($error != '' && !empty($error)) {
                        echo $error;
                    } ?>
                </form>

            </div>
        </div>
        <!-- end card-box-->
    </div>
    <!-- end wrapper page -->
    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>