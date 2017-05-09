<?php
include('connection.php');

?>
<html>
<body>

<h2><center>Assigned Testpapers</center></h2>


<div class="container">
<div class="row">
<div class="col-sm-5">
 <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span id="testpaper">Select by Testpaper</span>
  <span class="caret"></span></button>
  
  <ul id="testpaper" class="dropdown-menu">
  <li id="all"><a  href="javascript:;">ALL Test Papers</a></li>
  <?php 
  $selecttest=mysqli_query($conn, "select distinct test_id from test_assign where assign_by='".$_SESSION['userid']."'");
  while($selpaper=mysqli_fetch_array($selecttest))
  {
  ?>
    <li id=<?php echo $selpaper['test_id']; ?>><a  href="javascript:;"><?php 
$papername=mysqli_query($conn, "select paper_desc from test_paper where paper_id='".$selpaper['test_id']."'");
$pn=mysqli_fetch_array($papername);
echo $pn['paper_desc'];
	?></a></li>
  <?php } ?>
  
  </ul>
</div>
</div>
<script>
$(document).ready(function(){
	
$("#testpaper li").click(function (){
var paperid=$(this).attr('id');
  $("#testpaper").text($(this).text());
  
  $.post("assigned_testpaper_ajax.php",
  {
	 Paperid:paperid 
	  
  },function(data,status){
	 $("#main").html(data); 
	  
  });
  
  
});


	
});
</script>
<div id="main">
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
	$test_papers=mysqli_query($conn, "select student_id, test_sessionid,test_id,test_assign_dtm, test_start_date, test_exp_date from test_assign where assign_by='".$_SESSION['userid']."' order by test_assign_dtm desc");
	while($assign=mysqli_fetch_array($test_papers))
{
	?>
      <tr>
        <td><?php $student=mysqli_query($conn, "select username from users where userid='".$assign['student_id']."'");  $std=mysql_fetch_array($student); echo $std['username']; ?></td>
        <td><?php $testpaper=mysqli_query($conn, "select paper_desc from test_paper where paper_id='".$assign['test_id']."'");  $test=mysql_fetch_array($testpaper); echo $test['paper_desc']; ?></td>
        <td><?php echo $assign['test_assign_dtm']; ?></td> 
        <td><?php echo $assign['test_start_date']; ?></td>
        <td><?php echo $assign['test_exp_date']; ?></td>
        <td>
		<?php 
		$selecttestpaper=mysqli_query($conn, "select test_id, student_id from test_taken where test_id='".$assign['test_id']."' and student_id='".$assign['student_id']."' and session_id='".$assign['test_sessionid']."'");
		$chktest=mysql_num_rows($selecttestpaper);
		if($chktest==0){ echo $attempt="Un Attempt"; }
		else {  echo $attempt="Attempted";  }
		?>
		</td>
		<td><?php if($attempt=="Attempted") { 
$result=mysqli_query($conn, "select session_id,test_id,test_start_dtm from test_taken  where student_id='".$assign['student_id']."' and session_id='".$assign['test_sessionid']."'");
$res=mysql_fetch_array($result);

	$correct=mysqli_query($conn, "select * from test_result where sessionid='".$res['session_id']."' and correct_ans='correct'");

	
		$total=mysqli_query($conn, "select * from test_result where sessionid='".$res['session_id']."'");
	echo mysqli_num_rows($correct)." / ". mysqli_num_rows($total);
	

		} else { ?> --  <?php } ?></td>
		<td><?php if($attempt=="Attempted") {   echo (mysqli_num_rows($correct)/mysqli_num_rows($total))*100; ?>% <?php } else { ?> --<?php } ?></td>
      </tr>
	  <?php } ?>
	  </table>
	  </div>
	  </div>
	  </div>
	  </div>
</body>
</html>