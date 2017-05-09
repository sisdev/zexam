

<html>
<head>
<style>
.subject{
	margin-left: 35%;
	width:30%;
	height:auto;

	
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
</head>
<body>
<center><h2><U>LIST OF SUBJECTS</U></h2></center>
<div class="subject">

<?php

error_reporting(1);
$sub=mysql_query("select subject_description,subject_id from subject");
echo "<table>";
$count=1;
while($getSub=mysql_fetch_array($sub))
{
	echo "<tr><td height=50>$count : </td><td>".$getSub['subject_description']."</td><td width=50px></td>
	<td>	<a href='teacher-page.php?data=$getSub[subject_id]&qry=subject_modify'>Modify</a></td><td width=50px></td>
	<td><a href='teacher-page.php?data=$getSub[subject_id]&qry=subject_del'onclick='return delbox()'>Delete</td></td> 
</tr>";
	$count++;
}
$count=1;
echo "</table>";
if(isset($_POST['addBttn']))
{
	$getSubject=$_POST['addSub'];
	mysql_query("insert into subject (subject_description) values('$getSubject')");
	
}

$delSub=$_GET['data'];
if(isset($delSub))
{
	mysql_query("delete from subject where subject_id='$delSub'");
}

?>
<form method="post"></BR>
Add a new subject <input type=text name="addSub" required=required>&nbsp;
<input type="submit" name="addBttn" value="Add Subject">
</form>
</div>

</body>
</html>