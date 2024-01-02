<?php
//session_start();
  if ($dynamic == '') {
    include ('config/config.inc.php');
}
if ($_SESSION['VEGID'] == '') {
    header("Location:" . $sitename . "pages/");
}
$actual_link = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">
        <link rel="shortcut icon" href="<?php echo $fsitename; ?>img/adminlogo.png">
        <title>Admin</title>

        <!-- DataTables -->
        <link href="<?php echo $sitename; ?>plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="<?php echo $sitename; ?>plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Multi Item Selection examples -->
        <link href="<?php echo $sitename; ?>plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
          <link href="<?php echo $sitename; ?>plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
          <link href="https://fonts.googleapis.com/css?family=Lato:300,400&display=swap" rel="stylesheet">

        <!--Morris Chart CSS -->
    <!-- <link rel="stylesheet" href="<?php echo $sitename; ?>plugins/morris/morris.css">
 -->
        <link href="<?php echo $sitename; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $sitename; ?>plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">  
        <script src="<?php echo $sitename; ?>assets/js/modernizr.min.js"></script>

<style>
.panel-info {
    border-color: #b6edeb;
}
.panel-info>.panel-heading {
    color: #31708f;
    background-color: #b6edeb;
    border-color: #bce8f1;
}
.btn-default, .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open>.dropdown-toggle.btn-default {
    background-color: #3fa59f !important;
    border: 1px solid #3fa59f !important;
}
.btn-default, .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open>.dropdown-toggle.btn-default {
    background-color: #3fa59e !important;
    border: 1px solid #3fa59e !important;
}
a {
    color: #3fa59f;
    text-decoration: none;
    background-color: transparent;
    font-weight:600;
    -webkit-text-decoration-skip: objects;
}
.text-custom {
    color: #3fa59f !important;
}
.btn-primary, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus, .btn-primary:hover, .open>.dropdown-toggle.btn-primary {
    background-color: #3fa59f !important;
    border: 1px solid #3fa59f !important;
}
.btn-primary, .btn-success, .btn-default, .btn-info, .btn-warning, .btn-danger, .btn-inverse, .btn-purple, .btn-pink {
    color: #ffffff !important;
}
.btn-success, .btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .btn-success.focus, .btn-success:active, .btn-success:focus, .btn-success:hover, .open>.dropdown-toggle.btn-success {
    background-color: #3fa59f !important;
    border: 1px solid #3fa59f !important;
}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus, .page-item.active .page-link {
    background-color: #3fa59f;
    border-color: #3fa59f;
}

</style>

    </head>


    <body class="fixed-left" style="color:#000;">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left" style="background-color:#b6edeb;">
                    <div class="text-center">
                          <a href="<?php echo $fsitename; ?>" class="logo">
                              <span style="color:#3fa59f;"><?php echo getusers('name',$_SESSION['VEGID']); ?></span>
                        </a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <nav class="navbar-custom" style="background-color:#b6edeb;">

                    <ul class="list-inline float-right mb-0">
                       
                       
                                    
                        <li class="list-inline-item notification-list">
                            <a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
                                <i class="dripicons-expand noti-icon"></i>
                            </a>
                        </li>
                        
                       <!--  <li class="list-inline-item notification-list">
                            <a class="nav-link right-bar-toggle waves-light waves-effect" href="#">
                                <i class="dripicons-message noti-icon"></i>
                            </a>
                        </li> -->

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false" style="font-weight:bold;">
                          
                                            Profile
                                     
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>
                                     <?php  $sel1 = pFETCH("SELECT * FROM `admin_history` WHERE `admin_uid`=?", $_SESSION['VEGID']);
                                                $fsel = $sel1->fetch(PDO::FETCH_ASSOC);
                                                $_SESSION['type'] = 'admin';
                                                echo 'Welcome '; ?>
                                    </small> </h5>
                                </div>

                                <!-- item-->
                                 <!-- <a href="<?php echo $sitename; ?>profile/changepassword.htm" class="dropdown-item notify-item">
                                    <i class="md md-lock-outline"></i> <span>Change Password</span>
                                </a>
                                <a href="<?php echo $sitename; ?>profile/viewprofile.htm" class="dropdown-item notify-item">
                                    <i class="md md-account-circle"></i> <span>Profile</span>
                                </a>

                                <a href="<?php echo $sitename; ?>settings/1/editgeneral.htm" class="dropdown-item notify-item">
                                    <i class="md md-settings"></i> <span>General Settings</span>
                                </a> -->

                                <!-- item-->
                               <!--  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="md md-lock-open"></i> <span>Lock Screen</span>
                                </a>
 -->
                                <!-- item-->
                                <a href="<?php echo $sitename; ?>logout.php" class="dropdown-item notify-item">
                                    <i class="md md-settings-power"></i> <span>Logout</span>
                                </a>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                       <!--  <li class="hide-phone app-search">
                            <form role="search" class="">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>
                        </li> -->
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->

            <?php include 'sidebar.php'; ?>