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
        <th>Phone No.</th>
 
        <th>Modify</th>
      </tr>
    </thead>
    <tbody>
      
	  <?php 
	  $teachers=mysqli_query($user_conn, "select id,username, userphone from users where exam_role='student'");
	  while($tlist=mysqli_fetch_array($teachers))
	  {
	  ?>
	  <tr>
        <td><?php echo $tlist['username']; ?></td>
        <td><?php echo $tlist['userphone']; ?></td>
     
        <td><a href="teacher-page.php?qry=modify_std_tchr&std=<?php echo $tlist['userid']; ?>">Modify</a></td>
      </tr>
	  <?php } ?>
    </tbody>
  </table>
</div>
</div>
