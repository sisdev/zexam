<?php
require('connection.php');

session_start();
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js" type="text/javascript"></script>
  <title>Assessment Web</title>
<style>
		.badges
		{
			background-color:white;
		}
		</style>
  </head>
<body>
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
    
        <li><a href="#"><?php 

 echo "USER ID : ".$_SESSION['userid'];
 ?></a></li>
  <li><a href="#"><?php 

 echo $_SESSION['email'];
 ?></a></li>
		 </ul>  
    </div>
  </div>
</nav>

<?php
$testid=$_REQUEST['paperID'];
$stdid=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$dtm=date('Y-m-d h:i:sa');
$testsession=$_REQUEST['sessionid'];
//$assign_dtm=mysql_query("select test_assign_dtm from test_assign where test_sessionid='".$testsession."'");
//$assigndtm=mysql_fetch_array($assign_dtm);

$repeat=mysqli_query($conn, "select * from test_taken where session_id='".$testsession."'");
$chk=mysqli_fetch_array($repeat);
if($chk>0)
{
	//header("location:teacher-page.php?qry=my_testpaper");
	?>
<script>
window.location.href = "teacher-page.php?qry=my_testpaper";
</script>
<?php
	exit;
}

mysqli_query($conn, "insert into test_taken (test_id,student_id,test_start_dtm,session_id) values('$testid','$stdid','$dtm','$testsession')");

 
?>
<input type="hidden" value=<?php echo $testsession ?> id="sessionid"/>
<input type="hidden" value=<?php echo $_GET['paperID']; ?> id="paperid">
<div class="progress progress-striped active" style="height:10px;">
  <div class="progress-bar" style="width:100%"></div>
</div><!--progress-bad-div-->


<div id="message">Time Left: </div>

<div class="container">
<div class="row">
<div class="col-sm-7">
	<div class="row">
		<div class="col-sm-12" id="question-desc"></div>
		<div class="col-sm-12">
			<ul class="pager">

  <li class="previous"><a  id="pullprev" href="javascript:;" >Previous</a></li>
  <li ><a  id="review" href="javascript:;" >Mark as Review</a></li>
  <li ><a  id="clear-resp" href="javascript:;" >Clear Response</a></li>

  <li class="next"><a  id="pullnext" href="javascript:;" >Next</a></li>
  </ul>
		</div>
	</div>
</div>
<div class="col-sm-1" ></div>
<div class="col-sm-4">
 <div class="panel panel-primary" style="background:#eae5e5;">
		  <?php
		  $duration=mysqli_query($conn, "select duration from test_paper where paper_id='".$_REQUEST['paperID']."'");
		  $due=mysqli_fetch_array($duration);
		   
		  
		  $count_que=mysqli_query($conn, "select question_id from test_paper_questions cp where cp.paper_id='".$_REQUEST['paperID']."' ");

		  ?>
		<input type="hidden" value=<?php echo $due['duration']; ?> class="duration">
		
      <div class="panel-heading">Quick jump  :  No of Questions <?php echo $no_of_ques=mysqli_num_rows($count_que);  ?> </div>
	  
	    <input type="hidden" value=<?php echo $no_of_ques; ?> id="total_counts">
      <div class="panel-body">
	<!--  <div class="row">-->
	  <?php 
  
	  $quick_count=1;


	  while($no_of_ques!=0) {
		  $queid=mysqli_fetch_array($count_que);
		  $ques_id=$queid['question_id'];
		  
		  mysqli_query($conn, "insert into test_result (ques,testpaper_id,ques_id,sessionid) values ('$quick_count','$testid','$ques_id','$testsession')");
		  
$rslt=mysqli_query($conn, "select ques,ans,status from test_result where ques='".$quick_count."'");
	$showst=mysqli_fetch_array($rslt);	
	  ?>
	<!--  <div class="col-sm-4"><a href="javascript:;" id=bttn<?php echo $quick_count-1; ?>  style="margin-top:15px"   data-index=<?php echo $quick_count; if($showst['status']=='ok') { ?> class="btn btn-info" <?php  } if($showst['status']=='review'){ ?> class="btn btn-warning" <?php } else {  ?> class="btn btn-default"  <?php } ?> role="button"><?php echo $quick_count; ?></a></div>  -->
	  <div class="col-sm-4"><a href="javascript:;" id=bttn<?php echo $quick_count-1; ?>  style="margin-top:15px"   data-index=<?php echo $quick_count; ?> class="btn btn-default"   role="button"><?php echo $quick_count; ?></a></div>

	  <?php  
	  
$no_of_ques--; $quick_count++; } 

	  ?>


