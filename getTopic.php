
      <select id="selectTopic" name="topicID">
	  <option value="0">Select Topic</option>
         <?php 
		 include("connection.php");
         $getData=$_REQUEST['q']; 
		 
			$arr=mysqli_query($conn, "select topic_id,topic_description from topic where subject_id=$getData");
			while($row=mysqli_fetch_array($arr))
			{
				echo "<option value=".$row["topic_id"].">".$row["topic_description"]."</option>";
			}
         ?>
		</select>
