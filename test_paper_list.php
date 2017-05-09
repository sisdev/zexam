<?php
	error_reporting(1);
	include("connection.php");


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
<head>

<script>
function deleteme(del_value)
{
var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST", "delete_papers_data.php?send_val=" + del_value);
        xmlhttp.send();
       alert("Test paper deleted....");
	    xmlhttp.onreadystatechange = function() 
		{
		
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			 {
               // document.getElementById("deleted_data").innerHTML = xmlhttp.responseText;
			   
            }
        }

}



function Retrive(get_val)
{
var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST", "show_papers_data.php?q=" + get_val);
        xmlhttp.send();
       
	    xmlhttp.onreadystatechange = function() 
		{
		
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			 {
                document.getElementById("seldata").innerHTML = xmlhttp.responseText;
            }
        }
}
</script>
</head>
<body>
<center><h1>LIST OF TEST PAPERS</h1></center>
<form method=post>
Select Test Paper:-<select name="subjectID" id="myid" onChange="Retrive(this.value)">
	  <option value="select">select...</option>
	  <option value="ALL">ALL</option>
	<?php
	$arr=mysql_query("select subject_id,subject_description from subject");
	while($row=mysql_fetch_array($arr))
	{
	echo "<option value=".$row["subject_id"].">".$row["subject_description"]."</option>";
	}
	?>
      
     </select><p><p>
<div id="seldata">
<table>
<tr>
<th>Sno</th><th>Paper</th><th>Subject</th><th>No. of questions</th><th>Duration</th><th>Total marks</th>
</tr>
<?php 
$count=1;
$test_paper_list = "select T.paper_id,T.paper_desc,T.subject_id,T.no_of_questions,T.duration,T.total_marks,S.subject_description from test_paper T,subject S
where S.subject_id=T.Subject_id and T.created_by = '$user_name'" ;

echo $test_paper_list ;

$test_paper=mysql_query($test_paper_list);

while($data=mysql_fetch_array($test_paper))
{
?>
<tr><td ><?php echo $count; ?></td>
<td width=100><?php echo $data["paper_desc"]; ?></td>
<td width=100><?php echo $data["subject_description"]; ?></td>
<td width=100><?php echo $data["no_of_questions"]; ?></td>
<td width=100><?php echo $data["duration"]; ?></td>
<td width=100><?php echo $data["total_marks"]; ?></td> 
  <?php if($res['role']=="admin") {  $_SESSION['isadmin']="yes"; ?>
<td><a href='teacher-page.php?mod=<?php echo $data[paper_id]; ?>&qry=test_paper_view'>generate xml</a></td><td width=100></td>
  <?php } ?>
<td><a href='teacher-page.php?qry=test_paper_del'  onClick='deleteme(<?php echo $data['paper_id']; ?> )'>Delete </a></td><td width=50px></td><td><a href='teacher-page.php?mod=<?php echo $data[paper_id]; ?>&qry=test_paper_modify'>Modify</a></td></tr>

<?php 
$count++;
}
?>
</table>
</div>

</form></body></html>



