<?php
require('connection.php');



if(isset($_POST['addnow']))
{
	 $email=$_POST['emailid'];
	 $pwd=$_POST['password'];
	 $role="teacher";
	 $query=mysqli_query($user_conn, "insert into users (username,userpass,exam_role) values ('$email','$pwd','$role') ");
	 
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
