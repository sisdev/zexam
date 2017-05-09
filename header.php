 <nav class="navbar navbar-default"  >
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Assessment WebApp</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Our services</a></li>
        <li><a href="#">About us</a></li>
      
      <!--  
  <?php
include('connection.php');
  error_reporting(1); session_start(); if(isset($_SESSION['login'])) 
							 {
								 $record=mysql_query("select userid,username,userpass,as_a from users where username='$_SESSION[name]' and userpass='$_SESSION[pass]' ");
	$name=mysql_fetch_array($record);
	$_SESSION['userid']=$name['userid'];
								?>
<li class="click"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <?php echo $_SESSION['login']; ?> <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <?php if($name['as_a']=='student') { ?>
      <li><a href="index2.php">My Test paper</a></li>
	<?php } else {?>
	 <li><a href="assign_testpaper.php">Assign Testpaper</a></li>
	 <li><a href="test_paper.php">Create Test paper</a></li>
	<?php } ?>
     <li><a href="settings.php?setval=<?php echo $_SESSION['login']; ?>">Chage Password</a></li>
      <li><a href="index.php?session=1">Log out</a></li>
     
    </ul></li>
                                 <?php 								
								 
							 }
							 else
							 {
							 ?>
                                <li class="click"> <button  type="button"  id="loginBttn" <?php if(isset($_POST['login']) || isset($_POST['reg'])) echo "style=display:none"; ?>  class="btn btn-info btn-md" data-toggle="modal" data-target="#login">Login</button></li>
								
								<?php 
							 }
								
if(isset($_POST['login']))
{

	$lemail=$_POST['lemail'];
	$lpass=$_POST['lpass'];
	
	$record=mysql_query("select userid,username,userpass,as_a from users where username='$lemail' and userpass='$lpass' ");
	$name=mysql_fetch_array($record);
	$count=mysql_num_rows($record);
	if($count==1)
	{
		$_SESSION['login']=$name['username']; 
		$_SESSION['name']=$name['username']; 
		$_SESSION['userid']=$name['userid'];
		$_SESSION['pass']=$name['userpass']; 
		?>
<li class="click"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <?php echo $name['username']; ?> <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
	<?php if($name['as_a']=='student') { ?>
      <li><a href="index2.php">My Test paper</a></li>
	<?php } else {?>
	 <li><a href="assign_testpaper.php">Assign Testpaper</a></li>
	  <li><a href="test_paper.php">Create Test paper</a></li>
	<?php } ?>
      <li><a href="settings.php?setval=<?php echo $name['username']; ?>">Chage Password</a></li>
      <li><a href="index.php?session=1">Log out</a></li>
     
    </ul></li>
		<?php
		
		
	}
	else
	{
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

<?php if(isset($_POST['reg']))
{

	$remail=$_POST['remail'];
	  $rpass1=$_POST['rpass1'];
	  $as=$_POST['as'];
  mysql_query("insert into users (username,userpass,as_a) values('$remail','$rpass1','$as')");
	
	$record=mysql_query("select userid,username,userpass,as_a from users where username='$remail' and userpass='$rpass1' ");
	$name=mysql_fetch_array($record);
	$count=mysql_num_rows($record);
	if($count==1)
	{
		$_SESSION['login']=$name['username']; 
		$_SESSION['name']=$name['username']; 
		$_SESSION['userid']=$name['userid']; 
		$_SESSION['pass']=$name['userpass']; 
		?>
<li class="click"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <?php echo $name['username']; ?> <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
      <?php if($name['as_a']=='student') { ?>
      <li><a href="index2.php">My Test paper</a></li>
	<?php } else {?>
	 <li><a href="assign_testpaper.php">Assign Testpaper</a></li>
	  <li><a href="test_paper.php">Create Test paper</a></li>
	<?php } ?>
     <li><a href="settings.php?setval=<?php echo $name['username']; ?>">Chage Password</a></li>
      <li><a href="index.php?session=1">Log out</a></li>
     
    </ul></li>
		<?php
		
		
	}
	
}

?> -->
     
      </ul>
      
     
    </div>
  </div>
</nav>