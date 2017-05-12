<html>
<head>
<style>
.holder
{

	height:20%;
	
	margin:5% 5%;
	padding:5%;
}
</style>
</head>
<body>
<div class="holder">
<form>
<?php
include('connection.php');
$getData=$_GET['data'];
$sub=mysqli_query($conn, "select subject_description from subject where subject_id='$getData'");
$getSub=mysqli_fetch_array($sub);
if(isset($_POST['subBttn']))
{
	//header("location:teacher-page.php?qry=subject_change");
	mysqli_query($conn, "update subject set subject_description='$_POST[subChange]' where subject_id='$getData'");
	?>
<script>
window.location.href = "teacher-page.php?qry=subject_manage";
</script>
<?php
	
}
?>
Edit Subject <input type='text' name='subChange' value="<?php echo $getSub['subject_description'] ?>">
<input type='submit' name='subBttn' value="Change">
</form>
</div>
</body>
</html>