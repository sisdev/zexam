<?php
session_start();
require('connection.php');
if(!isset($_SESSION['login']))
{
	header("location:index.php");
}
?>

<?php include('header-2.php'); ?>


<?php include('login_reg.php'); ?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Sisoft Instructor">
  
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js" type="text/javascript"></script>

  <title>Online Testing/Assessment - Home Page</title>
  </head>
  <body>

  <div class="container">
	<div class="row">
	<button type="button" class="btn-danger" style="float:right; border:none; margin-top:10px; padding:10px; font-weight:bold;">
	<?php
	$sql_query1 = "select exam_role from users where id='".$_SESSION['userid']."'";
	#$sql_query1 = "select exam_role from users where id='116'";
	
	$chk=mysqli_query($user_conn,$sql_query1);
	if (!$chk) {
		echo $sql_query1 ;	
		printf("Error: %s\n", mysqli_error($user_conn));
		exit();
	}
	$res=mysqli_fetch_array($chk);
	
	$exam_role = $res['exam_role'] ;
	echo "Role:".$exam_role ;
	
	?>
	</button>
	</div>
</div>

  
  
<div class="container">	
  <div><h2 style="color:#0066CC; margin-top:25px; margin-bottom:25px; text-align:center;">Online Exam/Assessment System</h2></div>
</div>


<div class="container">
 <section>
 <div class="container-fluid">
 <div class="row">
 <div class="col-sm-2">
  <div class="panel panel-primary">
      <div class="panel-heading">Options</div>
	  	  <?php if($exam_role=="teacher") { ?>
      <div class="panel-body"><a href="teacher-page.php?qry=add_ques">Add Questions</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=list_ques">List Questions</a></div>
	   <div class="panel-body"><a href="teacher-page.php?qry=create_test_paper">Create testpaper</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=test_paper_list">List testpaper</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=assign_testpaper">Assign Testpaper</a></div>
      <div class="panel-body"><a href="teacher-page.php?qry=assigned_testpaper">List Assigned papers</a></div>
    
		  <?php } ?>
	  <?php if($exam_role=="admin") { ?>
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
      <?php if($exam_role=="student") { ?>
	  
	  	<div class="panel-body"><a href="teacher-page.php?qry=pub_testpaper">Available Test Papers</a></div>
	    <div class="panel-body"><a href="teacher-page.php?qry=my_testpaper">Assigned Test Papers</a></div>
	    <div class="panel-body"><a href="teacher-page.php?qry=see_result">See Result</a></div>
	  
	  <?php } ?>
     
     
    </div>
 </div>
 <div class="col-sm-10"></div>
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
	
	case "test_paper_review":
	include("test_paper_review.php");
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
	case "pub_testpaper":
	include("test_paper_list_pub.php");
	break;

	case "test_paper_assign_self":
	include("test_paper_assign_self.php");
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
	  	  if($exam_role=="teacher") { 
			include("question_add.php");
		  }
		  else  if($exam_role=="admin")
		  {
			 include("teacher_add.php");
		         }
				 else  if($exam_role=="student")
		  {
			  include("student_testpapers.php");
		         }
	
}
?>
 
 </div>
 
 
 </div>
</section>
</div>