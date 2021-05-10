<?php
  
  include('session.php'); 
  include('includes/connect_db.php'); 
  include('includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();

  include("includes/header.php");

?>


<div class="container-fluid">
      
<div id="content" class="container col-md-12">
      <center><h1><b>All Attempted Survey List</b></h1></center>

        <div class="portlet-body">
        <div class="table-responsive">
          
    <table id="example" class="display" style="width:100%">
    <thead>
      <tr>
        <th><h4><b><center>Sr no:</center></b></h4></th>
        <th><h4><b><center>User:</center></b></h4></th>
        <th><h4><b><center>Total Survey Attempt:</center></b></h4></th>
        <th><h4><b><center>Survey:</center></b></h4></th>
        <th><h4><b><center>Question:</center></b></h4></th>
        <th><h4><b><center>Answer</center></b></h4></th>
        <th><h4><b><center>Text Answer</center></b></h4></th>
        <th><h4><b><center>Delete:</center></b></h4></th>
       </tr>
    </thead>
   <div id="data_table">
  
  <?php

  $sql="select D.*, U.*, S.*, Q.* from surveyresponsedetail D INNER  JOIN user U ON D.user_id = U.user_id INNER  JOIN survey S ON D.survey_id = S.survey_id INNER  JOIN question Q ON Q.question_id = D.question_id";

  $sqlQuery=$mysqlObj->mysqlQuery($sql);
  $i=1;
  while($result = $sqlQuery->fetch(PDO::FETCH_ASSOC)){

  ?>

  <tr>
   <td><center><?php echo $i ?></center></td>
   <td><center><?php echo $result['login']; ?></center></td>
   <td><center><?php echo $result['survey_attempt']; ?></center></td>
   <td><center><?php echo $result['name']; ?></center></td>
   <td><center><p align="justify"><?php echo $result['question']; ?></p></center></td>
   <td><center><?php echo $result['answer']; ?></center></td>
   <td><center><?php echo $result['answertext']; ?></center></td>
   
   <td><center> <a class="btn btn-danger" href="DeleteAttemptSurvey.php?Attempt_id=<?php echo $result['id']; ?>"class="text-white">Delete</a></center></td>

  </tr>

  <?php
  $i++;
  } ?>

  </div>
    </table>
    </div>
  </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>






