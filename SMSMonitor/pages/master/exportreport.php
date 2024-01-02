<?php include ('../../config/config.inc.php');
$filename = "sms-report.csv";
$fp = fopen('php://output', 'w');

$header=array("Date","Site","Mobileno","Cost(USD)");

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

 $sWhere = " `site`='".$_REQUEST['project']."' AND ( date(`date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."' AND date(`date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."' ) ";    


$query=pFETCH("SELECT * FROM `report` WHERE `id`!=? AND $sWhere", 0);
while ($row = $query->fetch(PDO::FETCH_ASSOC))
{
    extract($row);
    
    if($row['date']!='')
     {
       $registerdate=date("d-m-Y g:i a",strtotime($row['date']));  
     }
     else
     {
       $registerdate='-';  
     }   
     
     $res=array($registerdate,$site,$mobileno,$amount);  
     fputcsv($fp, $res);
}
exit;
?>