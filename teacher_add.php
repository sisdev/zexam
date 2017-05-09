<?php
require('connection.php');

if(isset($_POST['addnow']))
{
	 $email=$_POST['emailid'];
	 $subject=$_POST['subject'];
	 $inst=$_POST['institute'];
	 $pwd=$_POST['password'];
	 $role="teacher";
	 $query=mysql_query("insert into users (username,institute,subject,userpass,role) values ('$email','$inst','$subject','$pwd','$role') ");
	 
	 if($query==1)
	 {
		 ?>
<script>
alert("Teacher added successfully");
</script>		 
		 <?php
		 
	 }
}

?>

<div class="row">

<div class="col-sm-8">
<h2>Add Teacher</h2>

<form class="form-horizontal" method="post">
<fieldset>



<!-- Text input-->
<div class="form-group">

  <div class="col-md-10">
  <input id="emailid" name="emailid" placeholder="Email ID" class="form-control input-md" required="" type="email">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
 
  <div class="col-md-10">
    <select id="selectbasic" name="subject" class="form-control">
	<option>Select Subject</option>
	<?php $sub=mysql_query("select subject_id, subject_description from subject"); 
	while($subject=mysql_fetch_array($sub))
	{
	?>
      <option value=<?php echo $subject['subject_id']; ?>><?php echo $subject['subject_description']; ?></option>
	<?php } ?>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">

  <div class="col-md-10">
  <input id="institute" name="institute" placeholder="Institute" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">

  <div class="col-md-10">
    <input id="password" name="password" placeholder="Password" class="form-control input-md" required="" type="password">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">

  <div class="col-md-10">
    <button id="addnow" name="addnow" class="btn btn-info">Add Teacher</button>
    <button id="reset" type="reset" name="reset" class="btn btn-inverse">Reset</button>
  </div>
</div>

</fieldset>
</form>


</div>


</div>
