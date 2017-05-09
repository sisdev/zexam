<html>
<head>
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
  
  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  <div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login or Register</h4>
        </div>
        <div class="modal-body">
        <div class="container-fluid">
  
  <ul class="nav nav-tabs nav-justified">
    <li class="active"><a data-toggle="tab" href="#log">Login</a></li>
    <li><a data-toggle="tab" href="#reg">Register</a></li>
    
  </ul>

  <div class="tab-content">
    <div id="log" class="tab-pane fade in active">
      <h3>Login</h3>
	  <form method="post" id="log_form">
     <p> <input id="Lemail" name="lemail" placeholder="Email ID" class="form-control input-md" required="required" type="text"></p>
	 <p> <input type="password" name="lpass" class="form-control" id="Lpwd" required=required placeholder="password"></p>
	  <p> <input type="checkbox" id="remember" name="remember"> Remember me</p>
	 <p> <button id="loginbttn" name="login" class="btn btn-primary btn-block">Login</button></p>
	
	 <div id="errorlog"><a href="forget-pass.php">Forget Password.</a></div>
	 </form>
    </div>
    <div id="reg" class="tab-pane fade">
      <h3>Register</h3>
	  <form method="post" id="reg_form">
      <p> <input id="email" name="remail" placeholder="Email ID" class="form-control input-md" required="" type="text"></p>
	 <p> <input type="password" name="rpass1" class="form-control" id="pwd1" required=required placeholder="password"></p>
	 <p> <input type="password" name="rpass2" class="form-control" id="pwd2" required=required placeholder="Confirm password"></p>
	   <p>
	   <input type="radio" name="as" value="teacher">Teacher</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="radio" name="as" checked value="student">Student</input>
	   </p>
	 <p> <button id="reg" name="reg" class="btn btn-primary btn-block">Register</button></p>
  <div id="error"></div>
	 </form>
    </div>
    
  </div>
</div>

        </div>
        
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){

	//$("#errorlog").html("<font color=red>Invalid username or password. please try again..</font>");
	 //$("#loginBttn").trigger('click');
	
$("#pwd2").keyup(function(){
	
	var pass1=$("#pwd1").val();
	var pass2=$("#pwd2").val();
	if(pass1!=pass2)
	{
		$("#pwd2").attr("style","border:2px solid red");
	}
	else
	{
		
		$("#pwd2").removeAttr("style");
	}
	
	
});	

$("#reg_form").submit(function(){
	
	var pass1=$("#pwd1").val();
	var pass2=$("#pwd2").val();
	
	if(pass1.length < 6)
	{
	
	$("#error").html("<font color='red'>Password should be grater than 6 characters</font>");	
	return false;	
	}
	
	else if(pass1!=pass2)
	{
		$("#pwd2").attr("style","border:2px solid red");
		return false;
	}
	else
	{
		
		$("#pwd2").removeAttr("style");
		$("#error").text("");
		return true;
	}
	
	
});	
	
});

</script>

  
  </body>
  </html>