<?php
require('connection.php');

?>
 <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<script src="js/jquery.timepicker.js" type="text/javascript"></script> 
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui.js" type="text/javascript"></script> 
  <body>
 
<div class="container">
<h1 style="padding:0px 0 10px 0; text-align:center; margin:0px;">Assign Test papers</h1>
<div class="row">
<div class="col-sm-5">


<form method="post">

 <table class="table table-hover table-responsive" style="border:#d1cfcf solid 1px;">
    <thead>
<tr>
	<th>Sno</th>
	<th>Paper</th>
	<th>Subject</th>
	<th>No. of questions</th>
	<th>Duration</th>
	<th>Total marks</th>
</tr>
    </thead>
    <tbody>
	<?php 
	
	$test_paper=mysqli_query($conn, "select T.paper_id,T.paper_desc,T.subject_id,T.no_of_questions,T.duration,T.total_marks,S.subject_description from test_paper T,subject S
where S.subject_id=T.Subject_id");
$count=1;
while($data=mysqli_fetch_array($test_paper))
{
	?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $data["paper_desc"]; ?></td>
        <td><?php echo $data["subject_description"]; ?></td>
        <td><?php echo $data["no_of_questions"]; ?></td>
        <td><?php echo $data["duration"]; ?></td>
        <td><?php echo $data["total_marks"]; ?></td>
      <!--  <td><a href="test_paper_view.php?paperID=<?php echo $data['paper_id'] ?>&nextQ=-1" class="btn btn-info" role="button">Select</a></td> -->
	   <td><input type="checkbox" name="testlist[]"  value=<?php echo $data['paper_id'] ?>></td> 
      </tr>
<?php $count++; } 
?> 
    </tbody>
  </table>
   
    
 
 
</div><!--end-col-sm-5-->

<div class="col-sm-1"></div>
<div class="col-sm-4">

 
 <table class="table table-responsive" style="border:#d1cfcf solid 1px;">
    <thead>
      <tr>
        <th>Students</th>
        <th>Assign</th>
        
      </tr>
    </thead>
    <tbody>
      
	  <?php 
  $std=mysqli_query($user_conn, "select * from users where exam_role='student'");
while($student=mysqli_fetch_array($std))
{
	
	?>

 <tr>
        <td><?php  echo $student['username'];  ?></td>
        <td><input type="checkbox" name="std[]" value=<?php echo $student['id']; ?>></td>
<?php } ?>
      </tr>
      
    </tbody>
  </table>
  <input class="form-control" required=required name="startdate" placeholder="Start Date"  id="datepick" type="text"></br>
  <input class="form-control" required=required name="enddate" placeholder="End Date"  id="datepick2" type="text"><p></br>
  <input type="submit" name="assignNow" class="btn btn-info btn-lg" value="Assign now">
</div><!--end-col-sm-4-->
</form>

</div><!--end-row-->

</div><!--end-container-->
  <?php
  date_default_timezone_set('Asia/Kolkata');
  $assign_dtm= date("y-m-d H:i:sa");
if(isset($_POST['assignNow']))
{
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];
	$assigned_by=$_SESSION['userid'];
	$testpaper=$_POST['testlist'];
$stdnt=$_POST['std'];
	foreach($testpaper as $test)
	{
	
	foreach($stdnt as $students)
	{
		//echo "Test ".$test." assign to student ".$students;
		mysqli_query($conn, "insert into test_assign (student_id,test_id,test_assign_dtm,test_start_date,test_exp_date,assign_by) values
('".$students."',
'".$test."',
'".$assign_dtm."',
'".$startdate."',
'".$enddate."',
'".$assigned_by."') ");
		
	}
	
	}
	
	?>
	<script>
	alert('Test paper successfully assign');
	</script>
	
	<?php
	
}
?>
  
  </body>
  </html>
  <script>
  $(document).ready(function(){
	  $(window).load(function(){
			   $("#datepick,#datepick2").datepicker({dateFormat: 'yy-mm-dd', minDate: 0,placement: 'top' }).val();  
		  
	  });

	  $("#datepick,#datepick2").click(function(){
		
		$(this).datepicker({dateFormat: 'yy-mm-dd', minDate: 0 ,placement: 'top'}).val();
	});
  });
  </script>