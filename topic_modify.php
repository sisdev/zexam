<?php
include("connection.php");
$getTopic_id=$_GET['data'];
if(isset($_POST['changeBttn']))
{
		//header("location:teacher-page.php?qry=topic_manage");
	$topDesc=$_POST['changeTopic'];
	mysqli_query($conn, "update topic set topic_description='$topDesc' where topic_id='$getTopic_id'");

	?>
<script>
window.location.href = "teacher-page.php?qry=topic_manage";
</script>
<?php
}
?>
<html>
<head>
<style>
.holder
{
	width:30%;
	height:20%;
	background-color:#cccccc;
	margin:5% 5%;
	padding:5%;
}
</style>
</head>
<body>
<center>
<div class="holder">
<form method="post">
<?php

$getT=mysqli_query($conn, "select topic_description from topic where topic_id='$getTopic_id'");
$top=mysqli_fetch_array($getT);
?>
Edit Topic<input type="text" name="changeTopic" value='<?php echo $top['topic_description']; ?>'><input type="submit" name="changeBttn" value="Change Topic">
</form>
</div>
</center>
</body>
</html>