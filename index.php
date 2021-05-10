<?php

  include('session.php'); 
  include('admin/includes/connect_db.php'); 
  include('admin/includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();

  $post    = $helper->clearSlashes($_POST);

  if (isset($post["submit"]))
  {

  $survey_id = $post['survey_id'];

  if (empty($survey_id)) {
  echo "<script type='text/javascript'>alert('Please select the survey')</script>";
  echo "<script>window.location.href = 'index.php'</script>";
  return false;
  }

    echo "<script>window.location.href = 'SurveyStart.php?survey_id=$survey_id'</script>";
  }

  include("head.php");

?>



<div class="container-fluid">
<div style="float: left;">
    <h3>Welcome: <?php echo $_SESSION['user']; ?></h3>
</div>

<div style="float: right;">
    <br/>
    <B><a href="logout.php" class="btn btn-info "><b>logout</b></a></B>
</div>

</div>
 

<br/><br/>

<div class="col-md-4"></div>
  <div class="col-md-5">
    <div class="col-md-12">
    <h2>Select a survey that you want to attend</h2>
   <br/>
  </div>


<div class="input-form" style="background: #d3d3d36e">
    <form method="POST"  enctype="multipart/form-data">

      <select name="survey_id" class="form-control" style="border: 2px solid lightblue; border-radius: 20px; height: 50px; font-size: 20px;">
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
      <input style="border-radius: 20px;" type="submit" class="btn-primary btn" name="submit" id="submit"/>
    </form>
</div>
</div>
