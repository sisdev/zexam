<?php
include("connection.php");
$recieve=$_REQUEST['passval'];

if($recieve==11)
{
$topic=mysql_query("select T.topic_description,S.subject_description,topic_id from topic T,subject S where T.subject_id=S.subject_id");	
	
}
else
$topic=mysql_query("select T.topic_description,S.subject_description,topic_id from topic T,subject S where T.subject_id=S.subject_id
and S.subject_id='$recieve'
");
echo "<table>";
$count=1;
while($getTopic=mysql_fetch_array($topic))
{
echo "<tr><td>$count </td><td width=20px></td><td> $getTopic[topic_description]</td><td width=20px></td><td>$getTopic[subject_description]</td><td width=50px></td>
<td><a href='teacher-page.php?data=$getTopic[topic_id]&qry=topic_modify'>Modify</a></td><td width=50px></td><td><a href='teacher-page.php?delData=$getTopic[topic_id]&qry=topic_del' onclick='return delbox()'>Delete</a></td>
</tr>";
$count++;
}
echo "</table>";


?>