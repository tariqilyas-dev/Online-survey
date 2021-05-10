<?php

  include('admin/includes/connect_db.php'); 
  include('admin/includes/comman_classes.php');

  $mysqlObj = new mysql_class();
  $helper   = new Helper_class();

  
 $post    = $helper->clearSlashes($_POST);

 $existing_user  = $mysqlObj->existing_data('login', 'user', 'login', $post['login']);

 $existing_mobile  = $mysqlObj->existing_data('mobile', 'user', 'mobile', $post['mobile']); 

 

 if (isset($post["submit"]))
  {

     if(preg_match('/[^0-9]/', $post['mobile'])){
      echo "<script type='text/javascript'>alert('Invalid characters in mobile number')</script>";
      echo "<script>window.location.href = 'register.php'</script>";
      return false;
    } 

   if(strlen($post['mobile']) != 10){
      echo "<script type='text/javascript'>alert('Invalid length of Mobile')</script>";
      echo "<script>window.location.href = 'register.php'</script>";
      return false;
    }  

    if ($existing_mobile['mobile']==$post['mobile']) {
    echo "<script type='text/javascript'>alert('This mobile number already exist')</script>";
    echo "<script>window.location.href = 'register.php'</script>";
    return false;
    }  


  if ($existing_user['login']==$post['login']) {
  echo "<script type='text/javascript'>alert('username already exist')</script>";
  echo "<script>window.location.href = 'register.php'</script>";
  return false;
  } 



    
  $pass = md5($post['password']);

  $value   = array(
      'firstname'             => $post['fname'],
      'lastname'              => $post['lname'],
      'mobile'                => $post['mobile'],
      'login'                 => $post['login'],
      'password'              => $pass,
      'survey_attempt'        => 0
    ); 

      
    $insert = $mysqlObj->insertData("user",$value);

    if($insert==TRUE )
    {
    echo "<script>window.location.href='login.php'</script>";
    } 
  }

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User || SURVEY</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="admin/assets/style.css">
</head>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>Rampup</b>
  </div>
  <div class="register-box-body">
    <p class="register-box-msg">Register yourself for login</p>
  <form method="post" enctype="multipart/form-data">

    <div class="card">
        <div class="card-header bg-dark">
          <h1 class="text-white text-center">
             User Registraion 
          </h1>
        </div>
        <br/>

      <label>First name</label>

       <input type="text" name="fname" placeholder="First Name" id="fname" class="form-control" rows="12" required="">
      
      <br/>
      <label>Last name</label>
      <input type="text" class="form-control" placeholder="Last Name" id="lname" name="lname" required=""/>


      <br/>
      <label>Mobile</label>
      <input type="text" placeholder="Mobile" class="form-control" id="mobile" name="mobile" required=""/>

      <br/>
      <label>Username</label>
      <input type="text" placeholder="Username" class="form-control" id="login" name="login" required=""/>


      <br/>
      <label>password</label>
      <input type="password" class="form-control" id="password" name="password" required=""/>


      <br/><br/>
      <center>
      <input type="submit" class="btn-primary btn" name="submit" id="submit"/>
    </center>
    </form>
    <br><br>
        <center>
    <a href="login.php">If you already register! please login</a>
    </center>
    <br><br>

    <br>
  </div>
</div>
</body>
</html>







