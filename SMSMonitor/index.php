<?php
$dynamic = '1';
$menu = '1';
$index='1';
include ('config/config.inc.php');


include ('require/header.php');
//print_r($_SESSION);
$_SESSION['mobileno']='';
unset($_SESSION['mobileno']);

if($_SESSION['highrisk']!='unshow' && isset($_SESSION['doctorid']))
{
  $_SESSION['highrisk']='show';  
}


?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
      
            <div class="row">
                <div class="col-sm-12">
                <h4 class="page-title">Dashboard</h4>
                    <p class="text-muted page-title-alt">Welcome to <?php echo getusers('name',$_SESSION['GRUID']); ?>!</p>
                </div>
            </div>
			
			</div>
			

           
	<?php include 'require/footer.php'; ?>      