<?php

  session_start();
  error_reporting(0);

  include('includes/connect_db.php'); 
  include('includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();

  $post    = $helper->clearSlashes($_POST);

  if(isset($post['submit'])){

  $username  = $post['username'];
  $password  = md5($post['password']);


  $username_existing    = $mysqlObj->existing_data('login', 'admin', 'login', $username);
  $password_existing    = $mysqlObj->existing_data('password', 'admin', 'password', $password);


  if($username && $password) { 

  $_SESSION['username']=$username;

  if ($username_existing['login']!=$username) {
  echo "<script type='text/javascript'>alert('username name not matched')</script>";
  echo "<script>window.location.href = 'login.php'</script>";
  return false;
  }

  if ($password_existing['password']!=$password) {
  echo "<script type='text/javascript'>alert('password not matched')</script>";
  echo "<script>window.location.href = 'login.php'</script>";
  return false;
  }

  if($username_existing && $password_existing){
  echo "<script>window.location.href='index.php'</script>";
  }

  else {
    echo "<script type='text/javascript'>alert('fail to login!')</script>";
    echo "<script>window.location.href='login.php'</script>";
  }
  }

}

?>


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

<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>


<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Rampup</b>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form  method="post">
      <div class="card">
        <div class="card-header bg-dark">
          <h1 class="text-white text-center">
             Admin Login 
          </h1>
        </div>
        <label>Username</label>
        <input type="text" name="username" id="username" class="form-control">
        <br>
       
        <label>Password</label>
        <input type="password" name="password" class="form-control" id="pwd"><br>
        <br>
        <center><input class="btn btn-primary" type="submit" value="submit" name="submit"></center>
      </div>
    </form>

    <br>
  </div>
</div>
</body>
</html>




