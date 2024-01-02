<?php
include ('../../config/config.inc.php');

//ini_set('display_errors','1');
//error_reporting(E_ALL);
function mres($value) {
    $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
    $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");
    return str_replace($search, $replace, $value);
}
if ($_REQUEST['types'] == 'reporttable') {
    $aColumns = array('id', 'date','site','mobileno','amount');
    $sIndexColumn = "id";
    //$editpage = ($_REQUEST['db_table_for'] == 'live') ? "edit" : "editstati";
    $sTable = "report";
}
if ($_REQUEST['types'] == 'projecttable') {
    $aColumns = array('id', 'website');
    $sIndexColumn = "id";
    //$editpage = ($_REQUEST['db_table_for'] == 'live') ? "edit" : "editstati";
    $sTable = "websites";
}

/* Declaration table name start here */



$aColumns1 = $aColumns;

function fatal_error($sErrorMessage = '') {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
    die($sErrorMessage);
}

$sLimit = "";

if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
}


    $sOrder = "ORDER BY `$sIndexColumn` DESC";


if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    if (in_array("order", $aColumns)) {
        $sOrder .= "`order` asc, ";
    } else if (in_array("Order", $aColumns)) {
        $sOrder .= "`Order` asc, ";
    }
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " . ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
        }
        $sOrder = substr_replace($sOrder, "", -2);
        if ($sOrder == "ORDER BY ") {
            $sOrder = " ";
        }
    }
}

$sWhere = "";


if ($sWhere != '') {

     $sWhere = "WHERE `$sIndexColumn`!='' $sWhere";    
  
}
else
{


    if ($_REQUEST['types'] == 'registertable') {
     $sWhere = "WHERE `trash`='0' ";    
}if ($_REQUEST['types'] == 'deleteduserrtable') {
     $sWhere = "WHERE `trash`='1' ";    
}

if($_REQUEST['types'] == 'payordertable')
{
  $sWhere = "WHERE `paymode`='Online Payment' ";      
}
}

if ($_REQUEST['fromdate'] != '' && $_REQUEST['todate'] != '' && $_REQUEST['project'] != '') {
     $sWhere = "WHERE `site`='".$_REQUEST['project']."' AND ( date(`date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."' AND date(`date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."' ) ";    
}

$sQuery = "SELECT SQL_CALC_FOUND_ROWS `" . str_replace(",", "`,`", implode(",", $aColumns)) . "` FROM $sTable $sWhere $sOrder $sLimit ";


$rResult = $db->prepare($sQuery);
$rResult->execute();


$sQuery = "SELECT FOUND_ROWS()";

$rResultFilterTotal = $db->prepare($sQuery);
$rResultFilterTotal->execute();

$aResultFilterTotal = $rResultFilterTotal->fetch();
$iFilteredTotal = $aResultFilterTotal[0];

$sQuery = "SELECT COUNT(" . $sIndexColumn . ") FROM $sTable";
$rResultTotal = $db->prepare($sQuery);
$rResultTotal->execute();

$aResultTotal = $rResultTotal->fetch();
$iTotal = $aResultTotal[0];

$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

$ij = 1;
$k = $_GET['iDisplayStart'];

while ($aRow = $rResult->fetch(PDO::FETCH_ASSOC)) {
    $k++;
    $row = array();
    $row1 = '';
    for ($i = 0; $i < count($aColumns1); $i++) {
         if ($_REQUEST['types'] == 'questiontable') {

            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'question') {
             
                  $row[] .= '<a href="'.$sitename.'master/'.$aRow['id'].'/viewknowledge.htm">'.$aRow[$aColumns1[$i]].'</a>';

            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } 
        else if ($_REQUEST['types'] == 'reporttable') {

            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'date') {
             
                  $row[] .= date('d-m-Y', strtotime($aRow[$aColumns1[$i]]));

            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } 
        else {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'Status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
    }

    /* Edit page  change start here */
  
    if (($_REQUEST['types'] == 'registertable')) {
        $row[] = "<i class='fa fa-eye' onclick='javascript:viewthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> </i>";
    }
    elseif(($_REQUEST['types'] == 'chattable'))
    {
         $row[] = "<i class='fa fa-edit' onclick='javascript:editthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> Edit </i>";
      $row[] = "<i class='fa fa-eye' onclick='javascript:viewthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> </i>";
      
    }
    else {
        if($_REQUEST['types'] != 'ordertable' && $_REQUEST['types'] != 'payordertable' && $_REQUEST['types'] != 'filterordertable' && $_REQUEST['types'] != 'cancelordertable')
        {
        $row[] = "<i class='fa fa-edit' onclick='javascript:editthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> Edit </i>";
        }
        
    }

    if ($_REQUEST['types'] == 'ordertable' || $_REQUEST['types'] == 'payordertable' || $_REQUEST['types'] == 'filterordertable' || $_REQUEST['types'] == 'cancelordertable') {
        $row[] = "<i class='fa fa-eye' onclick='javascript:viewthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> </i>";
    } else if ($_REQUEST['types'] == 'customertable') {
        $row[] = "<i class='fa fa-eye' onclick='javascript:editthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'></i>";
    }
    $row[] = '<input type="checkbox"  name="chk[]" id="chk[]" value="' . $aRow[$sIndexColumn] . '" />';



    $output['aaData'][] = $row;
    $ij++;
}

echo json_encode($output);
?>
 
