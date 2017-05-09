<?php
	error_reporting(0);
	session_start();
	include("connection.php");

	if(isset($_POST['remail'])){
		$remail = $_POST['remail'];
		$sql = mysqli_query($user_conn, "select username from users where username='$remail'");
		if(mysqli_num_rows($sql)){
			echo '<font size="2px" color="#cc0000"><STRONG>'.$remail.'</STRONG> is already in use.</font>';
		}else{
			echo 'OK';
		}
	}
?>