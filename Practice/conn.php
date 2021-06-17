<?php

$host="localhost";
$user="root";
$pass="";
$db="stu";

$conn=mysqli_connect($host,$user,$pass,$db);

if(!$conn)
{
	die("Could not connect: ".mysqli_connect_error);
}
#echo "connection successful.";

/*$q="create database stu";
if (mysqli_query($conn,$q))
{
	echo "database created successfully.";
}
else
{
	echo "Error".mysqli_error($conn);
}*/

/*$q="create table st(id INT AUTO_INCREMENT,name VARCHAR(20) NOT NULL,divs VARCHAR(3) NOT NULL,primary key(id) )";
if (mysqli_query($conn,$q))
{
	echo "table created successfully.";
}
else
{
	echo "Error".mysqli_error($conn);
}*/



?>