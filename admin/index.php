<?php

  include('session.php'); 
  include('includes/connect_db.php'); 
  include('includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();
 
  $sql_order     = "SELECT COUNT(*) as num FROM admin";
  $sqlQuery         =  $mysqlObj->mysqlQuery($sql_order);
  $result           =  $sqlQuery->fetch(PDO::FETCH_ASSOC);
  $total_admin   =  $result['num'];

  $sql_order     = "SELECT COUNT(*) as num FROM user";
  $sqlQuery         =  $mysqlObj->mysqlQuery($sql_order);
  $result           =  $sqlQuery->fetch(PDO::FETCH_ASSOC);
  $total_user   =  $result['num'];

  $sql_order     = "SELECT COUNT(*) as num FROM survey";
  $sqlQuery         =  $mysqlObj->mysqlQuery($sql_order);
  $result           =  $sqlQuery->fetch(PDO::FETCH_ASSOC);
  $total_survey   =  $result['num'];


  include("includes/header.php");

?>
  
<br><br>  
<div class="container-fluid">

<div id="content" class="container col-md-12">
          <div class="col-md-2"></div>
          <div class="col-sm-6 col-md-3">
            <div class="thumbnail"> 
              <div class="caption">
              <center>
              <img src="images/admin.jpg" width="65" height="100">
                <h3><?php echo $total_admin;?></h3>
                <p class="detail">Admin</p>     
                </center>
              </div>
            </div>
          </div>
     

          <a href="RegisteredUser.php">
          <div class="col-sm-6 col-md-3">
            <div class="thumbnail">    
              <div class="caption">
              <center>
              <img src="images/users.jpg" width="100" height="100">
                <h3><?php echo $total_user;?></h3>
                <p class="detail">Registered Users</p>
                </center>
              </div>
            </div>
          </div>
          </a> 


          <a href="ViewSurvey.php">
          <div class="col-sm-6 col-md-3">
              <div class="thumbnail">    
                <div class="caption">
                <center>
                <img src="images/download.jpg" width="100" height="100">
                  <h3><?php echo $total_survey;?></h3>
                  <p class="detail">Total Survey</p>  
                  </center>
                </div>
              </div>
          </div>
          </a>
      

       
       
      </div>
</div>
 