<!--</div>-->	
	  </div><!--pannel body-->
	  
    </div><!--pannel primary-->
	
	<a   id="submit-test" href="javascript:;" style="background:#337ab7; padding:10px; color:#FFFFFF; border-radius:10px; border:none;">submit</a>
 <script>
 $("#submit-test").click(function(){
	
	 alert("Your Test paper submitted! Thank you");
window.location.href="teacher-page.php?qry=my_testpaper";
	  var sessionid_onsubmit=$("#sessionid").val();

	 $.post("test_paper_ajax.php",
	 {
		Sessionid_onsubmit:sessionid_onsubmit
	
		 
	 },
	 function(data,status){
	
	 });
	
 });
 </script>
	
	   
</div><!--col-sm-4-->

<!--</div>
-->
<!--row-1-->

<!--<div class="row" style="border:#000000  solid 1px;">-->

</div><!--row-2-->

</div><!--conatainer div-->
	
	<script>	
	$(document).ready(function(){
		var time=$(".duration").val();

		  var hour = Math.trunc(time/60);
  var min= time % 60;	
	var sec = 60;
	

var timer = setInterval(function() { 
var totalmin=(hour*60)+min;
var percent=(totalmin/time)*100;
 $('.progress-bar').attr("style", "width:"+percent +"%");
   $('#message').text(" Time Left:- "+hour+":"+min+":"+sec--);

   if (sec == -1) {
min--;
sec=60;

   }
if(min==-1)
{
	hour--;
	min=60;
}
if(hour==-1)
{
	alert("Time up! your Test paper submitted. Thank you");
	clearInterval(timer);
	 window.location.href="teacher-page.php?qry=my_testpaper";
	  var sessionid_onsubmit=$("#sessionid").val();

	 $.post("test_paper_ajax.php",
	 {
		Sessionid_onsubmit:sessionid_onsubmit
	
		 
	 },
	 function(data,status){
	
	 });
}
     
   
}, 1000);
	
	
	
		$("#clear-resp").click(function(){
			var ans_value=inc+1;
	 $(".answer").prop('checked', false);
	 $( "#bttn"+inc ).attr("class","btn btn-default");
	// var sess_id_pass=$("#sess_id_pass").val();
	 var sess_id_pass=$("#sessionid").val();
	 $.post("test_paper_ajax.php",
{
	
	clear_val:ans_value,
	Sess_id_pass:sess_id_pass
	
},
function(data,status){

	
});
	 
	 
		});
		
		$(".btn").click(function(){
		
		var datacontent=$(this).attr("data-index");
		
		inc=datacontent-1;
		ajax();
		hideme();
	});
	
	
	
	$("#review").click(function(){
		
		var ans_val=inc+1;
		 $( "#bttn"+inc ).attr("class","btn btn-warning");
		 var sess_id_pass=$("#sessionid").val();
		// inc++;
		// ajax();
		 
		 $.post("test_paper_ajax.php",
{
	
	Ans_rew:ans_val,
	Sess_id_pass:sess_id_pass
	
},
function(data,status){

	
});
		
	});
	
		
		var count_row=$("#total_counts").val();

	
		var inc=0;
		
		
		
				hideme();
		ajax();
		function ajax()
		{
			var paperid=$("#paperid").val();
		var session=$("#sessionid").val();
		$.post("test_paper_ajax.php",
		{
		paperID:paperid	,
		next:inc,
		sessionid:session
			
		},function(data,status){
			$("#question-desc").html(data);
			
			
			
		});
			
		}
		
		hideme();
		function hideme()
		{
		
			if(inc==0)
		{
			$("#pullprev").css("display","none");
			
		}
		if(inc!=0)
		{
			$("#pullprev").removeAttr('style');
		}
		if(inc==count_row-1)
		{
			$("#pullnext").css("display","none");
		}
		if(inc!=count_row-1)
		{
			$("#pullnext").removeAttr('style');
		}
		}
		
	
		
		$("#pullnext").click(function(){
			inc++;
				hideme();
		ajax();
		});
		
		
		$("#pullprev").click(function(){
			inc--;
				hideme();
		ajax();
		
	});
	

	
	 $(document).bind("contextmenu",function(e){

            e.preventDefault();
alert("sorry: right click is disabled");
            });

	
		
	});
	</script>
	
