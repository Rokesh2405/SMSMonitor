<?php
include '../config/config.inc.php';
if($_SESSION['VEGID'] != '') {
    header("location:" . $sitename);
    exit;
}

if (isset($_REQUEST['logsubmit'])) {
    @extract($_REQUEST);
    /* $captcha = $_POST['g-recaptcha-response'];
      $ip = $_SERVER['REMOTE_ADDR'];
      $rsp = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip";
      $jsondate = file_get_contents($rsp);
      $arr = json_decode($jsondate, true);
      if ($arr['success'] == '1') { */
    $msg = LoginCheck($uname, $pwd, $ip, $rememberme, $_REQUEST['login']);
    // echo $msg;
    if ($msg == "Admin" || $msg == "User" || $msg == "agent" || $msg == "Hurray! You will redirect into dashboard soon") {
        header("location:" . $sitename);
        exit;
    } else {
        echo '<script>window.onload = function(){ $("#login-box").addClass("animated shake" ); };</script>';
    }
    /* } else {
      $msg = $arr.'<span style="color:#FF0000; font-weight:bold;">Captcha Code Invalid</span>';
      } */
}
?>

<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo $fsitename; ?>img/adminlogo.png">

        <title>Admin || Login</title>

        <link href="<?php echo $sitename; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo $sitename; ?>assets/js/modernizr.min.js"></script>
        
    </head>
    <body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="card-box">
            <div class="panel-heading">
                <h4 class="text-center"><?php
                    if ($msg != '') {
                        echo $msg;
                    } else {
                        ?>Sign in
                    <?php } ?>
				</h4>
            </div>


            <div class="p-20">
                <form class="form-horizontal m-t-20" action="" method="post" autocomplete="off" id="login-box">

                    <div class="form-group-custom">
                        <input type="text" id="uname" name="uname" required="required" value="<?php echo $_COOKIE['lemail']; ?>"  pattern="[a-zA-Z0-9.@-]{0,55}" title="Username" maxlength="55"/>
                        <label class="control-label" for="user-name">Username</label><i class="bar"></i>
                    </div>

                    <div class="form-group-custom">
                        <input type="password" required="required" value="<?php echo $_COOKIE['lpass']; ?>" name="pwd" minlength='6' maxlength="55" id="pwd" title="Password" />
                        <label class="control-label" for="user-password">Password</label><i class="bar"></i>
                    </div>
<!-- 
                    <div class="form-group ">
                        <div class="col-12">
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>

                        </div>
                    </div> -->

                    <div class="form-group text-center m-t-40">
                        <div class="col-12">
                            <button class="btn btn-success btn-block text-uppercase waves-effect waves-light"
                                    type="submit" name="logsubmit" id="logsubmit">Log In
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
     
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo $sitename; ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="<?php echo $sitename; ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/detect.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/fastclick.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/waves.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/wow.min.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/jquery.scrollTo.min.js"></script>

        <script src="<?php echo $sitename; ?>assets/js/jquery.core.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/jquery.app.js"></script>
	
	</body>
</html>