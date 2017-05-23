<?php
 if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
else
{
	$user_name=$_SESSION['email'] ;
}
 ?>

<html>
<head></head>
<script>
function subchange(itsval)
{
	var xmlhttp = new XMLHttpRequest();
	var sub_id=document.getElementById("bysub").value;
		xmlhttp.open("POST", "question_by_subject.php?q=" + sub_id,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() 
		{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			 {
                document.getElementById("ques_by_sub").innerHTML = xmlhttp.responseText;
             }	
       }
}

//start delete function..
function delbox()
{
	
	var value=confirm("Do you really want to delete.");
	if(value==true)
		return true;
	else
		return false;
}

//end delete function..
</script>
<body>
<h2 style="text-align:center; padding:0px 0 15px 0; margin:0px; text-decoration:underline;">LIST OF QUESTIONS</h2>
<?php  

$ques_list = "select * from question_master where created_by = '$user_name'" ;

//echo $ques_list."<BR>" ;

$sel=mysqli_query($conn, $ques_list);

$ques_count = mysqli_num_rows($sel) ;

if ($ques_count == 0)
{
	echo " No questions submitted by you" ;
	exit(1) ;
}
	
?>	

Subject:- <select id="bysub" onChange="subchange(this.value)" style="margin-bottom:15px;">
 <option value="select" selected>Select Subject </option>
<?php
$sub=mysqli_query($conn, "select subject_description,subject_id from subject where subject_id in (select distinct subject_id from question_master where created_by = '$user_name')");
while($getSub=mysqli_fetch_array($sub))
{
	echo "<option value=".$getSub["subject_id"].">".$getSub["subject_description"]."</option>";
	
}
?>
</select>
<div id="ques_by_sub">


<?php
echo " Total Questions Submitted by $user_name : "."<b>". $ques_count."</b>" ;

$count_sno=1;
echo "<table border=1>" ;
echo "<tr><th>&nbsp; Sno &nbsp;</th><th>&nbsp; Question Description &nbsp;</th><th>&nbsp; Modify &nbsp;</th><th>&nbsp; Delete &nbsp;</th><tr>";
while($row=mysqli_fetch_array($sel))
{
echo "<tr><td>&nbsp;".$count_sno."</td><td>&nbsp;";
echo $row["question_desc"];
echo "</td><td><a href='teacher-page.php?res=$row[question_id]&qry=qlst_1'>  Modify </a>";
echo "</td><td><a href='teacher-page.php?res=$row[question_id]&qry=qlst_2' onclick='return delbox()'>  Delete </a></td></tr>";
$count_sno+=1;
}
echo "</table>" ;

$del=@$_GET['res'];
if(isset($del)){
	mysqli_query($conn, "delete from question_master where question_id='$del' ");
	mysqli_query($conn, "delete from choice_master where question_id='$del'");
	?>
	<script>
		window.location.href = "teacher-page.php?qry=list_ques";
	</script>
	<?php
}
?>

</div>


