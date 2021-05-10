<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once('../admin/includes/connect_db.php');
include_once('../admin/includes/comman_classes.php');

$mysqlObj = new mysql_class();
$helper   = new Helper_class();

if($db_conn->connect_error){errorResponse("error in server");}

$response = array();

$post     = $helper->clearSlashes($_POST);

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !=0){
$helper->errorResponse("Request method must be POST!");}


$survey_id      = $post['survey_id'];
$question       = $post['question'];
$tooltip        = $post['tooltipquestion'];
$isrequired     = $post['isrequired'];

$survey_id_existing  = $mysqlObj->existing_data('survey_id', 'survey', 'survey_id', $survey_id); 

if ($survey_id_existing['survey_id']!=$survey_id) {
        $response["msg"]="This survey id is not valid";
        $response["status"]= 0;
        echo json_encode($response);exit;
}

if(empty($survey_id) && empty($question)  && empty($tooltip)  && empty($isrequired))
{
        $response["msg"]="Can't empty all parameter";
        $response["status"]= 0;
        echo json_encode($response);exit;
}

if($isrequired!="YES" && $isrequired!="NO")
{
        $response["msg"]="isrequired either can be YES or NO";
        $response["status"]= 0;
        echo json_encode($response);exit;
}

if(empty($survey_id))
{
        $response["msg"]="Survey ID can not empty";
        $response["status"]= 0;
        echo json_encode($response);exit;
}

if(empty($question))
{
        $response["msg"]="Can't empty question";
        $response["status"]= 0;
        echo json_encode($response);exit;
}


if(empty($isrequired))
{
        $response["msg"]="Can't empty isrequired";
        $response["status"]= 0;
        echo json_encode($response);exit;
}


$value1  = array(
      'survey_id'             => $survey_id,
      'question'              => $question,
      'tooltip'               => $tooltip,
      'isrequired'            => $isrequired
    ); 

$insert1  = $mysqlObj->insertData("question",$value1);
  
$LastinsertID  = $mysqlObj->existing_data('question_id', 'question', 'question', $post['question']); 


$value2   = array(
      'question_id'       => $LastinsertID['question_id'],
      'ans1'              => $post['ans1'],
      'ans2'              => $post['ans2'],
      'ans3'              => $post['ans3'],
      'ans4'              => $post['ans4'],
      'trueans'           => $post['trueans'],
      'tooltipans1'       => $post['tooltipopt1'],
      'tooltipans2'       => $post['tooltipopt2'],
      'tooltipans3'       => $post['tooltipopt3'],
      'tooltipans4'       => $post['tooltipopt4']
    ); 

      
$insert2 = $mysqlObj->insertData("answeroptions",$value2);

if($insert1==FALSE && $insert2==FALSE)
{
        $response["msg"]="question is not inserted";
        $response["status"]= 0;
        echo json_encode($response);exit;
} 


$response["msg"]="Add question successfull!!";
$response["status"]= 1;
echo json_encode($response); 

?>