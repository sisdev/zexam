<?php
include("connection.php");
error_reporting(1);
$get_subID=$_REQUEST["q"]; 
		
		$sub=mysqli_query($conn, "select Q.question_id,Q.question_desc from question_master Q,subject S where Q.subject_id=S.subject_id and
		S.subject_id='$get_subID'
		");
		$count_sno=1;
		echo "<table border=1>";
		echo "<tr><th>Sno</th><th>Question Description</th><th>Modify</th><th>Delete</th><tr>";
	while($get_record=mysqli_fetch_array($sub))
	{
	echo "<tr><td>".$count_sno."</td><td>";
echo $get_record["question_desc"];
echo "</td><td><a href='index.php?res=$get_record[question_id]&qry=qlst_1'>Modify</a>";
echo "</td><td><a href='index.php?res=$get_record[question_id]&qry=qlst_2'>Delete</a></td></tr>";
$count_sno+=1;
	}
	echo "</table>";
	
		?>