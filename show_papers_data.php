<html>
<head>
<script>

</script>
</head>
<body>
<table>
<tr>
<th>Sno</th><th>Paper</th><th>Subject</th><th>No. of questions</th><th>Duration</th><th>Total marks</th>
</tr>
<?php
$count=1;
include('connection.php');
error_reporting(1);
$get_subID=$_REQUEST["q"];
if($get_subID=="ALL")
{
$test_paper=mysql_query("select T.paper_id,T.paper_desc,T.subject_id,T.no_of_questions,T.duration,T.total_marks,S.subject_description from test_paper T,subject S
where S.subject_id=T.Subject_id");
}
else
{
$test_paper=mysql_query("select T.paper_id,T.paper_desc,T.subject_id,T.no_of_questions,T.duration,T.total_marks,S.subject_description from test_paper T,subject S
where S.subject_id=T.Subject_id and T.subject_id=$get_subID");
}
while($data=mysql_fetch_array($test_paper))
{
?>
<tr><td ><?php echo $count; ?></td>
<td width=100><?php echo $data["paper_desc"]; ?></td>
<td width=100><?php echo $data["subject_description"]; ?></td>
<td width=100><?php echo $data["no_of_questions"]; ?></td>
<td width=100><?php echo $data["duration"]; ?></td>
<td width=100><?php echo $data["total_marks"]; ?></td> 
  <?php if($_SESSION['isadmin']=="yes") { ?>
<td><a href='teacher-page.php?mod=<?php echo $data[paper_id]; ?>&qry=test_paper_view'>generate xml</a></td><td width=100></td>
  <?php } ?>
<td><a href='teacher-page.php?qry=test_paper_del'  onClick='deleteme(<?php echo $data['paper_id']; ?> )'>Delete </a></td><td width=50px></td><td><a href='teacher-page.php?mod=<?php echo $data[paper_id]; ?>&qry=test_paper_modify'>Modify</a></td></tr>

<?php 
$count++;
}
?>
</table>