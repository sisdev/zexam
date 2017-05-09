<!DOCTYPE html>
<html lang="en">
<head>
        <title>Forget password</title>
        <meta name="keywords" content="" />
		<meta name="description" content="" />
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        
        <!-- Google Web Font Embed -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css'>

        <!-- Custom styles for this template -->
        <link href="js/colorbox/colorbox.css"  rel='stylesheet' type='text/css'>
        <link href="css/style.css"  rel='stylesheet' type='text/css'>
		<link href="css/slide.css" rel="stylesheet" type="text/css">
        <link href="css/style-costum.css" rel="stylesheet" type="text/css">
       
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="images/icon.png">
        
    </head>   
<body>

     
        
        <?php 
	    include("db/db.php");
	   include("top-header.php");
	   
	   ?>
       <?php include('login_reg.php'); ?>
       
       <!-- lonin-->
  <div class="modal fade" id="lonin" role="dialog">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <form action="" method="post" id="form">
               
			<label for="user">Username</label>
			<input type="text" name="user" required placeholder="username" class="form-control">


			<label for="pass">Passowrd</label>
			<input type="text" name="pass" required placeholder="Password" class="form-control">

			<input type="submit" class="btn btn-orange" value="Submit" style="margin-top:10px">
			<label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label>
		  </form>
        </div>
     
      </div>
    </div>
  </div><!--lonin-->
       
<!--heading-->
<div class="container-fluid" style="background:#5bc0de; color:#fff">
<div class="container"><h2 style="padding:15px">Forget password</h2></div>
</div><!--heading-->       
                  
<div class="container-fluid well">   
 
      <div class="container">
      
            <div class="row">
           
            <div class="col-lg-3">
            <aside class="left-sidebar">
  forget password
	 
            </aside>

            </div><!--col-4-->
            
            <div class="col-lg-9">
			
			
			
			<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->


<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="email">Email ID:</label>  
  <div class="col-md-8">
  <input id="email" name="email" placeholder="" value="<?php 
			echo $_GET['setval'];
			
			?>" class="form-control input-md" type="text">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label" for="change"></label>
  <div class="col-md-8">
    <button id="change" name="change" class="btn btn-success btn-block">Submit</button>
   
 <?php 
 
	

?>
 </div>
</div>

</fieldset>
</form>

            </div><!--col-9-->
                
            </div><!--row-->
  </div><!--container-->
</div><!--well-->



<?php include("footer.php"); ?>

        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"  type="text/javascript"></script>
        <script src="js/stickUp.min.js"  type="text/javascript"></script>
        <script src="js/colorbox/jquery.colorbox-min.js"  type="text/javascript"></script>
        <script src="js/script.js"  type="text/javascript"></script>
		<script src="js/side-menu.js" type="text/javascript"></script>
</body>
</html>