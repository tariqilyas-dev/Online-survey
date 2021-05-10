<?php
  
  include('session.php'); 
  include('includes/connect_db.php'); 
  include('includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();

  include("includes/header.php");


 $post    = $helper->clearSlashes($_POST);

 $question_id =  $_GET['question_id']; 
// echo $question_id; exit;

 if (isset($post["submit"]))
  { 
  extract($post);
  
  if (empty($post['survey_id'])) {
  echo "<script type='text/javascript'>alert('Please select the survey')</script>";
  echo "<script>window.location.href = 'UpdateQuestion.php'</script>";
  return false;
  }

      // $survey_id            = $post['survey_id'];
      // $question             = $post['question'];
      // $tooltip              = $post['tooltipquestion'];
      // $isrequired           = $post['isrequired'];

      // echo $survey_id; exit;

  $update="UPDATE `question` SET `survey_id`='$survey_id',`question`='$question',`tooltip`='$tooltipquestion',`isrequired`='$isrequired' WHERE `question_id`='$question_id'";

  $result1=$mysqlObj->mysqlQuery($update);


  $update2="UPDATE `answeroptions` SET `ans1`='$ans1',`ans2`='$ans2',`ans3`='$ans3',`ans4`='$ans4',`tooltipans1`='$tooltipans1',`tooltipans2`='$tooltipans2',`tooltipans3`='$tooltipans3',`tooltipans4`='$tooltipans4',`trueans`='$trueans' WHERE `question_id`='$question_id'";

  $result2=$mysqlObj->mysqlQuery($update2);


    if($result1==TRUE && $result2==TRUE)
    {
    echo "<script>window.location.href='ViewQuestion.php'</script>";
    } 

  }

  $sql="select S.*, Q.*, A.* from survey S INNER  JOIN question Q ON Q.survey_id = S.survey_id INNER  JOIN answeroptions A ON Q.question_id = A.question_id where Q.question_id = $question_id";
  $sqlQuery = $mysqlObj->mysqlQuery($sql);
  $result   = $sqlQuery->fetch(PDO::FETCH_ASSOC);

  // echo $result['answer_id']; exit;
?>
  

<div class="container-fluid">
      
<div id="content" class="container col-md-12">
 
  <div class="col-md-4"></div>
  <div class="col-md-5">
    <div class="col-md-12">
    <h1>Update Questions</h1>
    <p></p>
    <hr />
  </div>

  <div class="input-form">
    <form method="post" enctype="multipart/form-data">

      <label>Survey :</label>
      <select name="survey_id" class="form-control" value="<?php echo $result['survey_id']; ?>">
        <?php   
        $fet="select * from survey";
        $sqlQuery=$mysqlObj->mysqlQuery($fet);
        while($fetch = $sqlQuery->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <option value="<?php  echo  $fetch['survey_id']; ?>" <?php if($fetch['survey_id']==$result['survey_id']){ echo "selected"; } ?>> <?php  echo  $fetch['name']; ?>
        </option>
        <?php
        }
        ?>  
      </select>
    
    <br/>

      <label>Question is required :</label>
      <?php   
        $fet = "select * from question where question_id = $question_id";
        $sqlQuery = $mysqlObj->mysqlQuery($fet);
        $fetch2 = $sqlQuery->fetch(PDO::FETCH_ASSOC);
        
        ?>

     
      <select name="isrequired" class="form-control" value="<?php echo $result['isrequired']; ?>">
        
        <option value="<?php  echo  $fetch2['isrequired']; ?>"> <?php  echo  $fetch2['isrequired'];

        if (empty($fetch2['isrequired'])) {
          ?>
        <option selected disabled>select</option>
        <option value="YES">YES</option>
        <option value="NO">NO</option>
          <?php
        } else{
        if ($fetch2['isrequired']=="YES") {
         ?>
         <option value="NO">NO</option>
         
         <?php
        } else{
          ?>
          <option value="YES">YES</option>
          <?php
        }
        }

        ?>
        </option>
        
        
      </select>
  
    
    <br/>

      <label>Question :</label>
       <textarea name="question" id="question" class="form-control" rows="12" value="<?php echo $result['question']; ?>">
         <?php echo $result['question']; ?>
       </textarea>

       <br/>
       <label>Tooltip for Question :</label>
       <textarea name="tooltipquestion" id="tooltipquestion" class="form-control" rows="8" value="<?php echo $result['tooltip']; ?>">
        <?php echo $result['tooltip']; ?> 
       </textarea>
      
              <br/>
      <label>Option1</label>
      <input type="text" class="form-control" name="ans1" value="<?php echo $result['ans1']; ?>" />

                  <br/>
      <label>Tooltip option1</label>
      <input type="text" class="form-control" name="tooltipans1" value="<?php echo $result['tooltipans1']; ?>"/>

            <br/>
      <label>Option2</label>
      <input type="text" class="form-control" name="ans2" value="<?php echo $result['ans2']; ?>"/>

                        <br/>
      <label>Tooltip option2</label>
      <input type="text" class="form-control" name="tooltipans2" value="<?php echo $result['tooltipans2']; ?>"/>


            <br/>
      <label>Option3</label>
      <input type="text" class="form-control" name="ans3" value="<?php echo $result['ans3']; ?>"/>

                        <br/>
      <label>Tooltip option3</label>
      <input type="text" class="form-control" name="tooltipans3" value="<?php echo $result['tooltipans3']; ?>"/>


            <br/>
      <label>Option4</label>
      <input type="text" class="form-control" name="ans4" value="<?php echo $result['ans4']; ?>"/>

                  <br/>
      <label>Tooltip option4</label>
      <input type="text" class="form-control" name="tooltipans4" value="<?php echo $result['tooltipans4']; ?>"/>

                  <br/>
      <label>True option</label>
      <input type="text" class="form-control" name="trueans" value="<?php echo $result['trueans']; ?>"/>
      <br/>
      <input type="submit" class="btn-primary btn" name="submit" id="submit"/>
    </form>
<br><br>
  </div>

  
</div>
  

</div>