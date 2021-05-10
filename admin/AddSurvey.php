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

  $name = $post['name'];    
  $totalquestion = $post['totalquestion'];  

  $surveyname_existing    = $mysqlObj->existing_data('name', 'survey', 'name', $name);


  if($surveyname_existing['name']==$name) {
  echo "<script type='text/javascript'>alert('This survey name already exist')</script>";
  echo "<script>window.location.href = 'AddSurvey.php'</script>";
  return false;
  }

    
    $value   = array(
      'name'                  => $name,
      'totalquestion'         => $totalquestion,
      'createdby'             => "ADMIN"
    ); 

    $insert = $mysqlObj->insertData("survey",$value);

    if($insert==TRUE)
    {
    echo "<script>window.location.href='ViewSurvey.php'</script>";
    } 
  }

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
      <input type="text" class="form-control" name="name"  required="" />
      
      <br/>
      <label>Total questions :</label>
      <input type="number" class="form-control" name="totalquestion" required=""/>
      
      <br/>
      <input type="submit" class="btn-primary btn" name="submit" id="submit"/>
    </form>
</div>

</div>

</div>
  
</div>







