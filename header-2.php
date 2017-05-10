<?php
error_reporting(0);
session_start();
include("connection.php");
?>
 <!--<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script>-->
<!DOCTYPE html>
<html lang="en">
 <head>
 <title>Online Exam</title>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js" type="text/javascript">
</script>
 
 
  </head>
 <body>
<div class="container-fluid" style="background-color: #f8f8f8;">
 <div class="templatemo-top-menu">
            <div class="container">
                <!-- Static navbar -->
                <div class="navbar navbar-default" role="navigation" style="border:none;">
                    <div class="container">
                        <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                </button>
              <a href="#" class="navbar-brand"><img src="images/logo.png" alt="Sisoft Learning" title="Sisoft Learning" width="200" /></a>
                        </div><!--navbar-header-->
                        
                        <div class="navbar-collapse collapse" id="templatemo-nav-bar" style="border-color:#f8f8f8;">
                            <ul class="nav navbar-nav navbar-right" style="margin-top:16px;">
                                <li><a href="javascript:;"><span class="glyphicon glyphicon-envelope"> info@sisoft.in</span></a></li>
				                <li><a href="javascript:;"><span class="glyphicon glyphicon-earphone"> 09999-283-283</span></a></li>
							 <?php  
							 if(isset($_SESSION['login']))  {
								?>
								<li class="click"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								<?php echo $_SESSION['login']; ?> <span class="caret"></span></button>
								<ul class="dropdown-menu" role="menu">
								<!--<li><a href="mysisoft.php">My Sisoft</a></li>
								<li><a href="settings.php?setval=<?php echo $_SESSION['login']; ?>">Chage Password</a></li>-->
								<li><a href="index.php?session=1">Log out</a></li>
     
								</ul></li>
                                 <?php 																 
							 }
							 else
							 {
							 ?>
                                <li class="click"> <button  type="button"  id="loginBttn" <?php if(isset($_POST['login']) || isset($_POST['reg']) || isset($_SESSION['login'])) echo "style=display:none"; ?>  class="btn btn-info btn-md" data-toggle="modal" data-target="#login">Login</button></li>
								
								<?php 
							 }
								
							if(isset($_POST['login']) && empty($_SESSION['login']))
							{

                                    $lipadd = $_SERVER['REMOTE_ADDR'];
                                                                        

									$lemail=$_POST['lemail'];
									$lpass=$_POST['lpass'];

                                                                       
									
									$record=mysqli_query($user_conn, "select id, username,userpass, exam_role from users where username='$lemail' and userpass='$lpass' ");
									$name=mysqli_fetch_array($record);
									$count=mysqli_num_rows($record);
									if($count==1)
									{
										$_SESSION['login']=$name['username']; 
										$_SESSION['userphone'] = $name['userphone'] ;
										$_SESSION['userid'] = $name['id'] ;
										$_SESSION['email'] = $name['username'];
                                        $login_log_qry ="insert into user_login_log(username, userpass, login_dtm, login_ip,login_stat)values('$lemail','$lpass',  now(), '$lipadd','success')" ;
                                        mysqli_query($user_conn, $login_log_qry);
										header("location:teacher-page.php");

										?>
								<li class="click"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
									<?php echo $name['username']; ?> <span class="caret"></span></button>
									<ul class="dropdown-menu" role="menu">
									  <li><a href="mysisoft.php">My Sisoft</a></li>
									  <li><a href="settings.php?setval=<?php echo $name['username']; ?>">Chage Password</a></li>
									  <li><a href="index.php?session=1">Log out</a></li>
									 
									</ul></li>
										<?php
										
										
									}
									else
									{
                                                                        $login_log_qry ="insert into user_login_log(username, userpass, login_dtm, login_ip,login_stat)values('$lemail','$lpass',  now(), '$lipadd','failure')" ;
                                                                        mysqli_query($user_conn, $login_log_qry);

										?>
								 <li class="click"> <button  type="button"  id="loginBttn"  class="btn btn-info btn-md" data-toggle="modal" data-target="#login">Login</button></li>		
								 <script>
								$(document).ready(function(){

									$("#errorlog").prepend("<font color=red>Invalid username or password. try again</font></br>");
									 $("#loginBttn").trigger('click');
									 return false;
								});
									 </script>
										<?php
										
										
									}
									
								}

								?>

						<?php 
						if(isset($_POST['reg']))
						{
							$rphone = $_POST['rphone'];
							$remail=$_POST['remail'];
							$rpass1=$_POST['rpass1'];
							$ripadd = $_SERVER['REMOTE_ADDR'];
							
						/// NEED to VERIFY IF USER IS ALREADY REGISTERED ----	  
							$insert_user="insert into users (username,userphone,userpass, dtm_created,ip_created) values('$remail','$rphone','$rpass1',now(), '$ripadd')";
						//	echo $insert_user ;
							mysqli_query($user_conn, $insert_user);						
							$record=mysqli_query($user_conn, "select username,userphone from users where username='$remail' and userpass='$rpass1' ");
							$name=mysqli_fetch_array($record);
							$count=mysqli_num_rows($record);
							if($count==1)
							{
								$_SESSION['login']=$name['username']; 
								$_SESSION['userphone'] = $name['userphone'] ;
								header("location:teacher-page.php");
								?>
						<li class="click"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							<?php echo $name['username']; ?> <span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu">
							  <li><a href="mysisoft.php">My Sisoft</a></li>
							 <li><a href="settings.php?setval=<?php echo $name['username']; ?>">Change Password</a></li>
							  <li><a href="index.php?session=1">Log out</a></li>
							 
							</ul></li>
								<?php
								
								
							}
							
						}

						?>
								
                            </ul>
                        </div><!--/.nav-collapse -->
						
						
						
						
                    </div><!--/.container-->
                </div><!--/.navbar -->
            </div> <!-- /container -->
        </div>
</div>
</body>
</html>