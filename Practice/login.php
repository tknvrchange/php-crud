<!doctype html>
<?php
	require "conn.php";
	session_start();
	if($_POST)
	{
		$user=mysqli_real_escape_string($conn,$_POST['username']);
		$pass=mysqli_real_escape_string($conn,$_POST['password']);
		$q=mysqli_query($conn,"select *from st where name='{$user}' and pass='{$pass}'");
		$cnt=mysqli_num_rows($q);
		$row=mysqli_fetch_assoc($q);
		if($cnt>0)
		{
			$_SESSION['id']=$row['id'];
			$_SESSION['name']=$row['name'];
			header("location:index.php");
		}
		else
		{
			echo "<script>alert('Invalid Login Credits');</script>";
		}
	}
?>
<head>
	<title>Student Login</title>
</head>
<body>
	<form id="form1" method="post" enctype="multipart/form-data">
		<h1 align="center" style="margin-top:100px">Login</h1>
		<div align="center" style="margin-top:30px">
			<label>Username:</label>
			<input type="text" name="username" placeholder="Enter your Username">
		</div>
		<div align="center" style="margin-top:10px">
			<label>Password: </label>
			<input type="password" name="password" placeholder="Enter your Password">
			<br>
		</div>
		<div align="center" style="margin-top:20px">
			<button type=submit name=submit>Login</button>
		</div>
	</form>
</body>
