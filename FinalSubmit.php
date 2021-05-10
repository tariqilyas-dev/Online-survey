<?php

  include('session.php'); 
  include('admin/includes/connect_db.php'); 
  include('admin/includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();
  

  $user      =  $_SESSION['user'];
  $survey_id =  $_GET['survey_id']; 

  $userid    = $mysqlObj->existing_data('*', 'user', 'login', $user);
  $user_id   = $userid['user_id'];
  // echo $user; exit;


  $survey    = $mysqlObj->existing_data('*', 'survey', 'survey_id', $survey_id);

  $surveyname = $survey['name'];
  $totalquestion = $survey['totalquestion'];
  // echo $totalquestion; exit;  

  $post    = $helper->clearSlashes($_POST);

  if (isset($post['edit'])) {
    echo "<script>window.location.href='EditSurveyAttempt.php?survey_id=$survey_id'</script>";
  }

 $date = date('Y-m-d H:i:s'); 

  include("head.php");

?>



<div class="col-md-4"></div>
    <h1>Sucessfully submit!!</h1>
    <div class="col-md-12">
    <h2>You can preview and edit your survey<br/>&nbsp;&nbsp;or <br/>You can logout</h2>
    <hr />

<form name="" method="POST">
<button type="submit" class="btn-primary btn" value="Edit survey" name="edit" id="edit"/>Edit your survey</button>
</form>
<br>
<B><a href="logout.php" class="btn btn-info "><b>logout</b></a></B>
<br>


</div>
