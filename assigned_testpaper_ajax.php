<?php
session_start();
include("connection.php");

?>
<div class="col-sm-10">
 <table class="table table-striped">
    <thead>
      <tr>
        <th>Student</th>
        <th>Test Paper</th>
       <th>Test Paper assign</th> 
        <th>Test paper show</th>
        <th>Test paper Expire</th>
        <th>Test Status</th>
        <th>correct / Total</th>
        <th>percentage</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	if($_REQUEST['Paperid']=="all")
	{
		$test_papers=mysql_query("select student_id, test_sessionid,test_id,test_assign_dtm, test_start_date, test_exp_date from test_assign where assign_by='".$_SESSION['userid']."' order by test_assign_dtm desc");

	}
else{
	$test_papers=mysql_query("select student_id, test_id,test_assign_dtm, test_sessionid,test_start_date, test_exp_date from test_assign where assign_by='".$_SESSION['userid']."' and test_id='".$_REQUEST['Paperid']."'");
}
	while($assign=mysql_fetch_array($test_papers))
{
	?>
      <tr>
        <td><?php $student=mysql_query("select username from users where userid='".$assign['student_id']."'");  $std=mysql_fetch_array($student); echo $std['username']; ?></td>
        <td><?php $testpaper=mysql_query("select paper_desc from test_paper where paper_id='".$assign['test_id']."'");  $test=mysql_fetch_array($testpaper); echo $test['paper_desc']; ?></td>
        <td><?php echo $assign['test_assign_dtm']; ?></td> 
        <td><?php echo $assign['test_start_date']; ?></td>
        <td><?php echo $assign['test_exp_date']; ?></td>
        <td>
		<?php 
		$selecttestpaper=mysql_query("select test_id, student_id from test_taken where test_id='".$assign['test_id']."' and student_id='".$assign['student_id']."' and session_id='".$assign['test_sessionid']."'");
		$chktest=mysql_num_rows($selecttestpaper);
		if($chktest==0){ echo $attempt="Un Attempt"; }
		else {  echo $attempt="Attempted";  }
		?>
		</td>
		<td><?php if($attempt=="Attempted") { 
$result=mysql_query("select session_id,test_id,test_start_dtm from test_taken  where student_id='".$assign['student_id']."' and session_id='".$assign['test_sessionid']."'");
$res=mysql_fetch_array($result);

	$correct=mysql_query("select * from test_result where sessionid='".$res['session_id']."' and correct_ans='correct'");

	
		$total=mysql_query("select * from test_result where sessionid='".$res['session_id']."'");
	echo mysql_num_rows($correct)." / ". mysql_num_rows($total);
	

		} else { ?> --  <?php } ?></td>
		<td><?php if($attempt=="Attempted") {   echo (mysql_num_rows($correct)/mysql_num_rows($total))*100; ?>% <?php } else { ?> --<?php } ?></td>
      </tr>
	  <?php } ?>
	  </table>
	  </div>
	  </div>