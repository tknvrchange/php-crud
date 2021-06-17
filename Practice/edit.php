<!doctype html>
<?php
	session_start();
	if(!isset($_SESSION['id']))
	{
		header("location:login.php");
	}
?>
<?php
	require "conn.php";
	$eid=$_GET['eid'];
	if(!isset($_GET['eid']))
	{
		header("location:index.php");
	}
	$q=mysqli_query($conn,"select *from st where id='{$eid}'") or die(mysqli_error($conn));
	$row=mysqli_fetch_assoc($q);
	$h=explode(",",$row['hobbies']);
	if($_POST)
	{
		$id=mysqli_real_escape_string($conn,$_POST['id']);
		$name=mysqli_real_escape_string($conn,$_POST['username']);
		$pass=mysqli_real_escape_string($conn,$_POST['password']);
		$division=mysqli_real_escape_string($conn,$_POST['division']);
		$gender=mysqli_real_escape_string($conn,$_POST['gender']);
		$hobbies=$_POST['hobbies'];
		$chk="";
		foreach($hobbies as $h)
		{
			$chk.=$h.",";
		}
		
		if(empty($_FILES["photopath"]["name"]))
		{
			
			$q="update st set id='{$id}',name='{$name}',divs='{$division}',gender='{$gender}',pass='{$pass}',hobbies='{$chk}' where id='{$id}'";
			if(mysqli_query($conn,$q))
			{
				echo "<script>alert('Record updated.');window.location='index.php';</script>";
			}
			else{
				echo "error".mysqli_error($conn);
			}
			
		}
		else
		{
			$photopathq= "images/".$_FILES['photopath']['name'];
			$q="update st set id='{$id}',name='{$name}',divs='{$division}',gender='{$gender}',pass='{$pass}',hobbies='{$chk}',image='{$photopathq}' where id='{$id}'";
			if(mysqli_query($conn,$q))
			{
				move_uploaded_file($_FILES["photopath"]["tmp_name"],$photopathq);
				echo "<script>alert('Record updated successfully.');window.location='index.php';</script>";
			}
		}
	}
?>
<head>
	<title> Add Student</title>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<h1 align="center" style="margin-top:100px">Edit Student</h1>
		<input type="hidden" value="<?php echo $row['id']?>" name="id">
			<div align="center" style="margin-top:50px">
			<label>Name: </label>&nbsp;&nbsp;
			<input type="text" name="username" placeholder="Enter your Username" value="<?php echo $row['name']?>">
		</div>
		<div align="center" style="margin-top:10px">
			<label>Password:</label>&nbsp;
			<input type="text" name="password" placeholder="Enter your Password" value="<?php echo $row['pass']?>">
			<br>
		</div>
		<div align="center" style="margin-top:10px">
			<label>Gender: </label>
			<input type="radio" <?php if($row['gender']=="Male"){echo "checked";}?> name="gender" value="Male">Male &nbsp;
			<input type="radio" <?php if($row['gender']=="Female"){echo "checked";}?>  name="gender" value="Female">Female
			
			<br>
		</div>
		<div align="center" style="margin-top:10px">
			<label>Hobbies: </label>
			<input type="checkbox" <?php if(in_array("Cricket",$h)){echo "checked";}?> name="hobbies[]" value="Cricket">Cricket &nbsp;
			<input type="checkbox" <?php if(in_array("Chess",$h)){echo "checked";}?> name="hobbies[]" value="Chess">Chess
			<input type="checkbox" <?php if(in_array("Football",$h)){echo "checked";}?> name="hobbies[]" value="Football">Football
			<input type="checkbox" <?php if(in_array("Hockey",$h)){echo "checked";}?> name="hobbies[]" value="Hockey">Hockey
			<br>
		</div>
		<div align="center" style="margin-top:10px">
			<label>Division: </label>
			<select name="division">
				<option <?php  if($row['divs']=="A"){echo "selected";}?> value="A">A</option>
				<option <?php  if($row['divs']=="B"){echo "selected";}?> value="B">B</option>
				<option <?php  if($row['divs']=="C"){echo "selected";}?> value="C">C</option>
			</select>
			<br>
		</div>
		<div align="center" style="margin-top:10px">
			<label>File: </label>
			<input type="file" multiple="multiple" name="photopath">
			<img src="<?php echo $row['image']?>" height="50px" width="50px">
			<br>
		</div>
		<div align="center" style="margin-top:30px">
			<button type="submit">Update</button>
		</div>
		<div align="center" style="margin-top:30px">
			<a href="index.php"><input type="button"  value="View" name="button"></a>
		</div>
	</form>
</body>
