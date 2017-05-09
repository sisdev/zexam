<html>
<head>
<script src="jquery-2.2.0.min.js"></script>
<script>

</script>
<style>
.ques
{
	
	display:block;
	background-color:white;
}
</style>
</head>
<body>


<table width="690">
      
        <tr><td><b>Sno</b></td><td><b>Question Description</b></td><td><b>Topic</b></td><td></td></tr>
<?php
include("connection.php");
$get_subID=$_REQUEST["q"]; 


		$count=1;
		$id_value=1;
		$select_ques=mysql_query("select question_id,question_desc,topic_description from question_master A, topic B where A.subject_id='$get_subID' and A.topic_id=B.topic_id");
	while($get_record=mysql_fetch_array($select_ques))
	{
	echo "<tr><td>$count</td><td>".$get_record['question_desc']."</td><td>".$get_record['topic_description']."</td><td><input type='checkbox' name='checkme[]' id=$id_value value=$get_record[question_id] onClick='selected(this.value)' class='common'></input></td></tr>";
	$count++;
	$id_value++;
	}
	echo "Total no. of Questions: ".($count-1);
	
		?>
		 <tr><td></td><td></td></tr>
    </table>
	

		</body>
		</html>
		