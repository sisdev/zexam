<?php
require('connection.php');
session_start();	

if(isset($_POST['login']))
{
	$email=$_POST['email'];
	$pass=$_POST['pass'];
if(isset($_POST['remember']))
{
	$cookie_name = "user";
	$cookie_value = $email;
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}
	$user_query="select id,username,userpass,exam_role from users where username='$email' and userpass='$pass' ";
	echo $user_query;
	$record=mysqli_query($user_conn,$user_query);
	if (!$record) {
	echo $user_query ;	
    printf("Error: %s\n", mysqli_error($user_conn));
    exit();
   }

	$name=mysqli_fetch_array($record);
	$count=mysqli_num_rows($record);
	
	echo "Count:".$count ;
	
	if($count==1)
	{			
	$_SESSION['userid']=$name['id'];
	$_SESSION['email']=$name['username'];
	header("location:teacher-page.php");
	}
	else
	{
		$error="<font color=red>Email or Password incorrect!</font>";
		
	}
	
}

/*
if(isset($_GET['session']))
{
unset($_SESSION['login']);	
	session_destroy();
	header("location:index.php");
}
*/
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Online Exam/Assessment System by Sisoft">
  <meta name="author" content="Sisoft Learning">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js" type="text/javascript"></script>
  <title>Assessment Web</title>
  </head>
  <body>
  <nav class="navbar navbar-default"  >
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="images/logo.png" width="180px"></img></a>
    </div>
	<div class="col-sm-2"></div>
<div class="col-sm-8"><h2 style="position:absolute;" class="text-info">Online Exam/Assessment System</h2></div>
 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
    
        <li><a href="javascript:;"><span class="glyphicon glyphicon-envelope"> info@sisoft.in</span></a></li>
        <li><a href="javascript:;"><span class="glyphicon glyphicon-earphone"> 09999-283-283</span></a></li>
       
 
		 </ul>
      
     
    </div>
    
  </div>
</nav>
  <div class="container">
  <div class="row">
  <div class="col-sm-7"><img src="images/login.jpg" class="img-responsive img-rounded"></img></div>

 
  <div class="col-sm-5">
  
  <form class="form-horizontal" method="post">
  <fieldset>
<h1>Login</h1>
    <div class="form-group">
  
      <div >
        <input class="form-control" id="inputEmail" placeholder="Email" required name="email" <?php if(isset($_COOKIE['user'])) { ?> value=<?php echo $_COOKIE['user']; } ?> type="email">
      </div>
    </div>
    <div class="form-group">
  
      <div >
        <input class="form-control" id="inputPassword" placeholder="Password" required name="pass" type="password">
        <div class="checkbox">
          <label>
            <input name="remember" type="checkbox"> Rember me
          </label>
        </div>
      </div>
    </div>
   
    <div class="form-group">
      <div >
	        <button type="submit" class="btn btn-primary" name="login">Login</button>
        <button type="reset" class="btn btn-default">Reset</button>
  <?php echo @$error; ?>
      </div>
	  <div><font color="red">
	  </font></div>
    </div>
  </fieldset>
</form>
 
  </div>
   <fieldset>
    <legend>Our Android App</legend>

<a href="https://play.google.com/store/apps/details?id=in.sisoft.assessment.android" class="img" target="_blank"><img class="animation"  src="images/sisoftapp.png" width="50px" height="50px"></a></br>
  </fieldset>

<script>
$(document).ready(function(){
$(".animation").mouseover(function(){
 $(this).animate({
                      height:'100px',
                      width:'100px',
              borderRadius:'20px',
			
                    })
                     
                     
              
                            });

$(".animation").mouseout(function(){
   $(this).animate({
                      height:'50px',
                      width:'50px',
                    borderRadius:'1px'
                    })
                            });

});
</script>
 
  </div>
  </div>
  
  
  </body>
  </html>