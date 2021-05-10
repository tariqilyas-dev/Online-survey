<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ONLINE || SURVEY</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="assets/style.css">

<link rel="icon" type="image/x-icon" href="images/logo/logo.jpg">

   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style type="text/css">

.navbar-inverse{
    background-color: #1d374e;
}  

</style>

</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <b><a class="navbar-brand" style="color: white;">Rampup</a></b>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php"> Dashboard</a><i class="fa fa-circle-o"></i> </li>
            <li><a href="AddSurvey.php"><i class="fa fa-circle-o"></i>Add Survey</a></li>
            <li><a href="ViewSurvey.php"><i class="fa fa-circle-o"></i>View survey</a></li>
            <!-- <li><a href="AddQuestion.php"><i class="fa fa-circle-o"></i>Add question</a></li> -->
      
            <li class="dropdown">
             <a class="dropdown-toggle" data-toggle="dropdown" href="#">Add question
             <span class="caret"></span></a>
             <ul class="dropdown-menu">
              <li><a href="AddSubjectiveQuestion.php">Subjectiv Question </a></li>
              <li><a href="AddObjectiveQuestion.php">Objective Question</a></li>
             </ul>
            </li>

            <li><a href="ViewQuestion.php"><i class="fa fa-circle-o"></i>view question</a></li>
            <li><a href="AttemptedSurveys.php"><i class="fa fa-circle-o"></i>All attempt survey with answer</a></li>
    </ul>
    <B> <a href="logout.php" class="btn btn-info navbar-btn" style="float: right;">Logout</a></B>
  </div>
</nav>
<br/><br/>