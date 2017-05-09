<?php
require('connection.php');

?>


  <body>

 <?php 
if(isset($_GET['teach']))
{
	$select=mysql_query("select username,userpass,institute,subject,userpass from users where userid='".$_GET['teach']."'");
 
 $datateach=mysql_fetch_array($select);
 ?>
   <h2>Update Teachers Record</h2>
 <form class="form-horizontal" method="post">
<fieldset>



<!-- Text input-->
<div class="form-group">

  <div class="col-md-10">
  <input id="emailid" name="upd_email" placeholder="Email ID" class="form-control input-md" required="" value=<?php echo $datateach['username']; ?> type="email">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
 
  <div class="col-md-10">
    <select id="selectbasic" name="upd_subject" class="form-control">
	<?php $sub=mysql_query("select subject_id, subject_description from subject"); 
	while($subject=mysql_fetch_array($sub))
	{
	?>
      <option <?php if($datateach['subject']==$subject['subject_id']) echo "selected=selected"; ?> value=<?php echo $subject['subject_id']; ?> ><?php echo $subject['subject_description']; ?></option>
	<?php } ?>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">

  <div class="col-md-10">
  <input id="institute" name="upd_institute" placeholder="Institute" value=<?php echo $datateach['institute']; ?> class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">

  <div class="col-md-10">
    <input id="password" name="upd_password" placeholder="Password" class="form-control input-md" required="" value=<?php echo $datateach['userpass']; ?> type="password">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">

  <div class="col-md-10">
    <button id="addnow" name="update" class="btn btn-info">Update Record</button>
	  <button id="reset" name="cancel" class="btn btn-inverse">Cancel</button>
  
  </div>
</div>

</fieldset>
</form>

 <?php
 if(isset($_POST['cancel']))
 {
	// header("location:teacher-page.php?qry=list_std_teacher"); 
?>
<script>
window.location.href = "teacher-page.php?qry=list_std_teacher";
</script>
<?php
	 
 }
 if(isset($_POST['update']))
 {
	 // header("location:teacher-page.php?qry=list_std_teacher");
	 $upd_email=$_POST['upd_email'];
	 $upd_subject=$_POST['upd_subject'];
	 $upd_institute=$_POST['upd_institute'];
	 $upd_password=$_POST['upd_password'];
	$upd_teacher= mysql_query("update users set username='$upd_email',institute='$upd_institute',subject='$upd_subject',userpass='$upd_password' where userid='".$_GET['teach']."'");
	 
	?>
<script>
window.location.href = "teacher-page.php?qry=list_std_teacher";
</script>
<?php	
		
	 
 }
 
}
if(isset($_GET['std']))
{
	$selstd=mysql_query("select username,userpass,institute,reg_no from users where userid='".$_GET['std']."'");
 
 $datastd=mysql_fetch_array($selstd);
 ?>
    <div class="container">
 <form method="post">
   <h2>Update Students Record</h2>

 <div class="form-group">

  <div class="col-md-10">
  <input id="std_email" name="std_email"  class="form-control input-md" required="" value=<?php echo $datastd['username']; ?> type="email">
    
  </div>
</div>

</br></br>
 <div class="form-group">

  <div class="col-md-10">
  <input id="std_regno" name="std_regno"  class="form-control input-md" required="" value=<?php echo $datastd['reg_no']; ?> type="text">
    
  </div>
</div>

</br></br>
 <div class="form-group">

  <div class="col-md-10">
  <input id="std_institute" name="std_institute"  class="form-control input-md" required="" value=<?php echo $datastd['institute']; ?> type="text">
    
  </div>
</div>

</br></br>
<div class="form-group">

  <div class="col-md-10">
  <input id="std_password" name="std_password"  class="form-control input-md" required="" value=<?php echo $datastd['userpass']; ?> type="password">
    
  </div>
</div>
</br></br>
<div class="form-group">

  <div class="col-md-10">
 <button id="addnow" name="upd_std" class="btn btn-info">Update Record</button>
	  <button id="reset" name="cancel" class="btn btn-inverse">Cancel</button>
    
  </div>
</div>


 </form>
 	  </div>
 <?php
 if(isset($_POST['cancel']))
 {
	// header("location:teacher-page.php?qry=list_students"); 
	?>
<script>
window.location.href = "teacher-page.php?qry=list_students";
</script>
<?php
	 
 }
  if(isset($_POST['upd_std']))
 {
	 		// header("location:teacher-page.php?qry=list_students");
	 $std_email=$_POST['std_email'];
	 $std_regno=$_POST['std_regno'];
	 $std_institute=$_POST['std_institute'];
	 $std_password=$_POST['std_password'];
	$upd_teacher= mysql_query("update users set username='$std_email',institute='$std_institute',reg_no='$std_regno',userpass='$std_password' where userid='".$_GET['std']."'");
	
	?>
<script>
window.location.href = "teacher-page.php?qry=list_students";
</script>
<?php	

	 
 }
}
 ?>