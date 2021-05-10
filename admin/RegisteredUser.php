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
      <center><h1><b>Survey List</b></h1></center>

        <div class="portlet-body">
        <div class="table-responsive">
    <table id="example" class="display" style="width:100%">
    <thead>
      <tr>
        <th><h4><b><center>Sr no:</center></b></h4></th>
        <th><h4><b><center>First Name:</center></b></h4></th>
        <th><h4><b><center>Last Name:</center></b></h4></th>
        <th><h4><b><center>Mobile:</center></b></h4></th>
        <th><h4><b><center>Total survey attempt:</center></b></h4></th>
        <th><h4><b><center>Created date</center></b></h4></th>
        <th><h4><b><center>Delete:</center></b></h4></th>
       </tr>
    </thead>
   <div id="data_table">
  
  <?php
  $sql = "select * from user";
  $sqlQuery=$mysqlObj->mysqlQuery($sql);
  while($result = $sqlQuery->fetch(PDO::FETCH_ASSOC)){
  ?>

  <tr>
   <td><center><?php echo $result['user_id']; ?></center></td>
   <td><center><?php echo $result['firstname']; ?></center></td>
   <td><center><?php echo $result['lastname']; ?></center></td>
   <td><center><?php echo $result['mobile']; ?></center></td>
   <td><center><?php echo $result['survey_attempt']; ?></center></td>
   <td><center><?php echo $result['createddate']; ?></center></td>
    
   <td><center> <a class="btn btn-primary" href="DeleteUser.php?user_id=<?php echo $result['user_id']; ?>"class="text-white">Delete</a></center></td>
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






