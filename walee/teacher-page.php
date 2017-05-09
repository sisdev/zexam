<?php
session_start();
require('connection.php');
 /*
 if(!isset($_SESSION['userid']))
{
	header("location:index.php");
} 
*/

$chk=mysql_query("select role from users where userid='".$_SESSION['userid']."'");
$res=mysql_fetch_array($chk);


?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js" type="text/javascript"></script>
  <title>Assessment Web</title>
  </head>
  <body>
  
<div class="container-fluid">
   <nav class="navbar navbar-default">
  
<div class="container-fluid">
  	<div class="container">
    <div class="navbar-header">
	
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  
      <a class="navbar-brand" href="#"><img src="images/logo.png" width="180px"></img></a>
	  
    </div>
	
<!--<div class="col-sm-8"><h2 style="position:absolute;" class="text-info">Online Exam/Assessment System</h2></div>-->

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	
      <ul class="nav navbar-nav navbar-right">
    
        <li><a href="#"><?php 

 echo "USER ID : ".$_SESSION['userid'];
 ?></a></li>
       
 <li class="click"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <?php  echo $_SESSION['email'];?> <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
	
 
    <li><a href="index.php?session=1">Log out</a></li>
     
    </ul></li>
		 </ul>
      
     
    </div>
	
  </div>
  
</nav>
	</div><!--container-->
</div><!--container-fluid-->

 <section>
 <div class="container-fluid" style="background-color: #f8f8f8;">
 <div class="container">
 <div class="row">
 <div class="col-sm-3">
  <div class="panel panel-primary">
      <div class="panel-heading">Options</div>
	  	  <?php if($res['role']=="teacher") { ?>
      <div class="panel-body"><a href="teacher-page.php?qry=add_ques">Add Questions</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=list_ques">List Questions</a></div>
	   <div class="panel-body"><a href="teacher-page.php?qry=create_test_paper">Create testpaper</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=test_paper_list">List testpaper</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=assign_testpaper">Assign Testpaper</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=assigned_testpaper">List Assigned papers</a></div>
    
		  <?php } ?>
	  <?php if($res['role']=="admin") { ?>
      <div class="panel-body"><a href="teacher-page.php?qry=add_teacher">Add Teacher</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=add_student">Add Student</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=list_std_teacher">List Teacher</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=list_students">List Student</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=subject_manage">Manage Subjects</a></div>

      <div class="panel-body"><a href="teacher-page.php?qry=topic_manage">Manage Topics</a></div>
	    <div class="panel-body"><a href="teacher-page.php?qry=test_paper_list">List testpaper</a></div>
	    <div class="panel-body"><a href="teacher-page.php?qry=test_paper_list_xml">XML Test paper list</a></div>
		  <div class="panel-body"><a href="teacher-page.php?qry=qp_form">Upload Question paper</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=qp_form_upload_list">Uploaded Question papers</a></div>
	  
	  <?php } ?>
      <?php if($res['role']=="student") { ?>
	    <div class="panel-body"><a href="teacher-page.php?qry=my_testpaper">My Test Papers</a></div>
	    <div class="panel-body"><a href="teacher-page.php?qry=see_result">See Result</a></div>
	  
	  <?php } ?>
     
     
    </div>
 </div>
 <div class="col-sm-9"></div>
<?php 
$qry=@$_GET['qry'];
switch($qry)
{
case  "add_ques":
	include("question_add.php");
	break;
	case "list_ques":
	include("question_list.php");
	break;
	case "qlst_1":
	include("question_modify.php");
	break;
	case "qlst_2":
	include("question_list.php");
	break;
	case "subject_manage":
	include("subject_manage.php");
	break;
	case "subject_modify":
	include("subject_modify.php");
	break;
	case "subject_change":
	include("subject_manage.php");
	break;
	case "subject_del":
	include("subject_manage.php");
	break;
	case "topic_manage":
	include("topic_manage.php");
	break;
	case "topic_modify":
	include("topic_modify.php");
	break;
	case "topic_del":
	include("topic_manage.php");
	break;
	case "create_test_paper":
	include("test_paper.php");
	break;
	case "test_paper_list":
	include("test_paper_list.php");
	break;
	case "test_paper_modify":
	include("test_paper_modify.php");
	break;
	case "test_paper_del":
	include("test_paper_list.php");
	break;
	case "test_paper_view":
	include("test_paper_view.php");
	break;
	case "test_paper_view_xml":
	include("test_paper_view_xml.php");
	break;
	case "assign_testpaper":
	include("assign_testpaper.php");
	break;
	case "assigned_testpaper":
	include("assigned_testpaper.php");
	break;
	case "add_teacher":
	include("teacher_add.php");
	break;
	case "add_student":
	include("student_add.php");
	break;
	case "list_std_teacher":
	include("list_std_teacher.php");
	break;
	case "list_students":
	include("list_students.php");
	break;
	case "my_testpaper":
	include("student_testpapers.php");
	break;
	case "see_result":
	include("student_results.php");
	break;
	case "modify_std_tchr":
	include("modify_std_tchr.php");
	break;
	case "test_paper_list_xml":
	include("test_paper_list_xml.php");
	break;
	case "qp_form":
	include("qp_form.php");
	break;
	case "qp_form_upload_list":
	include("qp_form_upload_list.php");
	break;
	default:
	  	  if($res['role']=="teacher") { 
	include("question_add.php");
		  }
		  else  if($res['role']=="admin")
		  {
			  include("teacher_add.php");
		         }
				 else  if($res['role']=="student")
		  {
			  include("student_testpapers.php");
		         }
	
}
?>
 
 </div>
 	</div>
 </div>
 
 </section>