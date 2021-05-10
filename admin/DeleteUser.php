<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ONLINE || SURVEY</title>
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
  

<?php
  
  include('session.php'); 
  include('includes/connect_db.php'); 
  include('includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();



?>

<div class="content-wrapper">
<div class="container-fluid">

<div id="content" class="container col-md-12">

<?php

    $get   =   $helper->clearSlashes($_GET);
    $user_id    =   $get['user_id'];

    if (isset($_POST["btnDelete"])){
    $del   = $mysqlObj->deleteQuery('user','user_id',$user_id);
    if($del){echo "<script>window.location.href='RegisteredUser.php'</script>";}
    }
    if (isset($_POST["btnNo"])){echo "<script>window.location.href='RegisteredUser.php'</script>";}
?>

<h1>Confirm Action</h1>
<hr />
<form method="post">
	<p>Are you sure want to delete this User?</p>
	<input type="submit" class="btn btn-primary" value="Delete" name="btnDelete"/>
	<input type="submit" class="btn btn-danger" value="Cancel" name="btnNo"/>
</form>
<div class="separator"> </div>
</div>

</div>
</div>