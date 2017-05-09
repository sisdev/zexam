<div class="container">
<div class="row">      
<div class="col-sm-10">
  <table class="table table-striped">
    <thead>
	<tr>
	 <th>Uploaded XML Test Paper</th>
	 </tr>

    </thead>
    <tbody>
	<?php
    $path = realpath('appdev/mobappdata/qpaper/');
    $dir_handle = @opendir($path) or die("Unable to open $path");
    $directories = array();
    while ($file = readdir($dir_handle)) 
	{
		 if($file == '.' || $file == '..') continue;
		?>
      <tr>
        <td><?php echo $directories[] = $file; ?></td>
   
      </tr>
	  	<?php } 	
    closedir($dir_handle); ?>
    </tbody>
  </table>
</div>
</div>
</div>