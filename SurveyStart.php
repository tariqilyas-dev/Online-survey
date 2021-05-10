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

 $date = date('Y-m-d H:i:s');

 $post    = $helper->clearSlashes($_POST);

 if (isset($post["submit"]))
  {

    $value1   = array(
      'user_id'                     => $user_id
    ); 

    $insert1  = $mysqlObj->insertData("contact",$value1);

    $value2   = array(
      'user_id'       => $user_id,
      'takenby'       => $user
    ); 

      
    $insert2 = $mysqlObj->insertData("surveyresponse",$value2);

    if($insert1==TRUE && $insert2==TRUE)
    {
    echo "<script>window.location.href = 'SurveyAttempt.php?survey_id=$survey_id'</script>";
    }

  }

  

  include("head.php");

?>



  
  <?php
    $fet2    = "SELECT * FROM surveyresponse ORDER BY ID DESC LIMIT 1";
  $sqlQuery2 = $mysqlObj->mysqlQuery($fet2);
  $fetch2    = $sqlQuery2->fetch(PDO::FETCH_ASSOC);
  ?>
<div class="container-fluid">

<div class="row">
  <div class="col-md-4">
    <ul class="pager" style="float: left;">
      <li>
        <?php
        echo '<a href="index.php">&laquo; &nbsp;Previous page</a>';
        ?>
      </li>
    </ul>
  </div>
    <div class="col-md-4">
              <br/>
              <h3>Survey taking by: <strong><?php echo $user; ?></strong>
              </h3>
    
  </div>
    
    <div class="col-md-4">
      <br/>
      <B style="float: right;"><a href="logout.php" class="btn btn-info "><b>logout</b></a></B>
    </div>

</div>

</div>
 

<div class="col-md-4"></div>
  
  <div class="col-md-5">
    <br>
    <div class="input-form" style="background: #d3d3d36e">
  
    <h1>Start your survey</h1>
    <hr />
    <h3>Survey Name - <?php echo $surveyname; ?> </h3>
    <h3>Total Question - <?php echo $totalquestion; ?> </h3>
<br>

<form name="" method="POST">
<input type="submit" class="btn-primary btn" value="Start survey" name="submit" id="submit"/>    
</form>



</div>
</div>
