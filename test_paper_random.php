
<style>
	.clear{clear:both}}
</style>
<?php
error_reporting(1);
include("connection.php");
$get_sub=$_REQUEST['send_sub'];
$get_ques=$_REQUEST['send_ques'];


$loop_ques=0;
$count=1;
$question_array=array();
	  $ques_count=$get_ques;
	  $sel_q= mysqli_query($conn, "select question_id from question_master where subject_id='$get_sub'");
	 
	 $forRand= mysqli_query($conn, "select question_id from question_master where subject_id='$get_sub'");

$randArr=array();		
$chkArr=array();
		while($row1=mysqli_fetch_array($forRand)) 
		{
 $randArr[]= $row1['question_id']; 
		}
		
	 
	   echo "<table border=1 width=100%><tr><th>Sr No</th><th>Question Description</th></tr>";
	 while($row=mysqli_fetch_array($sel_q))
	 {
	$rand= $randArr[array_rand($randArr)]; 
	
		while(in_array($rand,$chkArr))      
		{
			$rand=$randArr[array_rand($randArr)];
			
		}
		$chkArr[]=$rand;
		 $repeat= mysqli_query($conn, "select question_id,question_desc from question_master where question_id='$rand' and subject_id='$get_sub'");
		 
		 
		 
		$fetch=mysqli_fetch_array($repeat);
		$question_array[]=$fetch['question_id'];
		echo "<tr><td>".$count. "</td><td> ".$fetch['question_desc']."</td></tr>";
		$loop_ques++;
		 $count++;
		
		
		  if($loop_ques==$ques_count)
		 {
			 break;
		}
		
	 }	

echo "</table>";
	 
?>


<form method="post">
<input type="hidden" name="id_array" value="<?php echo implode(",",$question_array); ?>">  <!--   converting $question_array into string -->
<input type="submit" value="Random Select Submit" name="random_ques" style="float:right;border:none;background:#337ab7;color:#FFFFFF;padding: 7px 15px;border-radius: 5px;margin-top:10px;margin-bottom:5%;">


</form>