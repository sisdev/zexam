<?php 
include('connection.php');
?>
<!DOCTYPE html>
<html>

<head>
<script>

function ShowTopic(str) {

      
	  var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST", "getTopic.php?q=" + str);
        xmlhttp.send();
       
	    xmlhttp.onreadystatechange = function() 
		{
		
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			 {
                document.getElementById("selTopic").innerHTML = xmlhttp.responseText;
            }
        }
		
       
    }


</script>
</head>
<body onLoad="ShowTopic(1)">

<center><h2>ADD QUESTION</h2></center>
<?php
if(isset($_POST['submit']))
{
$getQues=$_POST['question'];
$getTopic=$_POST['topicID'];
$getSub=$_POST['subjectID'];
$address=$_SERVER['REMOTE_ADDR'];
$get_dtm=(string)date("Y-m-d H:i:s");
$createdby="jasbir singh";
$correct_choice = $_POST['ans'] ;
mysqli_query($conn,"insert into question_master(question_desc,topic_id,subject_id,created_dtm,created_ip,created_by) 
values('$getQues','$getTopic','$getSub', '$get_dtm','$address','$createdby')") or die(mysql_error());

$answer1=$_POST['answer1'];
if($answer1=="")
	$answer1=" ";
$answer2=$_POST['answer2'];
if($answer2=="")
	$answer2=" ";
$answer3=$_POST['answer3'];
if($answer3=="")
	$answer3=" ";
$answer4=$_POST['answer4'];
if($answer4=="")
	$answer4=" ";
$last_val=(string)mysqli_insert_id() ; // getting last ID from autoincrement

//$ques_id=mysql_query("select question_id from question_master where question_desc='$_POST[question]'");	$row=mysql_fetch_array($ques_id);
if ($correct_choice == 1)
{
mysqli_query($conn, "insert into choice_master (choice_desc,correct_choice,question_id) values('$answer1','YES',$last_val)");
}
else 
{
mysqli_query($conn, "insert into choice_master (choice_desc,correct_choice,question_id) values('$answer1','NO',$last_val)");
}
if ($correct_choice == 2)
{
	mysqli_query($conn, "insert into choice_master (choice_desc,correct_choice,question_id) values('$answer2','YES',$last_val)");
}
else
{
	mysqli_query($conn, "insert into choice_master (choice_desc,correct_choice,question_id) values('$answer2','NO',$last_val)");
}
if ($correct_choice == 3)
{ 
mysqli_query($conn, "insert into choice_master (choice_desc,correct_choice,question_id) values('$answer3','YES',$last_val)");
}
else 
{
mysqli_query($conn, "insert into choice_master (choice_desc,correct_choice,question_id) values('$answer3','NO',$last_val)");
}
if ($correct_choice == 4)
{
mysqli_query($conn, "insert into choice_master (choice_desc,correct_choice,question_id) values('$answer4','YES',$last_val)");
}
else
{
mysqli_query($conn, "insert into choice_master (choice_desc,correct_choice,question_id) values('$answer4','NO',$last_val)");
}
}
?>
<div id="result"></div>
<form method="post" name="myform">
<table width="965" border="0">
  <tr>
    <td colspan="2"><form name="form1" method="post" action="">
        <label></label>
    </td>
    <td width="37">&nbsp;</td>
  </tr>
  <tr>
    <td width="215"><label></label></td>
    <td width="631">Subject:
      <select name="subjectID" id="aa" onclick="ShowTopic(this.value)">
	  
	<?php 
	$arr=mysqli_query($conn, "select subject_id,subject_description from subject");
	while($row=mysqli_fetch_array($arr))
	{
	echo "<option value=".$row["subject_id"].">".$row["subject_description"]."</option>";
	}
	?>
      
     </select>
	 
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Topic: 
	  <a id="selTopic">
	  
	   <select><option>select...</option></select>	  
	  </div>
	  

   
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<script>
$(document).ready(function(){
	var inc=0;
	$(".check").change(function(){
		
	if($(".check:checked"))
	{
		inc++;
		if(inc==2)
		{
			alert("can not select multiple options");
			inc=0;
			 $('.check').attr('checked', false);
		}
	}
		
		
		
	});
	
});

</script>

    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Question:</td>
    <td><textarea name="question" placeholder="Enter question" rows="5" cols="100" required=required></textarea>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Answer 1: </td>
    <td><textarea name="answer1" cols="100"></textarea>&nbsp;</td>
    <td>&nbsp;<input type="checkbox" class="check" name="ans"  value="1"></td>
  </tr>
  <tr>
    <td>Answer 2: </td>
    <td><textarea name="answer2" cols="100"></textarea>&nbsp;</td>
    <td>&nbsp;<input type="checkbox" class="check" name="ans" value="2"></td>
  </tr>
  <tr>
    <td>Answer 3: </td>
    <td><textarea name="answer3" cols="100"></textarea>&nbsp;</td>
    <td>&nbsp;<input type="checkbox" class="check" name="ans" value="3"></td>
  </tr>
  <tr>
    <td>Answer 4: </td>
    <td><textarea name="answer4" cols="100"></textarea>&nbsp;</td>
    <td>&nbsp;<input type="checkbox" class="check" name="ans" value="4"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="submit">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="reset" name="reset" value="reset">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>


</html>