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
</script>
<body>
<h2 style="text-align:center; padding:0px 0 15px 0; margin:0px; text-decoration:underline;">LIST OF QUESTIONS</h2>
Subject:- <select id="bysub" onChange="subchange(this.value)" style="margin-bottom:15px;">
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

$ques_list = "select * from question_master where created_by = '$user_name'" ;

echo $ques_list ;

$sel=mysqli_query($conn, $ques_list);

$count_sno=1;
echo "<table border=1>" ;
echo "<tr><th>&nbsp; Sno &nbsp;</th><th>&nbsp; Question Description &nbsp;</th><th>Modify</th><th>Delete</th><tr>";
while($row=mysqli_fetch_array($sel))
{
echo "<tr><td>&nbsp;".$count_sno."</td><td>";
echo $row["question_desc"];
echo "</td><td><a href='teacher-page.php?res=$row[question_id]&qry=qlst_1'>&nbsp;Modify &nbsp;</a>";
echo "</td><td><a href='teacher-page.php?res=$row[question_id]&qry=qlst_2'>&nbsp; Delete &nbsp;</a></td></tr>";
$count_sno+=1;
}
echo "</table>" ;
$del=@$_GET['res'];
mysqli_query($conn, "delete from question_master where question_id='$del' ");
mysqli_query($conn, "delete from choice_master where question_id='$del'");

/*?>$xml = new SimpleXMLElement('<xml/>');

for ($i = 1; $i <= 8; ++$i) {
    $track = $xml->addChild('track');
    $track->addChild('path', "song$i.mp3");
    $track->addChild('title', "Track $i - Track Title");
}

Header('Content-type: text/xml');
print($xml->asXML()); */
?>
</div>


