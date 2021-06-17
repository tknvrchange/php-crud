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
	if($_POST)
	{
		$name=mysqli_real_escape_string($conn,$_POST['username']);
		$pass=mysqli_real_escape_string($conn,$_POST['password']);
		$gender=mysqli_real_escape_string($conn,$_POST['gender']);
		$division=mysqli_real_escape_string($conn,$_POST['division']);
		$hobbies=$_POST['hobbies'];
		$chk="";
		foreach($hobbies as $h)
		{
			$chk.=$h.",";
		}
		if(empty($_FILES["photopath"]["name"]))
		{
			
			$q="insert into st(name,gender,pass,divs,hobbies) values('{$name}','{$gender}','{$pass}','{$division}','{$chk}')";
			if(mysqli_query($conn,$q))
			{
				echo "<script>alert('Record Inserted.');window.location='index.php';</script>";
			}
			else{
				echo "error".mysqli_error($conn);
			}
			
		}
		else
		{
			$photopathq= "images/".$_FILES['photopath']['name'];
			$q="insert into st(name,gender,pass,divs,hobbies,image) values('{$name}','{$gender}','{$pass}','{$division}','{$chk}','{$photopathq}')";
			if(mysqli_query($conn,$q))
			{
				$myfile = move_uploaded_file($_FILES['photopath']['tmp_name'],$photopathq);
				echo "<script>alert('Record inserted successfully.');window.location='index.php'</script>";
			}
			else{
				echo "error".mysqli_error($conn);
			}
		}
	}
?>
	
<head>
	<title> Add Student</title>
	<script>
	function validateform()
	{  
		var pass=document.getElementById('password').value;  
		var name=document.getElementById('username').value;  
		var radios = document.getElementsByName("gender");
		var checkbox = document.getElementsByName("hobbies[]");
		var radioValid = false;
		var checkboxValid = false;
		var i = 0;
		
		while (!radioValid && i < radios.length) {
			if (radios[i].checked) 
				radioValid = true;
			i++;        
		}
		
		var i=0;
		while (!checkboxValid && i < checkbox.length) {
			if (checkbox[i].checked) 
				checkboxValid = true;
			i++;        
		}
		if (name =="" && pass =="" && !radioValid && !checkboxValid )
		{
			document.getElementById('usernamelabel').innerHTML="<span style='color:red'>Required</span>";
			document.getElementById('passwordlabel').innerHTML="<span style='color:red'>Required</span>";
			document.getElementById('radiolabel').innerHTML="<span style='color:red'>Required</span>";
			document.getElementById('checkboxlabel').innerHTML="<span style='color:red'>Required</span>";
			return false;
		}
		
			if(name==null || name=="" || name==" ")
			{
				document.getElementById('usernamelabel').innerHTML="<span style='color:red'>Required</span>";
				return false;
			}
			else
			{
				document.getElementById('usernamelabel').innerHTML="<span style='color:green'>OK</span>";
			}
			if(pass==null || pass=="" || pass==" ")
			{
				document.getElementById('passwordlabel').innerHTML="<span style='color:red'>Required</span>";
				return false;
			}
			else
			{
				document.getElementById('passwordlabel').innerHTML="<span style='color:green'>OK</span>";
			}
			if(!radioValid)
			{
				document.getElementById('radiolabel').innerHTML="<span style='color:red'>Required</span>";
				return false;
			}
			else
			{
				document.getElementById('radiolabel').innerHTML="<span style='color:green'>OK</span>";
			}
			if(!checkboxValid)
			{
				document.getElementById('checkboxlabel').innerHTML="<span style='color:red'>Required</span>";
				return false;
			}
			else
			{
				document.getElementById('checkboxlabel').innerHTML="<span style='color:green'>OK</span>";
			}
			
		
		return true;
		
	}  
	</script>	
</head>

<body>
	<form method="post" name="myForm"  enctype="multipart/form-data">
		<h1 align="center" style="margin-top:100px">Add Student</h1>
		<div align="center" style="margin-top:50px">
			<label>Name: </label>&nbsp;&nbsp;
			<input type="text" id="username" name="username"  placeholder="Enter your Username">&nbsp;&nbsp;
			<label id="usernamelabel"/>
		</div>
		<div align="center" style="margin-top:10px">
			<label>Password:</label>&nbsp;
			<input type="text" id="password" name="password"   placeholder="Enter your Password">&nbsp;&nbsp;
			<label style="color:red;" id="passwordlabel"/>
			<br>
		</div>
		<div align="center" style="margin-top:10px">
			<label>Division: </label>
			<input type="radio" name="gender" value="Male">Male &nbsp;
			<input type="radio" name="gender" value="Female">Female &nbsp;&nbsp;&nbsp;
			<label style="color:red;" id="radiolabel"/>
			<br>
		</div>
		<div align="center" style="margin-top:10px">
			<label>Hobbies: </label>
			<input type="checkbox" name="hobbies[]" value="Cricket">Cricket &nbsp;
			<input type="checkbox"  name="hobbies[]" value="Chess">Chess
			<input type="checkbox"  name="hobbies[]" value="Football">Football
			<input type="checkbox"  name="hobbies[]" value="Hockey">Hockey &nbsp;&nbsp;
			<label  id="checkboxlabel"/>
			<br>
		</div>
		<div align="center" style="margin-top:10px">
			<label>File: </label>
			<input type="file" multiple="multiple" name="photopath">
			<br>
		</div>
		<div align="center" style="margin-top:10px">
			<label>Division: </label>
			<select name="division">
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="C">C</option>
				
			</select>
			<br>
		</div>
		<div align="center" style="margin-top:30px">
			<button type="submit" onclick="return validateform();">Add</button>
		</div>
		<div align="center" style="margin-top:30px">
			<a href="index.php"><input type="button"  value="View" name="button"></a>
		</div>
	</form>
</body>
