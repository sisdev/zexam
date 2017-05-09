<?php

session_start();
include 'connection.php';

?>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    
    $coursename=$_POST['coursename'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $user_name=$_POST['user_name'];

if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
     
        {
            
  //$target ="../../appdev/mobappdata/qpaper/"; // TARGET LOCATION ..
  $target ="appdev/mobappdata/qpaper/"; // TARGET LOCATION ..

    $target = $target . basename( $_FILES['userfile']['name']);
      
       

      $fileName = $_FILES['userfile']['name'];
      $tmpName  = $_FILES['userfile']['tmp_name'];
      $fileSize = $_FILES['userfile']['size'];
      $fileType = $_FILES['userfile']['type'];
     
      $fp      = fopen($tmpName, 'r');
      $content = fread($fp, filesize($tmpName));
      $content = addslashes($content);
      fclose($fp);


      move_uploaded_file($tmpName , "$target");

      echo '<script language="javascript">';
      echo 'alert("file successfully uploaded")';
      echo '</script>';

      if(!get_magic_quotes_gpc())
             {
            $fileName = addslashes($fileName);
             }
			date_default_timezone_set('Asia/Kolkata');
         
         //echo("File $fileName Successfully  uploaded");
    $query = "INSERT INTO assess_app_qp (course_name,file_name,file_location,upload_dtm,uploaded_by,upload_ip ) 
    VALUES('$coursename','$fileName', 'http://www.sisoft.in/appdev/mobappdata/qpaper/',now(),'$user_name','$ip')";

    mysql_query($query) or die('Error, query failed'); 

    echo "<br>File $fileName uploaded<br>";
 
    }


}
?>
 <a   href="teacher-page.php?qry=qp_form" > Back</a>
