<?php 
include('connection.php');
if(!isset($_SESSION['login']))
{
	header("location:index.php");
}
else
{
	$user_name=$_SESSION['login'] ;
}

?>
<!DOCTYPE html>
<html>

<head>

<script type="text/javascript" language="JavaScript">

        function checkCheckBoxes(theForm) {

            var test = document.getElementsByName("ans");
			var chk_count = 0 ;
			var select_index = document.getElementById("selectTopic").value;
			//alert("Index no: "+select_index);
			
			if(select_index==0){
				alert("Please select the topic.");
				return false;
			}
			
			if(test[0].checked==true)
            {
                chk_count++ ;
            }

			if(test[1].checked==true)
            {
                chk_count++ ;
            }

			if(test[2].checked==true)
            {
                chk_count++ ;
            }
			if(test[3].checked==true)
            {
                chk_count++ ;
            }
			//alert("Check Box Counts:"+chk_count);
			
			if (chk_count==0){
			    alert("Please check atleast one check box for correct answer.");
				return false ;
			}
			else if (chk_count ==1){
				alert("Question added successfully.");
				return true ;
			}
			else if (chk_count>1){
			    alert("Please check only one check box.");
				return false ;
			}
			
			
			
        }

    </script>
<script>
/*$(document).ready(function(){

		
	var inc=0;
	$(".check").change(function(){
	var check_status = $(this).checked ;
	alert("Check status:"+ check_status) ;	
		if($(".check").checked=="true")
	{
		inc++;
	}
	else
	{
		inc-- ;
	}
	if(inc==2)
		{
			alert("can not select multiple options");
			///$(this).prop('checked', false);
			
		}		
	}) ;


	$( "#quesform" ).submit(function( event ) {
	alert( "Handler for .submit() called."+inc );
//	return false ;
	//event.preventDefault();
	});
		
		
	
		
	});
	


function validateForm(){
/*
var t1 = prompt("Enter data");
alert("Number of checkboxed checked:") ;

alert(inc) ;
return false ;
*/
/*	if(inc > 1)
		{
			alert("can not select multiple options");
			inc=0;
			 $('.check').attr('checked', false);
		}
	
	
}

*/




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
<body onLoad="ShowTopic(10)">

<h2 style="text-align:center; padding:0px 0 15px 0; margin:0px;">ADD QUESTION</h2>
<?php
if(isset($_POST['submit']))
{
$getQues=$_POST['question'];
$getTopic=$_POST['topicID'];
$getSub=$_POST['subjectID'];
$address=$_SERVER['REMOTE_ADDR'];
$get_dtm=(string)date("Y-m-d H:i:s");
$createdby=$user_name ;
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
$last_val= mysqli_insert_id($conn) ; // getting last ID from autoincrement

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

<form name="form1" method="post" onsubmit="return checkCheckBoxes(this)">
<table border="0">
  <tr>
    <td colspan="2">
        <label></label>
    </td>
    <td width="37">&nbsp;</td>
  </tr>
  <tr style="margin-bottom:10px;">
    <td><label></label></td>
    <td>Subject:
      <select name="subjectID" id="aa" onclick="ShowTopic(this.value)">
	  
	<?php 
	$arr=mysqli_query($conn, "select subject_description,subject_id from subject");
	// where subject_id in (select distinct subject_id from question_master where created_by = '$user_name')
	
	while($row=mysqli_fetch_array($arr))
	{
	echo "<option value=".$row["subject_id"].">".$row["subject_description"]."</option>";
	}
	?>
      
     </select>
	 
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Topic: 
	  <span id="selTopic">
	  
	   <select id="selectTopic">
		   <option value="0">Select Topic</option>
	   </select>	  
	  </span >
	  

   
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    </td>
	
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>Question: &nbsp;&nbsp;</td>
    <td><textarea name="question" placeholder="Enter question" rows="5"  cols="100" required style="margin-top:15px;"></textarea>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Answer 1: </td>
    <td><textarea name="answer1" required cols="100" ></textarea>&nbsp;</td>
    <td>&nbsp;<input type="checkbox" class="check" name="ans"  value="1"></td>
  </tr>
  
  <tr>
    <td>Answer 2: </td>
    <td><textarea name="answer2" required cols="100"></textarea>&nbsp;</td>
    <td>&nbsp;<input type="checkbox" class="check" name="ans" value="2"></td>
  </tr>
  
  <tr>
    <td>Answer 3: </td>
    <td><textarea name="answer3" required cols="100"></textarea>&nbsp;</td>
    <td>&nbsp;<input type="checkbox" class="check" name="ans" value="3"></td>
  </tr>
  
  <tr>
    <td>Answer 4: </td>
    <td><textarea name="answer4" required cols="100"></textarea>&nbsp;</td>
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
  
</table>
</form>


</html>