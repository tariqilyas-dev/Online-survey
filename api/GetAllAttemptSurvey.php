<?php

error_reporting(E_ALL);
ini_set('display_errors','1');

include_once('../admin/includes/connect_db.php');
include_once('../admin/includes/comman_classes.php');


$mysqlObj = new mysql_class();
$helper   = new Helper_class();

$response   = array();

$get    	= $helper->clearSlashes($_GET);

$access_key_received = $get['accesskey'];

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !=0){
$helper->errorRequest("Request method must be GET!");}


if(!isset($access_key_received)) {$helper->errorResponse("access key is required !!");} 
if(empty($access_key_received)) {$helper->errorResponse("access key can not be empty !!");}
if($access_key!=$access_key_received){$helper->errorResponse("access key is incorrect !!");}





$sql = "select D.*, U.*, S.*, Q.* from surveyresponsedetail D INNER  JOIN user U ON D.user_id = U.user_id INNER  JOIN survey S ON D.survey_id = S.survey_id INNER  JOIN question Q ON Q.question_id = D.question_id";
$sqlQuery=$mysqlObj->mysqlQuery($sql);

while($result = $sqlQuery->fetch(PDO::FETCH_ASSOC)){

$array = [
'id'     			=> $result['id'],
'login'     		=> $result['login'],
'survey_attempt'    => $result['survey_attempt'],
'name' 				=> $result['name'],
'question'     		=> $result['question'],
'answer'     		=> $result['answer'],
'answertext'     	=> $result['answertext']
];

$data[]= $array;
}

$response["status"]= 200;
$response["data"]=  $data; 
echo json_encode($response);    

?>