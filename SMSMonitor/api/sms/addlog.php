<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

// get database connection
include_once '../config/database.php';

 
// instantiate product object
include_once '../objects/form.php';
$database = new Database();
$db = $database->getConnection();
 
 
$form = new Form($db);
 
// make sure data is not empty
if(
    !empty($_REQUEST['site']) && !empty($_REQUEST['countrycode']) &&
    !empty($_REQUEST['mobileno'])
){
    $query = "INSERT INTO `report`
            SET
               site='".$_REQUEST['site']."',countrycode='".$_REQUEST['countrycode']."', mobileno='".$_REQUEST['mobileno']."', cudate='".date('Y-m-d')."',amount='0.02',message='".$_REQUEST['message']."' ";

    // prepare query
    $stmt = $db->prepare($query);
     if($stmt->execute()){
      http_response_code(200);
 
    // tell the user
    echo json_encode(array("success" => "true", "message" => "SMS Report Added"));  
        
    }
    else
    {
     http_response_code(404);
 
    // tell the user
    echo json_encode(array("success" => "false", "message" => "SMS Report Not Added"));     
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to create user. Data is incomplete."));
}


?>