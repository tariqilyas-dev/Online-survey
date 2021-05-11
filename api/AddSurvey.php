<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once('../admin/includes/connect_db.php');
include_once('../admin/includes/comman_classes.php');

$mysqlObj = new mysql_class();
$helper   = new Helper_class();


$response = array();

$post     = $helper->clearSlashes($_POST);

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !=0){
$helper->errorRequest("Request method must be POST!");}


$name = $post['name'];    
$totalquestion = $post['totalquestion'];

$surveyname_existing    = $mysqlObj->existing_data('name', 'survey', 'name', $name);

if ($surveyname_existing['name']==$name) {
        $response["msg"]="This survey is already exist";
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


    $value   = array(
      'name'                  => $name,
      'totalquestion'         => $totalquestion,
      'createdby'             => "ADMIN"
    ); 


    $insert = $mysqlObj->insertData("survey",$value);

if($insert==FALSE)
{
        $response["msg"]="Survey is not inserted";
        $response["status"]= 204;
        echo json_encode($response);exit;
} 


$response["msg"]="Add Survey successfull!!";
$response["status"]= 200;
echo json_encode($response); 

?>