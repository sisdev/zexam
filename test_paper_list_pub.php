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
<?php
$test_paper_list = "select T.paper_id,T.paper_desc,T.subject_id,T.no_of_questions,T.duration,T.total_marks,S.subject_description from test_paper T,subject S
where S.subject_id=T.Subject_id and T.access_type = 'public'" ;

echo $test_paper_list."<BR>" ;

$test_paper=mysqli_query($conn,$test_paper_list);

$test_paper_count=mysqli_num_rows($test_paper) ;

if ($test_paper_count == 0) {
	echo "No test paper available for you" ;
	
	exit(1) ;
}
	
echo "Total Testpapers:". $test_paper_count ;	

?>
<form method=post>
<div id="seldata">
<table>
<tr>
<th>Sno</th><th>Paper</th><th>Subject</th><th>No. of questions</th><th>Duration</th><th>Total marks</th>
</tr>
<?php 
$count=1;

while($data=mysqli_fetch_array($test_paper))
{
?>
<tr><td ><?php echo $count; ?></td>
<td width=100><?php echo $data["paper_desc"]; ?></td>
<td width=100><?php echo $data["subject_description"]; ?></td>
<td width=100><?php echo $data["no_of_questions"]; ?></td>
<td width=100><?php echo $data["duration"]; ?></td>
<td width=100><?php echo $data["total_marks"]; ?></td> 
<td width=50px></td><td><a href='teacher-page.php?mod=<?php echo $data[paper_id]; ?>&qry=test_paper_assign_self'>Test Paper Assign</a></td></tr>

<?php 
$count++;
}
?>
</table>
</div>

</form></body></html>



