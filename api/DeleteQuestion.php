<?php

error_reporting(E_ALL);
ini_set('display_errors','1');

include_once('../admin/includes/connect_db.php');
include_once('../admin/includes/comman_classes.php');

$mysqlObj = new mysql_class();
$helper   = new Helper_class();


header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');


$response = array();

$data = json_decode(file_get_contents("php://input"),true);

// $delete     = $helper->clearSlashes($_DELETE);

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE') !=0){
$helper->errorRequest("Request method must be DELETE!");}

$question_id    =   $data['question_id'];

if(empty($question_id)){
  $helper->errorResponse("Can't empty question id");
}

$question_existing    = $mysqlObj->existing_data('question_id', 'question', 'question_id', $question_id);

if ($question_existing['question_id']!=$question_id) {
        $response["msg"]="This question id is not exist";
        $response["status"]= 409;
        echo json_encode($response);exit;
}

$del   = $mysqlObj->deleteQuery('question','question_id',$question_id);

$del2   = $mysqlObj->deleteQuery('answeroptions','question_id',$question_id);

if($del==FALSE && $del2==FALSE){
        $response["msg"]="question is not deleted";
        $response["status"]= 204;
        echo json_encode($response);exit;
} 


$response["msg"]="question deleted successfully!!";
$response["status"]= 200;
echo json_encode($response); 

?>