<!DOCTYPE html>
<html>
<head>

</head>
<body><center><h1><U>MODIFY QUESTION</U></h1></center>
<?php
ob_start();
error_reporting(1);
include("connection.php");
$question=mysqli_query($conn, "select question_desc, subject_id, topic_id  from question_master where question_id='$_GET[res]'");
$fetch=mysqli_fetch_array( $question);

$options=mysqli_query($conn,"select choice_id,choice_desc ,correct_choice from choice_master where question_id='$_GET[res]' order by choice_id ");

$get_options=array();
$ary_choice_id = array() ;
$ary_correct_choice = array() ;

$i=0;
while($get_opn=mysqli_fetch_array($options))
{
$get_options[$i]=$get_opn['choice_desc'];
$ary_choide_id[$i]=$get_opn['choice_id'];
$ary_correct_choice[$i]=$get_opn['correct_choice'];
$i++;
}

$correct_choice = $_POST['ans'] ;

if(isset($_POST['update']))
{
	header("location:teacher-page.php?qry=list_ques");
$topic=$_POST['topicID'];
//$subject=$_POST['subjectID'];
$question_change=$_POST['change_ques'];
mysqli_query($conn, "update question_master set question_desc='$question_change', topic_id='$topic' where question_id='$_GET[res]' ");
//mysql_query("update question_master set subject_id=$subject where question_id='$_GET[res]' ");
//mysql_query("update question_master set question_desc='$_POST[change_ques]' where question_id='$_GET[res]'");
if($correct_choice==1)
mysqli_query($conn, "update choice_master set choice_desc='$_POST[option_one]',correct_choice='YES' where choice_id='$ary_choide_id[0]'");
else
mysqli_query($conn, "update choice_master set choice_desc='$_POST[option_one]',correct_choice='NO' where choice_id='$ary_choide_id[0]'");

if($correct_choice==2)
mysqli_query($conn, "update choice_master set choice_desc='$_POST[option_two]',correct_choice='YES' where choice_id='$ary_choide_id[1]'");
else
mysqli_query($conn, "update choice_master set choice_desc='$_POST[option_two]',correct_choice='NO' where choice_id='$ary_choide_id[1]'");

if($correct_choice==3)
mysqli_query($conn, "update choice_master set choice_desc='$_POST[option_three]',correct_choice='YES' where choice_id='$ary_choide_id[2]'");
else
mysqli_query($conn, "update choice_master set choice_desc='$_POST[option_three]',correct_choice='NO' where choice_id='$ary_choide_id[2]'");

if($correct_choice==4)
mysqli_query($conn, "update choice_master set choice_desc='$_POST[option_four]',correct_choice='YES' where choice_id='$ary_choide_id[3]'");
else
mysqli_query($conn, "update choice_master set choice_desc='$_POST[option_four]',correct_choice='NO' where choice_id='$ary_choide_id[3]'");






}


?>
<script src="jquery-2.2.0.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){

		
		var inc=1;
	$(".check").change(function(){
		
		if($(".check:checked"))
	{
		inc++;
		if(inc > 1)
		{
			alert("can not select multiple options");
			inc=0;
			 $('.check').attr('checked', false);
		}
	
	}
	
		
	});
	
	
	
});

</script>


<div id="result"></div>
<form method="post" name="myform" >

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
   <!--   <select name="subjectID" id="aa">
	  <option value="select">Select...</option>  -->
	<?php 
	$arr=mysqli_query($conn, "select subject_id,subject_description from subject");
	
	while($row=mysqli_fetch_array($arr))
	{
		if ($row["subject_id"] == $fetch["subject_id"])
		{
			echo $row["subject_description"];
			//echo "<option value=".$row["subject_id"]."  selected=selected>".$row["subject_description"]."</option>";
		}
		else
		{
			//echo "<option value=".$row["subject_id"].">".$row["subject_description"]."</option>";	
		}
	
	}

	
	?>
      
     </select>
	 
	
	  
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  
	 
	
	  
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Topic:
      <select name="topicID">
	  <option value="select">select...</option>
         <?php 
			$arr=mysqli_query($conn, "select topic_id,subject_id,topic_description from topic where subject_id='$fetch[subject_id]'");
			while($row=mysqli_fetch_array($arr))
			{
			if($row['topic_id']==$fetch['topic_id'] )
			{
			echo "<option value=".$row["topic_id"]." selected=selected>".$row["topic_description"]."</option>";
			}
			else
			{
			echo "<option value=".$row["topic_id"].">".$row["topic_description"]."</option>";
			}
				
			}

	
	?>
		</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     
      
      </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Question:</td>
    <td><textarea name="change_ques" rows="5" cols="100" required=required><?php  echo $fetch['question_desc']; ?></textarea>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Answer 1: </td>
    <td><textarea name="option_one" cols="100" ><?php echo $get_options[0]; ?></textarea>&nbsp;</td>
    <td>
	<?php
	if($ary_correct_choice[0]=='YES')
	echo "<input type='checkbox' name='ans' class='check' checked=checked value='1'>";
	else
	echo "<input type='checkbox' name='ans' class='check' value='1'>";
	?>
	</td>
  </tr>
  <tr>
    <td>Answer 2: </td>
    <td><textarea name="option_two" cols="100" ><?php echo  $get_options[1]; ?></textarea>&nbsp;</td>
    <td>
	
	<?php
	if($ary_correct_choice[1]=='YES')
	echo "<input type='checkbox' name='ans' class='check' checked=checked value='2'>";
	else
	echo "<input type='checkbox' name='ans' class='check' value='2'>";
	?>
	
	</td>
  </tr>
  <tr>
    <td>Answer 3: </td>
    <td><textarea name="option_three" cols="100" ><?php echo  $get_options[2]; ?></textarea>&nbsp;</td>
    <td>
	<?php
	if($ary_correct_choice[2]=='YES')
	echo "<input type='checkbox' name='ans' class='check' checked=checked value='3'>";
	else
	echo "<input type='checkbox' name='ans' class='check' value='3'>";
	?>
	
	</td>
  </tr>
  <tr>
    <td>Answer 4: </td>
    <td><textarea name="option_four" cols="100"><?php echo $get_options[3]; ?></textarea>&nbsp;</td>
    <td>
	<?php
	if($ary_correct_choice[3]=='YES')
	echo "<input type='checkbox' name='ans' class='check' checked=checked value='4'>";
	else
	echo "<input type='checkbox' name='ans' class='check' value='4'>";
	?>
	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="update" value="UPDATE" >
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </td>
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
<?php 
ob_end_flush();
?>