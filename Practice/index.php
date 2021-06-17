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
?>
<head>
	<title>Student</title>
	<script type="text/javascript">
		function deletes(id)
		{
			if(confirm('Sure To Remove This Record ?'))
			{
				window.location.href='index.php?did='+id;
			}
		}
	</script>
</head>
<body>
	<form id="form1" enctype="multipart/form-data">
		<div align="center" style="margin-top:20px">
			<br>
			<h1>Student Details</h1>

			<table border="1" height="100" width="900">
			
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Division</th>
					<th>Hobbies</th>
					<th>Password</th>
					<th>Gender</th>
					<th>Image</th>
					<th></th>
				</tr>
				
				
			<?php
			if(isset($_GET['did']))
			{
				$did=$_GET['did'];
				$q="delete from st where id='{$did}'";
				if(mysqli_query($conn,$q))
				{
					echo "<script>alert('record deleted successfully');window.location='index.php';</script>";
				}
			}
			$q="select * from st order by id desc";
			if($res=mysqli_query($conn,$q))
			{
				if(mysqli_num_rows($res) > 0)
				{
					while($row=mysqli_fetch_assoc($res))
					{		
							echo "<tr>";
							echo "<td align='center'>{$row['id']}</td>";
							echo "<td align='center'>{$row['name']}</td>";
							echo "<td align='center'>{$row['divs']}</td>";
							echo "<td align='center' width='150'>{$row['hobbies']}</td>";
							echo "<td align='center'>{$row['pass']}</td>";
							echo "<td align='center'>{$row['gender']}</td>";
							echo "<td align='center' width='100'><img style='height:50px;width:50px;' alt='no image found' src='{$row['image']}'></td>";
							echo "<td align='center'><a href='javascript:deletes({$row['id']})'>D | <a href='edit.php?eid={$row['id']}'>E</td>";
							echo "</tr>";
					}
				}
				else
				{
					echo "<tr><td align='center' colspan=3>could not found any records.</td></tr>";
				}
			}
			else
			{
				echo "Query Error: ".mysqli_error($conn);
			}
			?>
			</table>
			<br><a href="add.php"><input type="button"  value="Add new record" name="button"></a>
			<br><br><a href="logout.php"><input type="button"  value="Logout" name="button"></a>
		</div>
	</form>
</body>