<?php
include("connection.php");
error_reporting(1);
echo $request=$_REQUEST['send_val'];
mysqli_query($conn,"delete from test_paper where paper_id='$request'") or die(mysql_error());
?>