<html>
<head></head>
<form method="post">
<body>

<?php
include("connection.php");
// boolean $debug=true ;

$test_paper_id = $_GET["mod"] ;
$student_id = $_SESSION['userid'];
$assign_dtm= date("y-m-d H:i:s");
$startdate = date("y-m-d");
$enddate =  date("Y-m-d", strtotime("+7 day"));

$insert_qry = "insert into test_assign (student_id,test_id,test_assign_dtm,test_start_date,test_exp_date,assign_by) values
('".$student_id."', '".$test_paper_id."', '".$assign_dtm."', '".$startdate."', '".$enddate."', '".$student_id."') ";

echo $insert_qry ;

mysqli_query($conn, $insert_qry  );

//header("location:teacher-page.php?qry=pub_testpaper") ;
?>
	<script>
	alert('Test paper successfully assign');
	</script>



  </body>
  </form>
  </html>