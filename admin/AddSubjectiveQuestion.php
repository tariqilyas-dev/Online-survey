<?php
  
  include('session.php'); 
  include('includes/connect_db.php'); 
  include('includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();

  include("includes/header.php");

 $post    = $helper->clearSlashes($_POST);

 if (isset($post["submit"]))
  { 

  if (empty($post['survey_id'])) {
  echo "<script type='text/javascript'>alert('Please select the survey')</script>";
  echo "<script>window.location.href = 'AddSubjectiveQuestion.php'</script>";
  return false;
  }

    if (empty($post['isrequired'])) {
  echo "<script type='text/javascript'>alert('Please select the question is reuired or not ')</script>";
  echo "<script>window.location.href = 'AddSubjectiveQuestion.php'</script>";
  return false;
  }

    $value1   = array(
      'survey_id'             => $post['survey_id'],
      'question'              => $post['question'],
      'tooltip'               => $post['tooltipquestion'],
      'isrequired'            => $post['isrequired']
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

    if($insert1==TRUE && $insert2==TRUE)
    {
    echo "<script>window.location.href='ViewQuestion.php'</script>";
    } 
  }

?>
  

<div class="container-fluid">
      
<div id="content" class="container col-md-12">
 
  <div class="col-md-4"></div>
  <div class="col-md-5">
    <div class="col-md-12">
    <h1>Add Subjective Qestions</h1>
    <hr />
  </div>

  <div class="input-form">
    <form method="post" enctype="multipart/form-data">

      <label>Survey :</label>
      <select name="survey_id" class="form-control">
      <option selected disabled>select</option>
        <?php   
        $fet="select * from survey";
        $sqlQuery=$mysqlObj->mysqlQuery($fet);
        while($result = $sqlQuery->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <option value="<?php echo  $result['survey_id']; ?>"> <?php  echo  $result['name']; ?></option>
        <?php
        }
        ?>  
      </select>
    
    <br/>

      <label>Question is required :</label>
      <select name="isrequired" class="form-control">
      <option selected disabled>select</option>
        <option value="YES">Yes</option>
        <option value="NO">No</option>
      </select>
    
    <br/>

      <label>Question :</label>
       <textarea name="question" id="question" class="form-control" rows="12" required=""></textarea>

       <br/>
       <label>Tooltip for Question :</label>
       <textarea name="tooltipquestion" id="tooltipquestion" class="form-control" rows="8"></textarea>
      
       <br>
      <input type="submit" class="btn-primary btn" name="submit" id="submit"/>
    </form>
<br><br>
  </div>

  
</div>
  

</div>







