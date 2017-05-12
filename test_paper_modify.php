<html>
<head></head>
<form method="post">
<body>

<?php
include("connection.php");
// boolean $debug=true ;

$test_paper_id = $_GET["mod"] ;
$qry_test_paper = "select T.paper_desc,T.subject_id,T.duration,T.total_marks,T.no_of_questions from test_paper T where T.paper_id='$test_paper_id'" ;

echo $qry_test_paper ;
$modify=mysqli_query($conn,$qry_test_paper);
$get=mysqli_fetch_array($modify);

$tp_sub_id=$get["subject_id"] ;

echo "Test Paper Subject Id:". $tp_sub_id ; 

?>

<table width="367" border="1">
    <tr>
      <td width="131">Paper Description:</td>
      <td width="226"><input type="text" name="paper_desc" value="<?php echo $get['paper_desc']; ?>">
        </input></td>
    </tr>
    <tr>
      <td>Subject:</td>
      <td><select name="subjectID" ID="subjectof"  onChange="showAll()">
	  <option value="">select...</option>
        <?php 
	$arr=mysqli_query($conn, "select S.subject_id,S.subject_description from subject S");
	while($row=mysqli_fetch_array($arr))
	{
	if($row['subject_id']==$tp_sub_id)
	echo "<option value=".$row["subject_id"]." selected>".$row["subject_description"]."</option>";
	else
	echo "<option value=".$row["subject_id"].">".$row["subject_description"]."</option>";
	}
	?>
      </select>
	  <?php  
	  if(isset($_POST['update']))
	  {
		  //  header("location:teacher-page.php?qry=test_paper_list");
	  $desc=$_POST['paper_desc'];
	  $sub_id=$_POST['subjectID'];
	  $no_of_ques=$_POST['no_of_ques'];
	  $duration=$_POST['duration'];
	  $marks=$_POST['marks'];
	  mysqli_query($conn, "update test_paper set paper_desc='$desc',subject_id='$sub_id',no_of_questions='$no_of_ques',duration='$duration',total_marks=
	  '$marks' where paper_id='$_GET[mod]'");	
	?>
<script>
window.location.href = "teacher-page.php?qry=test_paper_list";
</script>
<?php
	  }
	  ?>
&nbsp;</td>
    </tr>
    <tr>
      <td>No. of Questions:</td>
      <td><input type="text" name="no_of_ques" value="<?php echo $get['no_of_questions']; ?>">
        </input>
&nbsp;</td>
    </tr>
    <tr>
      <td>Duration:</td>
      <td><input type="text" name="duration" value="<?php echo $get['duration']; ?>">
        </input>(Mins)</td>
    </tr>
    <tr>
      <td>Marks:</td>
      <td><input type="number" name="marks" value="<?php echo $get['total_marks']; ?>">
        </input>
&nbsp;</td>
    </tr>
    <tr>
      <td><a href="teacher-page.php?mod=<?php echo $test_paper_id; ?>&qry=test_paper_view">Test Papers - Question List</a>&nbsp;</td>
      <td><!--  <input type="button" value="Select Questions" name="show_record"></input> -->
&nbsp;<input type="submit" name="update" value="Update"></td>
    </tr>
  </table>
  </body>
  </form>
  </html>