<?php
require('connection.php');

if(isset($_POST['addnowstd']))
{
	 $email=$_POST['emailstd'];

	 $pwd=$_POST['pwdstd'];
	 $ins_std=$_POST['inst_std'];
	 $reg_no=$_POST['regno_std'];
	 $role="student";
	 $query=mysqli_query($user_conn, "insert into users (username,userpass, exam_role) values ('$email','$pwd','$role') ");
	 
	 if($query==1)
	 {
		 ?>
<script>
alert("Student added successfully");
</script>		 
		 <?php
		 
	 }
	
}
?>

<div class="row">



<div class="col-sm-8">
<h2>Add Student</h2>

<form class="form-horizontal" method="post">
<fieldset>



<!-- Text input-->
<div class="form-group">

  <div class="col-md-10">
  <input id="emailid" name="emailstd" placeholder="Email ID" class="form-control input-md" required="" type="email">
    
  </div>
</div>
<div class="form-group">

  <div class="col-md-10">
  <input id="inst_std" name="inst_std" placeholder="Institute name" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<div class="form-group">

  <div class="col-md-10">
  <input id="regno_std" name="regno_std" placeholder="Registration / Enrollment no." class="form-control input-md" required="" type="text">
    
  </div>
</div>


<!-- Text input-->


<!-- Password input-->
<div class="form-group">

  <div class="col-md-10">
    <input id="password" name="pwdstd" placeholder="Password" class="form-control input-md" required="" type="password">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">

  <div class="col-md-10">
    <button id="addnow" name="addnowstd" class="btn btn-info">Add Student</button>
    <button id="reset" type="reset" name="reset" class="btn btn-inverse">Reset</button>
  </div>
</div>

</fieldset>
</form>

</div>
</div>
