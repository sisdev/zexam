<?php
require('connection.php');



?>

<div class="row">

<div class="col-sm-8">
<center><h2>Teachers</h2></center>
 <table class="table table-striped">
    <thead>
      <tr>
        <th>Email</th>
        <th>Institute</th>
        <th>Subject</th>
        <th>Modify</th>
      </tr>
    </thead>
    <tbody>
      
	  <?php 
	  $teachers=mysqli_query($conn, "select userid,username,subject,institute from users where role='teacher'");
	  while($tlist=mysqli_fetch_array($teachers))
	  {
	  ?>
	  <tr>
        <td><?php echo $tlist['username']; ?></td>
        <td><?php echo $tlist['institute']; ?></td>
        <td><?php 
		
		$Subject=mysqli_query($conn, "select subject_description from subject where subject_id= '".$tlist['subject']."'");
		$Sub=mysqli_fetch_array($Subject);
		echo $Sub['subject_description'];
		?></td>
        <td><a href="teacher-page.php?qry=modify_std_tchr&teach=<?php echo $tlist['userid']; ?>">Modify</a></td>
      </tr>
	  <?php } ?>
    </tbody>
  </table>
</div>


</div>
