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
      <center><h1><b>Question List</b></h1></center>

        <div class="portlet-body">
        <div class="table-responsive">
          
    <table id="example" class="display" style="width:100%">
    <thead>
      <tr>
        <th><h4><b><center>Sr no:</center></b></h4></th>
        <th><h4><b><center>Survey Name:</center></b></h4></th>
        <th><h4><b><center>Questions:</center></b></h4></th>
        <th><h4><b><center>Option 1,2,3,4:</center></b></h4></th>
        <th><h4><b><center>True Option</center></b></h4></th>
        <th><h4><b><center>Delete:</center></b></h4></th>
        <th><h4><b><center>Update:</center></b></h4></th>
       </tr>
    </thead>
   <div id="data_table">
  
  <?php

  $sql="select S.*, Q.*, A.* from survey S INNER  JOIN question Q ON Q.survey_id = S.survey_id INNER  JOIN answeroptions A ON Q.question_id = A.question_id";

  $sqlQuery=$mysqlObj->mysqlQuery($sql);
  $i=1;
  while($result = $sqlQuery->fetch(PDO::FETCH_ASSOC)){
  ?>

  <tr>
   <td><center><?php echo $result['question_id']; ?></center></td>
   <td><center><?php echo $result['name']; ?></center></td>
   <td><center><p align="justify"><?php echo $result['question']; ?></p></center></td>
    <td><center>
      <?php if (!empty($result['ans1']) && !empty($result['ans2']) && !empty($result['ans3']) && !empty($result['ans4']) ) {

      echo $result['ans1']; ?>,
      <?php echo $result['ans2']; ?>,
      <?php echo $result['ans3']; ?>,
      <?php echo $result['ans4'];} ?>
    </center></td>
   <td><center><?php echo $result['trueans']; ?></center></td>
   
   <td><center> <a class="btn btn-danger" href="DeleteQuestion.php?question_id=<?php echo $result['question_id']; ?>"class="text-white">Delete</a></center></td>
  <td><center> <a class="btn btn-warning" href="UpdateQuestion.php?question_id=<?php echo $result['question_id']; ?>" class="text-white">Update</a></center></td>

  </tr>

  <?php $i++; } ?>

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






