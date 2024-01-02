<?php
$loginaccess2 = $db->prepare("SELECT * FROM `users` WHERE `orgpassword` = ? AND `id`=? ");
$loginaccess2->execute(array($_SESSION['Gpassword'], $_SESSION['VEGID']));
$loginaccess2 = $loginaccess2->fetch();
if ($loginaccess2['id'] == '') {
    logout();
    session_destroy();
    session_unset();
    header("location:https://ttbilling.in/smsmonitor/pages/");
}
?>

<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li class="has_sub" >
                    <a href="<?php echo $sitename; ?>" class="waves-effect"  <?php if ($menu == 1) { ?>style="font-weight:bold;" <?php } ?>>
                        <i class="ti-home" <?php if ($menu == 1) { ?>style="font-weight:bold;" <?php } ?>></i> <span> Dashboard</span> </a>

                </li>
               <li class="has_sub" >
                    <a href="<?php echo $sitename; ?>master/website.htm" class="waves-effect"  <?php if ($menu == 2) { ?>style="font-weight:bold;" <?php } ?>>
                        <i class="fa fa-files-o" <?php if ($menu == 2) { ?>style="font-weight:bold;" <?php } ?>></i> <span> Projects</span> </a>

                </li>
 <li class="has_sub" >
                    <a href="<?php echo $sitename; ?>master/report.htm" class="waves-effect"  <?php if ($menu == 3) { ?>style="font-weight:bold;" <?php } ?>>
                        <i class="fa fa-comments" <?php if ($menu == 3) { ?>style="font-weight:bold;" <?php } ?>></i> <span> Reports</span> </a>

                </li>
                <li class="has_sub" >
                    <a href="<?php echo $sitename; ?>logout.htm" class="waves-effect"  <?php if ($menu == 4) { ?>style="font-weight:bold;" <?php } ?>>
                        <i class="md md-settings-power" <?php if ($menu == 4) { ?>style="font-weight:bold;" <?php } ?>></i> <span> Logout</span> </a>

                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</div>
<!-- Left Sidebar End -->
<!-- Right Sidebar -->
<!--   <div class="side-bar right-bar nicescroll">
      <h4 class="text-center">Chat</h4>
      <div class="contact-list nicescroll">
          <ul class="list-group contacts-list">
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-1.jpg" alt="">
                      </div>
                      <span class="name">Chadengle</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-2.jpg" alt="">
                      </div>
                      <span class="name">Tomaslau</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-3.jpg" alt="">
                      </div>
                      <span class="name">Stillnotdavid</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-4.jpg" alt="">
                      </div>
                      <span class="name">Kurafire</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-5.jpg" alt="">
                      </div>
                      <span class="name">Shahedk</span>
                      <i class="fa fa-circle away"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-6.jpg" alt="">
                      </div>
                      <span class="name">Adhamdannaway</span>
                      <i class="fa fa-circle away"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-7.jpg" alt="">
                      </div>
                      <span class="name">Ok</span>
                      <i class="fa fa-circle away"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-8.jpg" alt="">
                      </div>
                      <span class="name">Arashasghari</span>
                      <i class="fa fa-circle offline"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-9.jpg" alt="">
                      </div>
                      <span class="name">Joshaustin</span>
                      <i class="fa fa-circle offline"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-10.jpg" alt="">
                      </div>
                      <span class="name">Sortino</span>
                      <i class="fa fa-circle offline"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
          </ul>
      </div>
  </div> -->
<!-- /Right-bar -->

<!-- END wrapper -->