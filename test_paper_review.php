<div class="container">
	<div class="row">
		<div class="col-sm-10">
			<table>
				<?php
					include("connection.php");
					$get_val=$_GET['test_attempt_id'];
				?>
				<a  href="test_paper_view_xml.php?mod=<?php echo $get_val; ?>" target="_blank">Generate XML</a><p>
					<?php
// $qry1 = "select T.*, R.*, Q.*, C.* from test_taken T, test_result R, question_master Q, choice_master C where T.test_id = R.testpaper_id AND R.ques_id = Q.question_id AND Q.question_id = C.question_id AND student_id='". $_SESSION['userid']."'"
					
					$qry1 = "select T.*, R.*, Q.* from test_taken T, test_result R, question_master Q where T.session_id=R.sessionid and R.ques_id = Q.question_id AND session_id='$get_val'" ;
					echo $qry1."<br/>" ;
					$qry = mysqli_query($conn,$qry1 );
					
					//$qry=mysqli_query($conn, "select C.question_id,Q.question_desc,C.question_id from test_paper T,test_paper_questions C,question_master Q where T.paper_id=C.paper_id and Q.question_id=C.question_id and T.paper_id='$get_val'");

					$count=1;

					while($val=mysqli_fetch_array($qry))
					{
						$ans_count=1;
						$get_final_ans=1;
						echo $count."-".$val['question_desc']."</br>";
						$ans_choice=$val['ans'] ;
						
						$options=mysqli_query($conn, "select choice_desc,correct_choice from choice_master where question_id='$val[question_id]' Order by choice_id");
						$choice_seq = 0 ;
						while($getop=mysqli_fetch_array($options))
						{
							$choice_seq+=1 ;
							if ($choice_seq == $ans_choice)
							{ if($getop['correct_choice']=='YES') {
						?>		
					  <span style="color:green;">			
					  <input type="radio" name=<?php echo $count; ?>  checked  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $getop['choice_desc']; ?> </br>
					  </span>			
							<?php
							} else { ?>
							
					  <span style="color:red;">			
					  <input type="radio" name=<?php echo $count; ?>  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $getop['choice_desc']; ?> </br>
					  </span>	
						<?php
								
								
							}

							}
					  else {
						  ?>
					  <input type="radio" name=<?php echo $count; ?>   >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $getop['choice_desc']; ?> </br>
					<?php
					  }
					  }
						  
						  
						?>
							

							<?php
							if($getop['correct_choice']=='YES')
								$get_final_ans=$ans_count;
							else
								$ans_count++;
						echo "<p>";
						$count++;

						}
						

					
					?>
			</table>
		</div>
	</div>
</div>