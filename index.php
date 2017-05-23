<?php
require('connection.php');
session_start();	

if(isset($_GET['session']))
{
unset($_SESSION['login']);	
	session_destroy();
	header("location:index.php");
}
?>

<html lang="en">
<head>
  <title>Online Exam/Assessment Web - Sisoft</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Online Exam/Assessment System by Sisoft">
  <meta name="author" content="Sisoft Learning">

  <link rel="stylesheet" href="css/bootstrap.css">
	
  <script  type="text/javascript" src="js/jquery-3.2.1.min.js"> </script>
  <script type="text/javascript"  src="js/bootstrap.min.js" ></script>
 
  </head>
  <body>
  
<?php include('header-2.php'); ?>
<?php include('login_reg.php'); ?>


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