<div class="container-fluid">
<div class="row">
<div class="col-sm-10">
<table class="table table-striped responsive" border="1" bordercolor="#ddd" style="text-algin:center;">
    <thead>
      <tr>
		<th>Session ID</th>
		<th>Test ID</th>
		<th>Student ID</th>
        <th>Test</th>
        <th>Test date/time</th>
        <th>No of Questions</th>
		
        <th>Correct answers</th>
		<th>Wrong answers</th>
        <th>Un Attempted</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php
	
	$result=mysqli_query($conn,"select session_id,test_id,student_id,test_start_dtm from test_taken  where student_id='". $_SESSION['userid']."'");
	
while($res=mysqli_fetch_array($result))
{
	$correct=mysqli_query($conn, "select * from test_result where sessionid='".$res['session_id']."' and correct_ans='correct'");
	$wrong=mysqli_query($conn, "select * from test_result where sessionid='".$res['session_id']."' and correct_ans='wrong'");
	
		$total=mysqli_query($conn,"select * from test_result where sessionid='".$res['session_id']."'");
		
	$unattempt=mysqli_query($conn,"select * from test_result where sessionid='".$res['session_id']."' and ans='0'");
?>
      <tr>
	  <td><?php echo $res['session_id']; ?></td>
	  <td><?php echo $res['test_id']; ?></td>
	  <td><?php echo $res['student_id']; ?></td>
        <td><?php 
		$papername=mysqli_query($conn,"select paper_desc from test_paper where paper_id='".$res['test_id']."'");
		$paper=mysqli_fetch_array($papername);
		echo $paper['paper_desc']; ?></td>
        <td><?php echo $res['test_start_dtm']; ?></td>
        <td><?php echo mysqli_num_rows($total); ?></td>
		
        <td><?php  echo mysqli_num_rows($correct); ?></td>
		<td><?php  echo mysqli_num_rows($wrong); ?></td>
        <td><?php  echo mysqli_num_rows($unattempt); ?></td>
		<!--<td><input type="button" id="review_btn" name="review_btn" value="Review" style="border:none;background:#337ab7;color:#FFFFFF;padding: 7px 15px;border-radius: 5px;margin-top:10px;margin-bottom:5%;"/></td>-->
		<td><a href="teacher-page.php?test_attempt_id=<?php echo $res['session_id']; ?>&qry=test_paper_review">Review</a></td>
	  </tr>
	<?php 
		}
		?>
    </tbody>
  </table>
  </div>
  </div>
  </div>