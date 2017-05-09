<?php
require('connection.php');


?>

<div class="row">



<div class="col-sm-8">
<center><h2>Students</h2></center>
 <table class="table table-striped">
    <thead>
      <tr>
        <th>Email</th>
        <th>Institute</th>
        <th>Registration No.</th>
 
        <th>Modify</th>
      </tr>
    </thead>
    <tbody>
      
	  <?php 
	  $teachers=mysql_query("select userid,username,institute,reg_no from users where role='student'");
	  while($tlist=mysql_fetch_array($teachers))
	  {
	  ?>
	  <tr>
        <td><?php echo $tlist['username']; ?></td>
        <td><?php echo $tlist['institute']; ?></td>
        <td><?php echo $tlist['reg_no']; ?></td>
     
        <td><a href="teacher-page.php?qry=modify_std_tchr&std=<?php echo $tlist['userid']; ?>">Modify</a></td>
      </tr>
	  <?php } ?>
    </tbody>
  </table>
</div>
</div>
