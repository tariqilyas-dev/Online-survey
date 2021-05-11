<?php

error_reporting(E_ALL);
ini_set('display_errors','1');

include_once('../admin/includes/connect_db.php');
include_once('../admin/includes/comman_classes.php');

$mysqlObj = new mysql_class();
$helper   = new Helper_class();


header('Content-Type: application/json');
// header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization X-Reuest-With');


$response = array();

$data = json_decode(file_get_contents("php://input"),true);

// $delete     = $helper->clearSlashes($_DELETE);

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE') !=0){
$helper->errorRequest("Request method must be DELETE!");}

$survey_id    =   $data['survey_id'];

if(empty($survey_id)){
  $helper->errorResponse("Can't empty survey id");
}

$surveyid_existing    = $mysqlObj->existing_data('survey_id', 'survey', 'survey_id', $survey_id);

if ($surveyid_existing['survey_id']!=$survey_id) {
        $response["msg"]="This survey is not exist";
        $response["status"]= 409;
        echo json_encode($response);exit;
}

$del   = $mysqlObj->deleteQuery('survey','survey_id',$survey_id);


if($del==FALSE){
        $response["msg"]="Survey is not deleted";
        $response["status"]= 204;
        echo json_encode($response);exit;
} 


$response["msg"]="Survey deleted successfully!!";
$response["status"]= 200;
echo json_encode($response); 

?>