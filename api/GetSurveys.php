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

$sql = "select * from survey";
$sqlQuery=$mysqlObj->mysqlQuery($sql);

while($result = $sqlQuery->fetch(PDO::FETCH_ASSOC)){

$array = [
'survey_id'     => $result['survey_id'],
'name'        	=> $result['name'],
'totalquestion' => $result['totalquestion'],
'createdby'     => $result['createdby'],
'createdon'     => $result['createdon']
];

$data[]= $array;
}

$response["status"]= 200;
$response["data"]=  $data; 
echo json_encode($response);    


?>