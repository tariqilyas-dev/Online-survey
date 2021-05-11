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


$survey_id        =  $data['survey_id']; 
$question_id      =  $data['question_id']; 
$question         =  $data['question'];
$tooltipquestion  =  $data['tooltipquestion']; 
$isrequired       =  $data['isrequired'];

$opt1             =  $data['opt1']; 
$opt2             =  $data['opt2']; 
$opt3             =  $data['opt3']; 
$opt4             =  $data['opt4'];
$tooltipopt1      =  $data['tooltipopt1']; 
$tooltipopt2      =  $data['tooltipopt2']; 
$tooltipopt3      =  $data['tooltipopt3']; 
$tooltipopt4      =  $data['tooltipopt4'];
$trueans          =  $data['trueans'];



$surveyid_existing    = $mysqlObj->existing_data('*', 'survey', 'survey_id', $survey_id);

$questionid_existing    = $mysqlObj->existing_data('*', 'question', 'question_id', $question_id);

if ($surveyid_existing['survey_id']!=$survey_id) {
        $response["msg"]="This survey id is not exist";
        $response["status"]= 409;
        echo json_encode($response);exit;
}


if ($questionid_existing['question_id']!=$question_id) {
        $response["msg"]="This question id is not exist";
        $response["status"]= 409;
        echo json_encode($response);exit;
}




if(empty($tooltipquestion) && empty($opt3) && empty($trueans) && empty($opt4) && empty($tooltipopt1) && empty($tooltipopt2) && empty($tooltipopt3) && empty($tooltipopt4) && empty($survey_id) && empty($question_id) && empty($isrequired) && empty($opt1) && empty($opt2)){
  $helper->errorResponse("Can't empty survey id, question id, isrequired, opt1 & opt2");
}

if(empty($survey_id)){
  $helper->errorResponse("Can't empty survey id");
}

if(empty($question_id)){
  $helper->errorResponse("Can't empty question id");
} 

if(empty($isrequired)){
  $helper->errorResponse("Can't empty isrequired");
} 


if(empty($question)){
  $helper->errorResponse("Can't empty question");
} 

if(empty($opt1)){
  $helper->errorResponse("Can't empty opt1");
} 

if(empty($opt2)){
  $helper->errorResponse("Can't empty opt2");
}

if(empty($trueans)){
  $helper->errorResponse("Can't empty trueans");
} 

if($isrequired!="YES" && $isrequired!="NO")
{
        $response["msg"]="isrequired either can be YES or NO";
        $response["status"]= 0;
        echo json_encode($response);exit;
}


 $update="UPDATE `question` SET `survey_id`='$survey_id',`question`='$question',`tooltip`='$tooltipquestion',`isrequired`='$isrequired' WHERE `question_id`='$question_id'";

  $result1=$mysqlObj->mysqlQuery($update);


  $update2="UPDATE `answeroptions` SET `ans1`='$opt1',`ans2`='$opt2',`ans3`='$opt3',`ans4`='$opt4',`tooltipans1`='$tooltipopt1',`tooltipans2`='$tooltipopt2',`tooltipans3`='$tooltipopt3',`tooltipans4`='$tooltipopt4',`trueans`='$trueans' WHERE `question_id`='$question_id'";

  $result2=$mysqlObj->mysqlQuery($update2);


if($result1==FALSE && $result2==FALSE){
        $response["msg"]="question is not updated";
        $response["status"]= 204;
        echo json_encode($response);exit;
} 


$response["msg"]="question updated successfully!!";
$response["status"]= 200;
echo json_encode($response); 

?>