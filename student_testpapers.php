<?php 
require('connection.php');

?> 


<body>
<?php 
$todaydate=date("Y-m-d");

?>
<div class="container-fluid">
<div class="row">
 
<div class="col-sm-10">
    <center>  <h1>My Test papers</h1> </center>
 <table class="table table-hover table-responsive">
    <thead>
      <tr>
<th>Sno</th><th>Paper</th><th>Subject</th><th>Test paper assigned</th><th>No. of questions</th><th>Duration</th><th>Total marks</th>
</tr>
    </thead>
    <tbody>
	<?php 
	$student_tp_qry = "select T.paper_id,st.test_sessionid,T.paper_desc,T.subject_id,T.no_of_questions,st.test_assign_dtm,T.duration,T.total_marks,S.subject_description from test_paper T,subject S,test_assign st
where S.subject_id=T.Subject_id and st.test_id=T.paper_id and st.student_id='".$_SESSION['userid']."' and st.test_start_date<='".$todaydate."' and st.test_exp_date >='".$todaydate."' order by test_assign_dtm desc" ;

	$test_paper=mysqli_query($conn,$student_tp_qry );
    $count=1;

	while($data=mysqli_fetch_array($test_paper))
{
	$complete_testpaper=mysqli_query($conn, "select test_id,student_id,session_id from test_taken where test_id='".$data['paper_id']."' and student_id='".$_SESSION['userid']."' and session_id='".$data["test_sessionid"]."'");
	
	?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $data["paper_desc"]; ?></td>
        <td><?php echo $data["subject_description"]; ?></td>
        <td><?php echo $data["test_assign_dtm"]; ?></td>
        <td><?php echo $data["no_of_questions"]; ?></td>
        <td><?php echo $data["duration"]; ?></td>
        <td><?php echo $data["total_marks"]; ?></td>
      <!--  <td><a href="test_paper_view.php?paperID=<?php echo $data['paper_id'] ?>&nextQ=-1" class="btn btn-info" role="button">Select</a></td> -->
	  <?php
	  $complete=mysqli_num_rows($complete_testpaper);
	if($complete>=1) {
	
	  ?>
	   <td><a href="test_paper_show.php?paperID=<?php echo $data['paper_id'] ?>&sessionid=<?php echo $data["test_sessionid"]; ?>" class="btn btn-info disabled" role="button">Attempted</a></td> 
	<?php }  else { ?>     
	 <td><a href="test_paper_show.php?paperID=<?php echo $data['paper_id'] ?>&sessionid=<?php echo $data["test_sessionid"]; ?>" class="btn btn-info" role="button">Un Attempt</a></td> 
	<?php } ?>
	 </tr>
<?php $count++; } 
?> 
    </tbody>
  </table>



</div>
<div class="col-sm-4">




</div>

</div>

</div>




   
 


  
</body>

</html>