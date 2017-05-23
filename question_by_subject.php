<?php
session_start();
 if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
else
{
	$user_name=$_SESSION['email'] ;
}
include("connection.php");
error_reporting(1);
$get_subID=$_REQUEST["q"]; 
		
		$sub=mysqli_query($conn, "select Q.question_id,Q.question_desc from question_master Q,subject S where Q.subject_id=S.subject_id and
		S.subject_id='$get_subID' and created_by = '$user_name' ");
		$ques_count = mysqli_num_rows($sub) ;
		$count_sno=1;
		echo " Total Questions Submitted by $user_name : "."<b>". $ques_count."</b>" ;
		echo "<table border=1>";
		echo "<tr><th>Sno</th><th>Question Description</th><th>Modify</th><th>Delete</th><tr>";
	while($get_record=mysqli_fetch_array($sub))
	{
	echo "<tr><td>".$count_sno."</td><td>";
echo $get_record["question_desc"];
echo "</td><td><a href='teacher-page.php?res=$get_record[question_id]&qry=qlst_1'>Modify</a>";
echo "</td><td><a href='teacher-page.php?res=$get_record[question_id]&qry=qlst_2'>Delete</a></td></tr>";
$count_sno+=1;
	}
	echo "</table>";
	
		?>