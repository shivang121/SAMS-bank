<?php

$url="localhost";
$username='wordpress_b5';
$password='niIm75#1';
$conn=mysqli_connect($url,$username,$password,"wordpress_b3");if(!$conn){
die('Could not Connect My Sql:' .mysql_error());
}
//extract($_POST);
$submit1=$_POST['submit1'];
$uname1=$_POST['uname1'];
$psw=$_POST['psw1'];
if(isset($_POST['submit1']))
{

$rs=mysqli_query($conn,"select * from employee where id='$uname1' and password='$psw'");
if(mysqli_num_rows($rs)==0)
{
$found="N";
}
else
{
	session_start();
$_SESSION["login"]=$uname1;
}
}
if (isset($_SESSION["login"]))
{
	header("Location: employee.php");
exit;
}
else
{
	echo"record does not exist or invalid username/password";
}

?>
