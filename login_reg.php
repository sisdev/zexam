<?php  
   include("connection.php");
?> 

<!-- Login modal code - Begin -->

<div class="container">

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
    <li><a data-toggle="tab" href="#register">Register</a></li>
    
  </ul>

  <div class="tab-content">
    <div id="log" class="tab-pane fade in active">
      <h3>Login</h3>
	  <form method="post" id="log_form">
     <p> <input id="Lemail" name="lemail" placeholder="Email ID" class="form-control input-md" required="required" type="text"></p>
	 <p> <input type="password"  id="Lpwd" name="lpass" class="form-control"  required=required placeholder="password"></p>
	 <p> <button id="loginbttn" name="login" class="btn btn-primary btn-block">Login</button></p>
	 <div id="errorlog"><a href="forget-pass.php">Forget Password.</a></div>
	 </form>
    </div>
    <div id="register" class="tab-pane fade">
      <h3>Register</h3>
	  <form method="post" id="reg_form">
	   <p> <input id="phone" name="rphone" placeholder="Phone Number" class="form-control input-md" required="" maxlength="10" type="text"></p>
      <p> <input type="email" id="email" name="remail" placeholder="Email ID" class="form-control input-md" required="" ></p>
	  <p> <input type="password" name="rpass1" class="form-control" id="pwd1" required=required placeholder="password"></p>
	 <p> <input type="password" name="rpass2" class="form-control" id="pwd2" required=required placeholder="Confirm password"></p>
	 <p> <button id="reg" name="reg" class="btn btn-primary btn-block">Register</button></p>
	<div id="error" ></div>
	 </form>
    </div>
    
  </div>
</div>

        </div>
        
      </div>
    </div>
  </div>
</div>
<SCRIPT type="text/javascript">

$(document).ready(function(){
	$("#email").focusout(function(){
		var username = $("#email").val();
		var msgbox = $("#error");
		var email_pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		
		if(username.length > 4){
			
			$("#error").html('<img src="images/loader.gif" align="absmiddle">&nbsp;Checking availability...');
			$.ajax({
				type: "POST",
				url: "reg_email_check_ajax.php",
				data: "remail="+ username,  
				success: function(msg){  
						if(msg == 'OK'){
							document.getElementById("error").style.display="block" ;
							//alert("After display");
							
			
						if(!email_pattern.test(username)){
							msgbox.html('<font color="#cc0000">Please enter valid email ID.</font>');
							$("#email").focus();
						}else{
							msgbox.html('<img src="images/available.png" align="absmiddle">');
						}
							
							
						}else{
							$("#email").removeClass("green");
							document.getElementById("error").style.display="block" ;
							msgbox.html(msg);
							$("#email").focus();
						}
					}
			});
		}else{
			
			document.getElementById("error").style.display="block" ;
			$("#error").html('<font color="#cc0000">Please enter atleast 5 letters.</font>');
			$("#email").focus();
		}
		return false;
	});
});
</SCRIPT>
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
				$("#pwd1").focus();
				return false;	
			}
			else if(pass1!=pass2)
			{
				$("#pwd2").attr("style","border:2px solid red");
				$("#error").html("<font color='red'>Password doesn't match please try again.</font>");
				$("#pwd2").focus();
				return false;
			}
			else
			{
				$("#pwd2").removeAttr("style");
				
				return true;
			}
		});	
	});

</script>

<!-- Login modal code - End -->

