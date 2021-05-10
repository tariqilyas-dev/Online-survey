<?php

  include('session.php'); 
  include('admin/includes/connect_db.php'); 
  include('admin/includes/comman_classes.php');
  include("head.php");

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
  $result2          =  $sqlQuery->fetch(PDO::FETCH_ASSOC);
  $total_question   =  $result2['num'];
 


  $post    = $helper->clearSlashes($_POST);


  $fet2    = "SELECT * FROM surveyresponse ORDER BY ID DESC LIMIT 1";
  $sqlQuery2 = $mysqlObj->mysqlQuery($fet2);
  $fetch2    = $sqlQuery2->fetch(PDO::FETCH_ASSOC);
  $last_id = $fetch2['id']; 


  $fet3    = "SELECT survey_attempt FROM user WHERE user_id = '$user_id' ORDER BY survey_attempt DESC LIMIT 1";
  $sqlQuery3 = $mysqlObj->mysqlQuery($fet3);
  $fetch3    = $sqlQuery3->fetch(PDO::FETCH_ASSOC);

  $survey_attempt =  $fetch3['survey_attempt'];
  $survey_attempt2 = $survey_attempt+1;

 if (isset($post["submit"]))
  {

   $date    = date('Y-m-d H:i:s');
   $update  ="UPDATE `surveyresponse` SET `endtime`='$date' WHERE `id`='$last_id'";
   $result = $mysqlObj->mysqlQuery($update);

   $update2  ="UPDATE `user` SET `survey_attempt`='$survey_attempt2' WHERE `user_id`='$user_id'";
   $result2 = $mysqlObj->mysqlQuery($update2);


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


    $answerradio= $answer1."".$answer2."".$answer3."".$answer4;
    $answerradio2= $answer1.",".$answer2.",".$answer3.",".$answer4;


    if($rows['isrequired']=="YES" && empty($answer) && empty($answerradio)) {
      echo "<script type='text/javascript'>alert('Question number ".$j." is mandatory!!')</script>"; 
        echo "<script>window.location.href = 'SurveyAttempt.php?survey_id=$survey_id'</script>";
        return false; 
    }


   $value   = array(
      'user_id'         => $user_id,
      'survey_id'       => $survey_id,
      'question_id'     => $rows['question_id'],
      'answertext'      => $answer,
      'answer'          => $answerradio2
    ); 

  $insert = $mysqlObj->insertData("surveyresponsedetail",$value);
  $j++;

}
}
  if($result==TRUE && $result2==TRUE && $insert==TRUE){
    ?>

    <script type="text/javascript">
    swal({
    title: "Submit!!",
    text: "Your survey has been succesfully submit.",
    icon: "success",
    closeOnClickOutside: false,
    }).then(function() {
    window.location = "index.php";
    });
    </script>
    <?php
    }

  }

?>

 

<div class="container-fluid">

<div class="row">
  <div class="col-md-4">
    <ul class="pager" style="float: left;">
      <li>
        <?php
        echo '<a href="SurveyStart.php?survey_id='.$survey_id.'">&laquo; &nbsp;Previous page</a>';
        ?>
      </li>
    </ul>
  </div>
    <div class="col-md-4">
              <br/>
              <h3>Survey start by: <strong><?php echo $user; ?></strong>
              <br/><br/>
              Survey start on: <strong>
              <?php echo $fetch2['starttime'] ?></strong>
              </h3>
    
  </div>
    
    <div class="col-md-4">
      <br/>
      <B style="float: right;"><a href="logout.php" class="btn btn-info "><b>logout</b></a></B>
    </div>

</div>

</div>

 
    <div class="col-md-12">
     <center>
    <h1>Survey started</h1>
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
            <span title='Please wait..' data-id='1' id='user_1'>  

            Que.       
            <?php echo $i;?> &nbsp; <?php echo  $result['question']; 
             if ($result['isrequired']=="YES") {
                echo "<span> <font color=red>*</font> </span>";
              }
            ?>

            </span>
          
        </h3>
        

        <?php
        if (empty($result['ans1']) && empty($result['ans2']) && empty($result['ans3']) && empty($result['ans4']) ) {
        ?>

        <textarea name="answer<?php echo $i; ?>" id="answer" placeholder="Answer here" class="form-control" rows="8"></textarea>
        
        <br/><br/>

        <?php  
        } else{
        ?>
        <div class="content-container">
        <br/>
        
        <div class="row">
        <div class="col-md-3">
        <span title='Please wait..' data-id='2' id='user_2'>
        <input type="radio" id="radioBtn" name="answer1<?php echo $i; ?>" value="<?php echo  $result['ans1']; ?>" select multiple> 
            <span style="font-size: 18px;"><?php echo  $result['ans1']; ?></span> 
        </span>
        </div>

        
       
        <div class="col-md-3">
        <span title='Please wait..' data-id='3' id='user_3'>
        <input data-id='3' id="radioBtn" type="radio" name="answer2<?php echo $i; ?>" value="<?php echo  $result['ans2']; ?>" select multiple> 
         <span style="font-size: 18px;"><?php  echo  $result['ans2']; ?></span>
        </span>
        </div>

       
        </div>
        <br/><br/>

        
        <div class="row">
        <div class="col-md-3">
        <span title='Please wait..' data-id='4' id='user_4'>
        <input data-id='4' id="radioBtn" type="radio" name="answer3<?php echo $i; ?>" value="<?php echo  $result['ans3']; ?>" select multiple> 
         <span style="font-size: 18px;"><?php  echo  $result['ans3']; ?></span>
        </span>
        </div>
        
        <div class="col-md-3">
        <span title='Please wait..' data-id='5' id='user_5'>
        <input data-id='5' id="radioBtn" type="radio" name="answer4<?php echo $i; ?>" value="<?php echo  $result['ans4']; ?>" select multiple>    
        <span style="font-size: 18px;">
         <?php  echo  $result['ans4']; ?></span>
        </span>
        </div>
        </div>
         <br><br> 
        </div>
        <br><br>
        <br><br>
        <?php
      }


      $i++;
        }

      ?>  

</div>
<br><br>
<input type="submit" class="btn-primary btn" value="Submit survey" name="submit" id="submit"/>   
<br><br> 
</form>



</div>
<script type="text/javascript">
$(document).on("click", "input[id='radioBtn']", function(){
    thisRadio = $(this);
    if (thisRadio.hasClass("imChecked")) {
        thisRadio.removeClass("imChecked");
        thisRadio.prop('checked', false);
    } else { 
        thisRadio.prop('checked', true);
        thisRadio.addClass("imChecked");
    };
})
</script>


<script type="text/javascript">
  $(document).ready(function(){

    // initialize tooltip
    $( ".content span" ).tooltip({
        track:true,
        open: function( event, ui ) {
              var id = this.id; 
              var userid = $(this).attr('data-id');
              
              $.ajax({
                  url:'Fetch_Details.php',
                  type:'post',
                  data:{userid:userid},
                  success: function(response){
                      // Setting content option
                      alert("Data: " + response);
                       
                      // $("#"+id).tooltip('option','content',response);
                  }
              });
        }
    });

    $(".content span").mouseout(function(){
        // re-initializing tooltip
        $(this).attr('title','Please wait...');
        $(this).tooltip();
        $('.ui-tooltip').hide();
    });

    
});



</script>