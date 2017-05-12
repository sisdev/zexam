<table>
<?php
$xml=new DOMDocument('1.0','UTF-8');
$xml->formatOutput=true;
$questions=$xml->createElement("Questionare");
$xml->appendChild($questions);

$count=1;
$question_number=1;
include("connection.php");
$qry=mysqli_query($conn, "select Q.question_desc,C.question_id,tp.topic_description,T.paper_desc,T.duration,S.subject_description from test_paper T,test_paper_questions C,question_master Q,topic tp ,subject S where T.paper_id=C.paper_id and Q.question_id=C.question_id and tp.topic_id=q.topic_id and S.subject_id=T.subject_id and T.paper_id='".$_GET['mod']."'");

while($val=mysqli_fetch_array($qry))
{
$questions->setAttribute("duration",$val['duration']);
$questions->setAttribute("course",$val['subject_description']);
$ques=$xml->createElement("Question");
$questions->appendChild($ques);


$quesname=$xml->createElement("QStr",$val['question_desc']);
$ques->appendChild($quesname);

$ques->setAttribute("number",$question_number);
$question_number++;

$topic=$xml->createElement("topic",$val['topic_description']);
$ques->appendChild($topic);

$ans_count=1;

$get_final_ans=1;
$options=mysqli_query($conn, "select choice_desc,correct_choice from choice_master where question_id='$val[question_id]' ");
while($getop=mysqli_fetch_array($options))
{
$option=$xml->createElement("Item",$getop['choice_desc']);
$ques->appendChild($option);
if($getop['correct_choice']=='YES')
$get_final_ans=$ans_count;
else
$ans_count++;
}
$count++;
$ans=$xml->createElement("Answer",$get_final_ans);
$ques->appendChild($ans);
}
echo "<xmp>".$xml->saveXML()."</xmp>";
$paper_qry=mysqli_query($conn, "select Q.question_desc,C.question_id,tp.topic_description,T.paper_desc,T.duration,S.subject_description from test_paper T,test_paper_questions C,question_master Q,topic tp ,subject S where T.paper_id=C.paper_id and Q.question_id=C.question_id and tp.topic_id=q.topic_id and S.subject_id=T.subject_id and T.paper_id='".$_GET['mod']."'");

$paper_name=mysqli_fetch_array($paper_qry);
$xml->save("papers/".$paper_name['paper_desc'].".xml");


?>
</table>