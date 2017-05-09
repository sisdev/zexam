<html>
<head><title>Test paper</title>
<script src="jquery-2.2.0.min.js"></script>

<script>
function process()
{
var check_value=document.getElementById("check_it").innerHTML;
if(check_value<5)
{
alert("please select at least 5 Questions...");
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
.main
{
width:95%;
height:85%;
padding:1% 1%;
}
.form
{
width:27%;

float:left;


}
.ques{


display:none;
	
}
</style>
<script src="jquery-2.2.0.min.js"></script>
<script>
function showAll()
{
var xmlhttp = new XMLHttpRequest();
 var sub_id=document.getElementById("subjectof").value;
 if(sub_id=="none")
 {
	 alert("please select subject");
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


<form method="post" > <!-- onsubmit="return process()"  -->
<?php
error_reporting(1);

?>
<div class="main">
<h2><center>CREATE TEST PAPER</center></h2>
<div class="form">
  <table width="367" border="0">
    <tr>
      <td width="131">Paper Description:</td>
      <td width="226"><input type="text" name="paper_desc" required=required>
        </input></td>
    </tr>
    <tr>
      <td>Subject:</td>
      <td><select name="subjectID" ID="subjectof" > <!--  onChange="showAll()" -->
	  <option value="none">select...</option>
        <?php 
	$arr=mysqli_query($conn, "select subject_id,subject_description from subject");
	while($row=mysqli_fetch_array($arr))
	{
	echo "<option value=".$row["subject_id"].">".$row["subject_description"]."</option>";
	}
	?>
      </select>
&nbsp;</td>
    </tr>
    <tr>
      <td>No. of Questions:</td>
      <td><input type="text" name="no_of_ques" id="getques" required=required>
        </input>
		<script>
		$(document).ready(function(){
			
			$("#getques").blur(function(){
				
		
				
				
			});
			
			$("#autobttn").click(function(){
				var sub=$("#subjectof").val();
				var ques=$("#getques").val()
				if(sub=="none")
				{
					alert("please select subject");
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
		
		 <div id="blow" style="width:30%;height:auto;position:absolute;background-color:#cccccc;border-radius:1px;display:hidden;">
		 
		 </div>
		
		
&nbsp;</td>
    </tr>
    <tr>
	
      <td>Duration:</td>
      <td><input type="text" name="duration">
        </input>(Mins)</td>
    </tr>
    <tr>
      <td>Marks:</td>
      <td><input type="number" name="marks">
        </input>
&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><!--  <input type="button" value="Select Questions" name="show_record"></input> -->
&nbsp;</td>
    </tr>
  </table>
 
  <input type="button" id="autobttn" value="Randomly select" name="random">
  <input type="button" id="manualbttn" value="manual" name="manual" onclick="showAll()">
  
  <?php
  
 
  
  if(isset($_POST['random_ques']))
  {  

	  $get_paper_desc=$_POST['paper_desc'];
	$get_no_of_ques=$_POST['no_of_ques'];
	$get_duration=$_POST['duration'];
	$get_marks=$_POST['marks'];
	$address=$_SERVER['REMOTE_ADDR'];
$get_dtm=(string)date("Y-m-d H:i:s");
$createdby="jasbir singh";
	$get_subjectID=$_POST['subjectID'];
	
	mysqli_query($conn, "insert into test_paper (paper_desc,subject_id,no_of_questions,duration,total_marks,created_dtm,created_ip,created_by) values
	('$get_paper_desc','$get_subjectID','$get_no_of_ques','$get_duration','$get_marks','$get_dtm','$address','$createdby')");
	
	
	$get_last_value=mysqli_insert_id(); 
	  
	 $ques_string=$_POST['id_array'];          
	 $ques_array=explode(",",$ques_string);   // converting $ques_string into array
	 
	  foreach( $ques_array as $value)
		{
		mysqli_query($conn, "insert into  test_paper_questions (paper_id,question_id) values($get_last_value,$value) ") or die(mysql_error());	
		
		}
		
	 
	header("location:teacher-page.php?qry=create_test_paper");    
	  
  }
  
  
  ?>
</div>

<div class="ques">
Selected Questions:
<div id="check_it" name="check_name">
0
</div>

<div id="selectData" class="col-sm-3">
		
	
		
		
		</div>
		<input type="submit"   name="submit_it" value="proceed" style="margin-top:10" onclick="return process()">
	
		<?php  
		
		if(isset($_POST["submit_it"]))
		{
	$get_paper_desc=$_POST['paper_desc'];
	$get_no_of_ques=$_POST['no_of_ques'];
	$get_duration=$_POST['duration'];
	$get_marks=$_POST['marks'];
	$address=$_SERVER['REMOTE_ADDR'];
$get_dtm=(string)date("Y-m-d H:i:s");
$createdby="jasbir singh";
	$get_subjectID=$_POST['subjectID'];
	
	mysqli_query($conn, "insert into test_paper (paper_desc,subject_id,no_of_questions,duration,total_marks,created_dtm,created_ip,created_by) values
	('$get_paper_desc','$get_subjectID','$get_no_of_ques','$get_duration','$get_marks','$get_dtm','$address','$createdby')");
	
	
	$last_value=mysqli_insert_id();
		
		$get_check=$_POST['checkme'];
	foreach($get_check as $value)
	{
	mysqli_query($conn, "insert into  test_paper_questions (paper_id,question_id) values($last_value,$value) ") or die(mysql_error());
	}
	header("location:teacher-page.php?qry=create_test_paper");
		}
		 
		?>
		
</div>


	</div>
	
</form>
</body>
</html>