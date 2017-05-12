<html>
<head>
<style>
#topics
{
	width:40%;
	height:60%;
	
	margin-left:5%;
	margin-top:2%;
	
	
}
</style>
<script>
function delbox()
{
	
	var value=confirm("Do you really want to delete");
	if(value==true)
		return true;
	else
		return false;
}
</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js" type="text/javascript"></script>
<script>
$(document).ready(function(){

	$("#topic_by_subject").change(function(){
		
		var getval=this.value;
		
		$.post("topic_by_subject.php",{ passval:getval},function(data,status){
    document.getElementById("topics").innerHTML=data;
	
        });
		
		
	});
	
});
</script>
</head>
<body>

<center>
<h2><u>LIST OF TOPICS</u></h2><p><p>
Subject: <select id="topic_by_subject">
<option value="11">All Subject</option>
<?php

$sel=mysqli_query($conn, "select subject_id,subject_description from subject");

while($rec=mysqli_fetch_array($sel))
{
	echo "<option value=".$rec['subject_id'].">".$rec['subject_description']."</option>";
	
}
  ?>

</select>

<div id="topics">
<?php

error_reporting(1);
$topic=mysqli_query($conn, "select T.topic_description,S.subject_description,topic_id from topic T,subject S where T.subject_id=S.subject_id");
echo "<table>";
$count=1;
while($getTopic=mysqli_fetch_array($topic))
{
echo "<tr><td>$count</td><td width=20px></td><td>$getTopic[topic_description]</td><td width=20px></td><td>$getTopic[subject_description]</td></td><td width=50px></td>
<td><a href='teacher-page.php?data=$getTopic[topic_id]&qry=topic_modify'>Modify</a></td><td width=50px></td><td><a href='teacher-page.php?delData=$getTopic[topic_id]&qry=topic_del' onclick='return delbox()'>Delete</a></td></td>
</tr>";
$count++;
}
echo "</table>";
$delTop=$_GET['delData'];
if(isset($delTop))
{
	
	mysqli_query($conn, "delete from topic where topic_id='$delTop'");
}
?>
</div>

<div style="margin-top:auto;">

<form method="post">
Add a new Topic<input type="text" name="addTopic" required=required>
<select name="addSubject"><?php 
$sub=mysqli_query($conn, "select subject_description,subject_id from subject");
while($getSub=mysqli_fetch_array($sub)){
echo "<option value=$getSub[subject_id]>$getSub[subject_description]</option>";
}
?>
</select>
<input type="submit" name="topicBttn" value="Add Topic" >
<?php
if(isset($_POST['topicBttn']))
{
 $getTop=$_POST['addTopic'];
 $getSub_id=$_POST['addSubject'];
mysqli_query($conn, "insert into topic (topic_description,subject_id) values('$getTop','$getSub_id')");	
}
?>
</form>
</div>
</center>
