
<div class="container-fluid">
<div class="row">
<div class="col-sm-10">
<table class="table table-striped responsive" border="1" bordercolor="#ddd">
    <thead>
      <tr>
        <th>Test</th>
        <th>Test date/time</th>
        <th>No of Questions</th>
        <th>Correct answers</th>
        <th>Un Attempted</th>
		 <th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php
$result=mysqli_query($conn,"select session_id,test_id,test_start_dtm from test_taken  where student_id='". $_SESSION['userid']."' order by test_start_dtm desc");
while($res=mysqli_fetch_array($result))
{
	$correct=mysqli_query($conn, "select * from test_result where sessionid='".$res['session_id']."' and correct_ans='correct'");
	
		$total=mysqli_query($conn,"select * from test_result where sessionid='".$res['session_id']."'");
	$unattempt=mysqli_query($conn,"select * from test_result where sessionid='".$res['session_id']."' and ans='0'");
?>
      <tr style="text-align:center;">
        <td><?php 
		$papername=mysqli_query($conn,"select paper_desc from test_paper where paper_id='".$res['test_id']."'");
		$paper=mysqli_fetch_array($papername);
		echo $paper['paper_desc']; ?></td>
        <td><?php echo $res['test_start_dtm']; ?></td>
        <td><?php echo mysqli_num_rows($total); ?></td>
        <td><?php  echo mysqli_num_rows($correct); ?></td>
        <td><?php  echo mysqli_num_rows($unattempt); ?></td>
		<td><input type="button" value="Review" style="background:#337ab7; padding:7px 15px; color:#FFFFFF; border-radius:10px; border:none;" ></td>
      </tr>
	<?php  
	}	 ?>
    </tbody>
  </table>
  </div>
  </div>
  </div>