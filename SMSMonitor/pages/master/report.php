<?php
$menu = "3";
include ('../../config/config.inc.php');
$dynamic = '1';
//$datepicker = '1';
$datatable = '1';

include ('../../require/header.php');

if (isset($_REQUEST['delete']) || isset($_REQUEST['delete_x'])) {
    $chk = $_REQUEST['chk'];
    $chk = implode('.', $chk);
   
    $msg = delregisterform($chk);
}

if(isset($_REQUEST['search']))
{


    $url=$sitename.'master/'.$_REQUEST['project'].'/'.$_REQUEST['fromdate'].'/'.$_REQUEST['todate'].'/report.htm';
    header("Location:$url");
}
if(isset($_REQUEST['download']))
{
    $url=$sitename.'pages/master/exportreport.php?project='.$_REQUEST['project'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'];
    header("Location:$url");
}
?>
<script type="text/javascript" >
    function validcheck(name)
    {
        var chObj = document.getElementsByName(name);
        var result = false;
        for (var i = 0; i < chObj.length; i++) {
            if (chObj[i].checked) {
                result = true;
                break;
            }
        }
        if (!result) {
            return false;
        } else {
            return true;
        }
    }

    function checkdelete(name)
    {
        if (validcheck(name) == true)
        {
            if (confirm("Please confirm you want to Delete this User(s)"))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else if (validcheck(name) == false)
        {
            alert("Select the check box whom you want to delete.");
            return false;
        }
    }

</script>
<script type="text/javascript">
    function checkall(objForm) {
        len = objForm.elements.length;
        var i = 0;
        for (i = 0; i < len; i++) {
            if (objForm.elements[i].type == 'checkbox') {
                objForm.elements[i].checked = objForm.check_all.checked;
            }
        }
    }
</script>

<style type="text/css">
    .row { margin:0;}
    #normalexamples tbody tr td:nth-child(6),tbody tr td:nth-child(7) {
        text-align:center;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        
        <div class="row">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                <div class="col-sm-12">
<!--                     <div class="btn-group pull-right m-t-15">
                        <a href="<?php echo $sitename; ?>master/addusermaster.htm"><button type="button" class="btn btn-default">Add New</button></a>                        
                    </div>-->
                    
                     <!--<div class="btn-group pull-right m-t-15">-->
                     <!--     <a href="<?php echo $sitename.'pages/master/usersexport.php'; ?>"><button type="button" class="btn btn-success"> Download Users</button></a>-->
                     <!--    </div>-->
                  <h4 class="page-title">Reports</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $sitename; ?>">Webtoall</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
</div>

                <!-- /.box-header -->
            <div class="row">
                    <div class="col-12">
                      
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title">List of Reports</h4>
                            <p class="text-muted font-14 m-b-30">
                             
                                <!--  Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table. -->
                            </p>

                           
<?php if($msg !='') { echo $msg; } 
if($_SESSION['msg']!='') { echo $_SESSION['msg']; $_SESSION['msg']=''; }

if($_REQUEST['project']!='' && $_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$sWhere = " `site`='".$_REQUEST['project']."' AND ( date(`date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."' AND date(`date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."' ) ";    


$query=FETCH_ALL("SELECT SUM(`amount`) as totalamt FROM `report` WHERE `id`!=? AND $sWhere", 0);
$totamt=$query['totalamt'];
}
else
{
 $totamt='';   
}

?>
     
              <form name="form1" method="post" autocomplete="off">
                     <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Search</div>
                        </div>
                        <div class="panel-body">
                            <br>
                            <div class="row">
                             <div class="col-md-1"><strong>Projects</strong></div>
                            <div class="col-md-2">
                            <select name="project" class="form-control" required>
                            <option value="">Select</option> 
                            <?php $proj=pFETCH("SELECT * FROM `report` WHERE `id`!=? GROUP BY `site`",0);
                            while ($projrow = $proj->fetch(PDO::FETCH_ASSOC))
                            { ?>
                            <option value="<?php echo $projrow['site']; ?>" <?php if($_REQUEST['project']==$projrow['site']) { ?> selected="selected" <?php } ?>><?php echo $projrow['site']; ?></option>
                            <?php } ?>
                            </select>
                            </div>
                            <div class="col-md-2"><strong>From Date</strong></div>
                            <div class="col-md-2"><input type="text" name="fromdate" id="datepicker" class="form-control usedatepicker" required="required" value="<?php echo $_REQUEST['fromdate']; ?>"></div>
                            <div class="col-md-1"><strong>To Date</strong></div>
                            <div class="col-md-2"><input type="text" name="todate" id="datepicker1" value="<?php echo $_REQUEST['todate']; ?>" class="form-control usedatepicker" required="required"></div>
                            
                          </div>
                          <br><br>
                          <div class="row">
                              <div class="col-md-4" align="left">  
                              <button type="submit"  id="search" name="search" class="btn btn-success"> Search</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="download" class="btn btn-success"> Download Report</button></div>
                              <?php if($totamt!='') { ?>
                              <div class="col-md-6" align="left"> 
                              <h4>Total Amount : <?php echo $totamt;  ?> USD</h4>
                              </div>
                              <?php } ?>
                          </div>
                            </div>
                            <br>
                        </div>
                       
                       
                            </form> 
                            <br>
                 <form name="form1" method="post" action="">
                                <div class="table-responsive">
                                    <table id="normalexamples" class="table table-bordered table-striped" width="100%">
                                       <thead>
                                <tr>
                                    <th style="width:2%;">S.id</th>
                                    <th style="width:15%; text-align:left;">Date</th>
                                      <th style="width:15%; text-align:left;">Project</th>
                                        <th style="width:15%; text-align:left;">Mobileno</th>
                                          <th style="width:15%; text-align:left;">Cost (USD)</th>
                                           
                                           
                                </tr>
                            </thead>                          
                            <tfoot>
                                <tr>
                                    <th colspan="5">&nbsp;</th>
                                    <!--<th align="center"><button type="submit" class="btn btn-danger" name="delete" id="delete" style="width:100%;" value="Delete" onclick="return checkdelete('chk[]');"> DELETE </button></th>-->
                                </tr>
                            </tfoot>
                                    </table>
                                </div>
                            </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        </div>
            </div>
        </div>
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
    function viewthis(a)
    {
        var did = a;
        window.location.href = '<?php echo $sitename; ?>master/' + a + '/viewuser.htm';
    }     
</script>
<?php
include ('../../require/footer.php');
?>
<script type="text/javascript">
    $('#normalexamples').dataTable({
        "bProcessing": true,
        "bServerSide": false,
        //"scrollX": true,
        "searching": true,
        <?php if($_REQUEST['project']!='' && $_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') { ?>
        "sAjaxSource": "<?php echo $sitename; ?>pages/dataajax/gettablevalues.php?types=reporttable&fromdate=<?php echo $_REQUEST['fromdate']; ?>&todate=<?php echo $_REQUEST['todate']; ?>&project=<?php echo $_REQUEST['project']; ?>"
        <?php } else { ?>
        "sAjaxSource": "<?php echo $sitename; ?>pages/dataajax/gettablevalues.php?types=reporttable"
        <?php } ?>
    });
</script>