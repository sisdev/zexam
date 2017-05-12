<?php
require('connection.php');
session_start();	

/*
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
	
	$record=mysqli_query("select userid,username,userpass,role from users where username='$email' and userpass='$pass' ");
	$name=mysql_fetch_array($record);
	$count=mysql_num_rows($record);
	if($count==1)
	{	
		
	$_SESSION['userid']=$name['userid'];
	$_SESSION['email']=$name['username'];
	header("location:teacher-page.php");
		
	
	}
	else
	{
		$error="<font color=red>Email or Password incorrect!</font>";
		
	}
}
*/

if(isset($_GET['session']))
{
unset($_SESSION['login']);	
	session_destroy();
	header("location:index.php");
}
?>


<?php include('header-2.php'); ?>
<?php include('login_reg.php'); ?>

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
  


  <div class="container">
  	
  <div><h2 style="color:#0066CC; text-align:center;">Online Exam/Assessment System</h2></div>
  <div class="row">
  
	  <div class="col-sm-3"></div>
	  <div class="col-sm-6"><img src="images/login.jpg" class="img-responsive img-rounded"></img></div>
	  <div class="col-sm-3">
	    
		<a href="teacher-page.php">Exam - Home </a>
	   
	  </div>
 

  <?php echo @$error; ?>
      </div>
	  
    </div>
 

   

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
 
  
  
  
  </body>
  </html>