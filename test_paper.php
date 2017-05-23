<?php
error_reporting(1);
session_start();
include("connection.php");
$user_name = $_SESSION['login'] ;
?>

  <?php
  
 
  
  if(isset($_POST['random_ques']))
  {  

	  $get_paper_desc=$_POST['paper_desc'];
	$get_no_of_ques=$_POST['no_of_ques'];
	$get_duration=$_POST['duration'];
	$get_marks=$_POST['marks'];
	$address=$_SERVER['REMOTE_ADDR'];
$get_dtm=(string)date("Y-m-d H:i:s");
$createdby=$_SESSION["login"];
	$get_subjectID=$_POST['subjectID'];
	
	mysqli_query($conn, "insert into test_paper (paper_desc,subject_id,no_of_questions,duration,total_marks,created_dtm,created_ip,created_by) values
	('$get_paper_desc','$get_subjectID','$get_no_of_ques','$get_duration','$get_marks','$get_dtm','$address','$createdby')");
	
	
	$get_last_value=mysqli_insert_id($conn); 
	  
	 $ques_string=$_POST['id_array'];          
	 $ques_array=explode(",",$ques_string);   // converting $ques_string into array
	 
	  foreach( $ques_array as $value)
		{
		mysqli_query($conn, "insert into  test_paper_questions (paper_id,question_id) values($get_last_value,$value) ") or die(mysql_error());	
		
		}
		
	 
	header("location:teacher-page.php?qry=create_test_paper");    
	  
  }
  
  
  ?>
 
  <?php  
		
	if(isset($_POST["submit_it"]))
		{
		$get_paper_desc=$_POST['paper_desc'];
		$get_no_of_ques=$_POST['no_of_ques'];
		$get_duration=$_POST['duration'];
		$get_marks=$_POST['marks'];
		$address=$_SERVER['REMOTE_ADDR'];
		$get_dtm=(string)date("Y-m-d H:i:s");
		$createdby=$user_name;
		$get_subjectID=$_POST['subjectID'];
		mysqli_query($conn, "insert into test_paper (paper_desc,subject_id,no_of_questions,duration,total_marks,created_dtm,created_ip,created_by) values
	('$get_paper_desc','$get_subjectID','$get_no_of_ques','$get_duration','$get_marks','$get_dtm','$address','$createdby')");
	
	
		$last_value=mysqli_insert_id($conn);
	
		echo "<BR> Last Question Entered:".$last_value  ;
		
		$get_check=$_POST['checkme'];
		print_r($get_check) ;
		foreach($get_check as $value)
		{
			$insert_qry = "insert into  test_paper_questions (paper_id,question_id) values($last_value,$value) " ;
			// echo $insert_qry ;
			mysqli_query($conn, $insert_qry) or die(mysql_error());
		}
	
	}
		 
		?>




<html>
<head><title>Test paper</title>
<script src="js/jquery-2.2.0.min.js"></script>
		<script>
		$(document).ready(function(){
			
			$("#getques").blur(function(){
				
		
				
				
			});
			
			$("#autobttn").click(function(){
				var sub=$("#subjectof").val();
				var ques=$("#getques").val();
				
				var paper_desc=document.getElementById("description").value;
				var no_of_question=document.getElementById("getques").value;
				var paper_duration=document.getElementById("duration").value;
				var paper_marks=document.getElementById("marks").value;
				
				if(sub=="none")
				{
					alert("Please select the subject.");
				}
				else if(paper_desc=="")
				 {
					 alert("Please enter paper description.");
					 document.getElementById("description").focus();
					 
				 }
				 
				else if(no_of_question=="")
				 {
					 alert("Please enter no of question.");
					 document.getElementById("getques").focus();
					
				 }
				 
				 else if(paper_duration=="")
				 {
					 alert("Please enter paper duration.");
					 document.getElementById("duration").focus();
					
				 }
				 else if(paper_marks=="")
				 {
					 alert("Please enter paper total marks.");
					 document.getElementById("marks").focus();
					 
				 }
				else
				{
					
				$("#blow").fadeIn("slow");
				$.post("test_paper_random.php",{send_sub:sub,send_ques:ques},function(data,status){
				
				$("#blow").css({"display":"block"});
				
					document.getElementById("blow").innerHTML=data;
					
				});
				}
				$("#blow").click(function(){
					$("#blow").fadeOut("slow");
					
				});
			});
			
		});
		</script>

<script>
function process()
{
var check_value=document.getElementById("check_it").innerHTML;
if(check_value<5)
{
alert("Please select at least 5 questions.");
return false;
}
}
function selected(get)
{
var increment=0;
var matches = [];
$(".common:checked").each(function() {
   increment= matches.push(this.value);
   document.getElementById("check_it").innerHTML=increment;
});
}
</script>
<style>
.clear{clear:both;}
.form
{float:left;}
.ques{
display:none;
	
}

table th, td{padding:10px 10px;}

</style>

<script>
function showAll()
{
var xmlhttp = new XMLHttpRequest();
  var sub_id=document.getElementById("subjectof").value;
  var paper_desc=document.getElementById("description").value;
  
  var no_of_question=document.getElementById("getques").value;
  
  var paper_duration=document.getElementById("duration").value;
  var paper_marks=document.getElementById("marks").value;
  
 if(sub_id=="none")
 {
	 alert("Please select the subject.");
	 document.getElementById("subjectof").focus();
	 return false;
 }
 
 if(paper_desc=="")
 {
	 alert("Please enter paper description.");
	 document.getElementById("description").focus();
	 return false;
 }
 
 if(no_of_question=="")
 {
	 alert("Please enter no of question.");
	 document.getElementById("getques").focus();
	 return false;
 }
 
 if(paper_duration=="")
 {
	 alert("Please enter paper duration.");
	 document.getElementById("duration").focus();
	 return false;
 }
 if(paper_marks=="")
 {
	 alert("Please enter paper total marks.");
	 document.getElementById("marks").focus();
	 return false;
 }
 

		xmlhttp.open("POST", "test_paper_select.php?q=" + sub_id,true);
        xmlhttp.send();
      
	    xmlhttp.onreadystatechange = function() 
		{
		
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			 {
                document.getElementById("selectData").innerHTML = xmlhttp.responseText;
            }
			
			
        }
}
</script>

</head>
<body>

<div class="main">

<h2 style="text-align:center; padding:0px 0 20px 0; margin:0px;">Create Test Paper</h2>



<form method="post" > 
  <table  border="1" bordercolor="#ddd">
    <tr>
		<td>Subject:</td>
		<td><select name="subjectID" ID="subjectof" style="margin-bottom:10px;"> 
			<option value="none">Select subject</option>
			<?php 
				$arr=mysqli_query($conn, "select subject_id,subject_description from subject");
				while($row=mysqli_fetch_array($arr))
				{
					echo "<option value=".$row["subject_id"].">".$row["subject_description"]."</option>";
				}
			?>
			</select>
		</td>
		<td width="10%" rowspan="4"></td>
		<td>No. of Questions:</td>
		<td><input type="number" name="no_of_ques" id="getques"  style="margin-bottom:10px;">	</td>
    </tr>
    
	
    <tr>
  		<td>Paper Description: </td>
		<td><input type="text" name="paper_desc" id="description" style="margin-bottom:10px;"/></td>
   
		<td>Duration:</td>
		<td><input type="number" name="duration" id="duration" style="margin-bottom:10px;"/> (Mins)</td>
    </tr>
    <tr>
      
	  <td>Access Type:</td>
      <td>
	  	<select style="width:100%;">
			<option selected="selected">Public</option>
			<option>Private</option>
		</select>
	  </td>
	  <td>Marks:</td>
      <td><input type="number" name="marks" id="marks"></td>
    </tr>
	<tr>
		<td colspan="2" style="text-align:center;"><input type="button" id="autobttn" value="Randomly Select" name="random" style="border:none; background:#337ab7; color:#FFFFFF; padding:7px 10px; border-radius:5px; width:45%;"></td>
		<td colspan="2" style="text-align:center;"><input type="button" id="manualbttn" value="Manually Select" name="manual" onClick="showAll()" style="border:none; background:#337ab7; color:#FFFFFF; padding:7px 10px; border-radius:5px; width:45%;"></td>
	</tr>
    
  </table>
 
		 <div id="blow" style="border-radius:1px; margin-top:10%;">
		 
		 </div>
  
  
	
<div class="ques" style="border:#ddd  solid 1px;">


<table width="100%">
	<tr>
		<td>
			Selected questions: <span id="check_it" name="check_name"> 0 </span>
		</td>
		<td style="text-align:right;"> 
			<input type="submit"   name="submit_it" value="Manually Select Submit" style="border:none; background:#337ab7; color:#FFFFFF; padding:7px 10px; border-radius:5px;" onClick="return process()">
		</td>
	</tr>
</table>


<div id="selectData" class="col-sm-12"></div>
		
	
				
		<div  class="clear"></div>
		
</div><!--ques-div-end-->
</form>
	
	

  
  
<!--</div>--><!--form-div-end-->




<div class="clear"></div>
</div><!--main-div-->



	

</body>
</html>