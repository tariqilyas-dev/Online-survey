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


if(!isset($access_key_received)) {$helper->errorResponse("access key is required !!");} 
if(empty($access_key_received)) {$helper->errorResponse("access key can not be empty !!");}
if($access_key!=$access_key_received){$helper->errorResponse("access key is incorrect !!");}



if(strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !=0){$helper->errorRequest("Request method must be GET!");}

$sql = "select S.*, Q.*, A.* from survey S INNER  JOIN question Q ON Q.survey_id = S.survey_id INNER  JOIN answeroptions A ON Q.question_id = A.question_id";
$sqlQuery=$mysqlObj->mysqlQuery($sql);

while($result = $sqlQuery->fetch(PDO::FETCH_ASSOC)){

$array = [
'question_id'   => $result['question_id'],
'name'        	=> $result['name'],
'question' 		=> $result['question'],
'ans1'     		=> $result['ans1'],
'ans2'     		=> $result['ans2'],
'ans3'     		=> $result['ans3'],
'ans4'     		=> $result['ans4'],
'trueans'       => $result['trueans']
];

$data[]= $array;
}

$response["status"]= 200;
$response["data"]=  $data; 
echo json_encode($response);    


?>