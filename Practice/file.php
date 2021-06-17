
<html>
#Display:
<body>
	<?php
	echo "<td><a href='{$qrow['photopath']}'> <img style='height:150px;width:200px;' src='{$qrow['photopath']}'></a></td>";
	?>


#Add:
	<input type="file" multiple="multiple" name="photopath">
	
	
	<?php
	if($_POST)
	{
		$event_id= mysqli_real_escape_string($conn,$_POST['event_id']);
		$photopathq= "upload/".$_FILES['photopath']['name'];
    
		$q= mysqli_query($conn, "insert into tbl_event_image(event_id,photopath) values('{$event_id}','{$photopathq}')")or die(mysqli_error($conn));

		if($q)
		{
			$myfile = move_uploaded_file($_FILES['photopath']['tmp_name'],$photopathq);
			echo "<script>alert('Data inserted');</script>";
		}
	}
	?>
</body>
</html>