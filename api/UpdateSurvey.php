<?php

error_reporting(E_ALL);
ini_set('display_errors','1');

include_once('../admin/includes/connect_db.php');
include_once('../admin/includes/comman_classes.php');

$mysqlObj = new mysql_class();
$helper   = new Helper_class();


header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');


$response = array();

$data = json_decode(file_get_contents("php://input"),true);

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT') !=0){
$helper->errorRequest("Request method must be PUT!");}

$survey_id      = $data['survey_id'];
$name           = $data['name'];    
$totalquestion  = $data['totalquestion'];

$surveyid_existing    = $mysqlObj->existing_data('*', 'survey', 'survey_id', $survey_id);

if ($surveyid_existing['survey_id']!=$survey_id) {
        $response["msg"]="This survey is not exist";
        $response["status"]= 409;
        echo json_encode($response);exit;
}


if ($surveyid_existing['name']==$name) {
        $response["msg"]="This survey name is already exist";
        $response["status"]= 409;
        echo json_encode($response);exit;
}


if(empty($name) && empty($totalquestion)){
  $helper->errorResponse("Can't empty all parameter");
}

if(empty($name)){
  $helper->errorResponse("Can't empty name");
}

if(empty($totalquestion)){
  $helper->errorResponse("Can't empty all totalquestion");
} 



  $update = "UPDATE `survey` SET `name`='$name',`totalquestion`='$totalquestion' WHERE `survey_id`='$survey_id'";

  $result=$mysqlObj->mysqlQuery($update);


if($result==FALSE){
        $response["msg"]="Survey is not inserted";
        $response["status"]= 204;
        echo json_encode($response);exit;
} 


$response["msg"]="Survey updated successfull!!";
$response["status"]= 200;
echo json_encode($response); 

?>