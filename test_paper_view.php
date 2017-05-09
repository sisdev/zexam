<div class="container">
<div class="row">
<div class="col-sm-10">
<table>
<?php
include("connection.php");
$get_val=$_GET['mod'];
?>
<a  href="test_paper_view_xml.php?mod=<?php echo $get_val; ?>" target="_blank">Generate XML</a><p>
<?php
$qry=mysql_query("select Q.question_desc,C.question_id from test_paper T,test_paper_questions C,question_master Q where T.paper_id=C.paper_id and Q.question_id=C.question_id and T.paper_id='$get_val'");
//$qry=mysql_query("select C.question_id,Q.question_desc from create_paper C,question_master Q where C.paper_id='$get_val' and Q.question_id=C.question_id");
$count=1;

while($val=mysql_fetch_array($qry))
{

$ans_count=1;
echo $count."-".$val['question_desc']."</br>";

$get_final_ans=1;
$options=mysql_query("select choice_desc,correct_choice from choice_master where question_id='$val[question_id]' ");
while($getop=mysql_fetch_array($options))
{
?>
<input <?php if($getop['correct_choice']=='YES') echo "checked"; ?> type=radio name=<?php echo $count; ?> ><?php echo $getop['choice_desc']; ?> </br>
<?php
if($getop['correct_choice']=='YES')
$get_final_ans=$ans_count;
else
$ans_count++;

}
echo "<p>";
$count++;

}



?>
</table>
</div>
</div>
</div>