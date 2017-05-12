<?php
require('connection.php');

?>


  <body>

 <?php 
if(isset($_GET['teach']))
{
	$select=mysqli_query($user_conn, "select username,userpass from users where userid='".$_GET['teach']."'");
 
 $datateach=mysqli_fetch_array($select);
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
//	 $upd_subject=$_POST['upd_subject'];
//	 $upd_institute=$_POST['upd_institute'];
	 $upd_password=$_POST['upd_password'];
	$upd_teacher= mysqli_query($user_conn, "update users set username='$upd_email',userpass='$upd_password' where id='".$_GET['teach']."'");
	 
	?>
<script>
window.location.href = "teacher-page.php?qry=list_std_teacher";
</script>
<?php	
		
	 
 }
 
}
if(isset($_GET['std']))
{
	$selstd=mysqli_query($user_conn, "select username,userpass from users where userid='".$_GET['std']."'");
 
 $datastd=mysqli_fetch_array($selstd);
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
	 $std_password=$_POST['std_password'];
	$upd_teacher= mysqli_query($user_conn, "update users set username='$std_email', userpass='$std_password' where id='".$_GET['std']."'");
	
	?>
<script>
window.location.href = "teacher-page.php?qry=list_students";
</script>
<?php	

	 
 }
}
 ?>