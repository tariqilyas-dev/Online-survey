<?php
  
  include('session.php'); 
  include('includes/connect_db.php'); 
  include('includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();

  include("includes/header.php");


 $post    = $helper->clearSlashes($_POST);

 $survey_id =  $_GET['survey_id']; 

 if (isset($post["submit"]))
  {

  $name = $post['name'];    
  $totalquestion = $post['totalquestion'];  


  $update = "UPDATE `survey` SET `name`='$name',`totalquestion`='$totalquestion' WHERE `survey_id`='$survey_id'";

  $result=$mysqlObj->mysqlQuery($update);


    if($result==TRUE)
    {
    echo "<script>window.location.href='ViewSurvey.php'</script>";
    } 
  }

  $sql = "select * from survey where survey_id = $survey_id";
  $sqlQuery=$mysqlObj->mysqlQuery($sql);
  $fetch = $sqlQuery->fetch(PDO::FETCH_ASSOC);
?>

 


<div class="container-fluid">
      
<div id="content" class="container col-md-12">

  <div class="col-md-4"></div>
  <div class="col-md-5">
     <div class="col-md-12">
    <h1>Add Surevy</h1>
    <hr />
  </div>



<div class="input-form">
  <form method="post" enctype="multipart/form-data">
      <label>Survey Name :</label>
      <input type="text" class="form-control" value="<?php echo $fetch['name']; ?>" name="name"  required="" />
      
      <br/>
      <label>Total questions :</label>
      <input type="number" class="form-control" value="<?php echo $fetch['totalquestion']; ?>" name="totalquestion" required=""/>
      
      <br/>
      <input type="submit" class="btn-primary btn" name="submit" id="submit"/>
    </form>
</div>

</div>

</div>
  
</div>







