
<?php
require('connection.php');
date_default_timezone_set('Asia/Kolkata');
$getsessionid=$_REQUEST['sessionid'];
echo "<input type=hidden value=$getsessionid id=pass_sess >";

 $id=mysql_query("select question_id from test_paper_questions where paper_id='".$_REQUEST['paperID']."' limit $_REQUEST[next],1");
	
	$paper_id=mysql_fetch_array($id);

	$ques=mysql_query("select question_desc,question_id from question_master where question_id='".$paper_id['question_id']."'");

	
	$question=mysql_fetch_array($ques);
	
	$choices=mysql_query("select correct_choice from choice_master where question_id='".$question['question_id']."'");
	$choice_arr=array();
	$count_arr=1;
	while($answers=mysql_fetch_array($choices))
	{
		 $choice_arr[$count_arr]=$answers['correct_choice'];
		 if($choice_arr[$count_arr]=="YES")
		 {
			 echo "<input type=hidden value='$count_arr' id='correct_ch_id'>";
		 }
		
		$count_arr++;
	}
	
	//print_r($choice_arr);
	?>
<input type="hidden" value=<?php echo $_REQUEST['next']+1; ?> id="ques_val">

<div class="well well-lg">
	<?php
	echo "Ques No ".(@$_REQUEST[next]+1).":- ".$question['question_desc'];
	?>
	</div>


		 <div class="list-group">
		
	<?php
	$choice=mysql_query("select choice_desc,choice_id from choice_master where question_id='".$question['question_id']."' limit 0,4");
	$ans=array();

	while($ch=mysql_fetch_array($choice))
	{
	
$ans[]= $ch['choice_desc'];  // make array of choices
	
	}
	$res=mysql_query("select ques,ans,status from test_result where ques='".($_REQUEST['next']+1)."' and sessionid='".$getsessionid."'");
	$show=mysql_fetch_array($res);
	
		?>
		<span class="list-group-item"><span  class="badge badges"><input <?php if($show['ans']==1) { ?> checked  <?php } ?> class="answer"  type="radio" name="options" value=1></span><?php echo $ans[0]; ?></span>
		<span class="list-group-item"><span  class="badge badges"><input  <?php if($show['ans']==2) { ?> checked  <?php } ?> class="answer"  type="radio" name="options" value=2></span><?php echo $ans[1]; ?></span>
		<span class="list-group-item"><span  class="badge badges"><input  <?php if($show['ans']==3) { ?> checked  <?php } ?> class="answer"  type="radio" name="options" value=3></span><?php echo $ans[2]; ?></span>
		<span class="list-group-item"><span  class="badge badges"><input  <?php if($show['ans']==4) { ?> checked  <?php } ?> class="answer"  type="radio" name="options" value=4></span><?php echo $ans[3]; ?></span>

		<?php
	
	if(isset($_REQUEST['Ques']))
	{

		mysql_query("update test_result set ans='".$_REQUEST['Ans']."', status='ok' where ques='".$_REQUEST['Ques']."' and sessionid='".$_REQUEST['Pass_sess']."'");
		echo $choice_arr[$_REQUEST['Ans']];
		if($_REQUEST['Correct_ch_id']==$_REQUEST['Ans'])
		{
			mysql_query("update test_result set correct_ans='correct' where ques='".$_REQUEST['Ques']."' and sessionid='".$_REQUEST['Pass_sess']."'");
		}
		else
		{
			mysql_query("update test_result set correct_ans='wrong' where ques='".$_REQUEST['Ques']."' and sessionid='".$_REQUEST['Pass_sess']."'");
		}
			
	}
	
	if(isset($_REQUEST['Ans_rew']))
	{
		mysql_query("update test_result set status='review' where ques='".$_REQUEST['Ans_rew']."' and sessionid='".$_REQUEST['Sess_id_pass']."'");
	}
	if(isset($_REQUEST['clear_val']))
	{
		mysql_query("update test_result set status='no answer',ans='0',correct_ans='' where ques='".$_REQUEST['clear_val']."' and sessionid='".$_REQUEST['Sess_id_pass']."'");
	}
	
	if(isset($_REQUEST['Sessionid_onsubmit']))
	{
		mysql_query("update test_taken set test_end_dtm='".date('Y-m-d h:i:sa')."' where session_id='".$_REQUEST['Sessionid_onsubmit']."'");
	}
	
	
	?>

	</div>



	<script>
	$(".answer").click(function(){
var ques_val=$("#ques_val").val();
var passsession=$("#pass_sess").val();
var correct_ch_id=$("#correct_ch_id").val();
var increment=ques_val-1;
	$("#bttn"+increment).attr("class","btn btn-info");

var ans_val=$(this).val();

$.post("test_paper_ajax.php",
{
	Ques:ques_val,
	Ans:ans_val,
	Pass_sess:passsession,
	Correct_ch_id:correct_ch_id
	
},
function(data,status){

	
});


	
	
	});

	</script>
	