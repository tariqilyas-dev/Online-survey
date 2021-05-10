<?php

  include('session.php'); 
  include('admin/includes/connect_db.php'); 
  include('admin/includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();
  
  $user      =  $_SESSION['user'];
  $survey_id =  $_GET['survey_id']; 
  // echo $user; exit;

  $userid    = $mysqlObj->existing_data('*', 'user', 'login', $user);
  $user_id   = $userid['user_id'];
  // echo $user_id; exit;
  

  $sql_order    = "SELECT COUNT(*) as num FROM question where survey_id = $survey_id";

  $sqlQuery         =  $mysqlObj->mysqlQuery($sql_order);
  $result           =  $sqlQuery->fetch(PDO::FETCH_ASSOC);
  $total_question   =  $result['num'];
 


  $post    = $helper->clearSlashes($_POST);

 

 if (isset($post["submit"]))
  {
    
   $date    = date('Y-m-d H:i:s');
   $update  ="UPDATE `surveyresponse` SET `endtime`='$date' WHERE `takenby`='$user'";
   $result = $mysqlObj->mysqlQuery($update);

   $j=1;

  while ($j<=$total_question) {

  $fet="select * from question where survey_id = $survey_id";
  $sqlQuery = $mysqlObj->mysqlQuery($fet);
  while($rows = $sqlQuery->fetch(PDO::FETCH_ASSOC)){ 

    $ans  = "answer".$j;
    $ans1 = "answer1".$j;
    $ans2 = "answer2".$j;
    $ans3 = "answer3".$j;
    $ans4 = "answer4".$j;
    
    $answer  = $post[$ans];
    $answer1 = $post[$ans1];
    $answer2 = $post[$ans2];
    $answer3 = $post[$ans3];
    $answer4 = $post[$ans4];


    $answerradio= $answer1.",".$answer2.",".$answer3.",".$answer4;

   $value   = array(
      'user_id'       => $user_id,
      'survey_id'     => $survey_id,
      'question_id'   => $rows['question_id'],
      'answertext'    => $answer,
      'answer'        => $answerradio

    ); 

  

  $insert2 = $mysqlObj->insertData("surveyresponsedetail",$value);
  $j++;
}
}
  if($result==TRUE && $insert2==TRUE){
    echo "<script>window.location.href = 'FinalSubmit.php?survey_id=$survey_id'</script>";
    }

  }

  include("head.php");

?>



<div class="container-fluid">
<div style="float: left;">
    <h3>Survey Edit by: <?php echo $user; ?></h3>
</div>

<div style="float: right;">
    <B><a href="logout.php" class="btn btn-info "><b>logout</b></a></B>
</div>

</div>
 


 
    <div class="col-md-12">
     <center>
    <h1>Edit Survey</h1>
    <hr/>
    </center> 
    <br/>

<div class="input-form">
<form name="" method="POST">


        <?php   
         $fet="select Q.*, A.* from answeroptions A INNER  JOIN question Q ON Q.question_id = A.question_id where survey_id = $survey_id";
        $i=1;
        
        $sqlQuery=$mysqlObj->mysqlQuery($fet);
        while($result = $sqlQuery->fetch(PDO::FETCH_ASSOC)) {
        ?>

        
        <h3>
          <span class='content'>
            <span title='Please wait..' data-id='1' id='user_1'>  
            Que.       
            <?php echo $i;?> &nbsp; <?php echo  $result['question']; ?>
            </span>
          </span>
        </h3>
        

        <?php
        if (empty($result['ans1']) && empty($result['ans2']) && empty($result['ans3']) && empty($result['ans4']) ) {
        ?>

        <textarea required="" name="answer<?php echo $i; ?>" id="answer" placeholder="Answer here" class="form-control" rows="8"></textarea>
        <?php  
        } else{
        ?>

   
        <input type="radio" name="answer1<?php echo $i; ?>" value="<?php echo  $result['ans1']; ?>" select multiple>     
            <?php echo  $result['ans1']; ?> &nbsp;&nbsp;&nbsp;
     
            <br/>
        <input type="radio" name="answer2<?php echo $i; ?>" value="<?php echo  $result['ans2']; ?>" select multiple>        
         <?php  echo  $result['ans2']; ?>
         <br/>

        <input type="radio" name="answer3<?php echo $i; ?>" value="<?php echo  $result['ans3']; ?>" select multiple> 
         <?php  echo  $result['ans3']; ?>&nbsp;&nbsp;&nbsp;
    
         <br/>
        <input type="radio" name="answer4<?php echo $i; ?>" value="<?php echo  $result['ans4']; ?>" select multiple>    
         <?php  echo  $result['ans4']; ?>
        <br><br>
        
        <?php
      }


      $i++;
        }

      ?>  


<br><br>
<input type="submit" class="btn-primary btn" value="Submit survey" name="submit" id="submit"/>   
<br><br> 
</form>

</div>

</div>


