<?php
$url="localhost";
$username='root';
$password='';
$conn=mysqli_connect($url,$username,$password,"bank");
if(!$conn){
die('Could not Connect My Sql:' .mysql_error());
}
extract($_POST);
if(isset($submit1))
{
$rs=mysqli_query($conn,"select * from customers where id='$uname1' and password='$psw'");
if(mysqli_num_rows($rs)<1)
{
$found="N";
}
else
{
$_SESSION["login"]=$user_id;
}
}
if (isset($_SESSION["login"]))
{
	
header("Location: /bank/index.php");
exit;
}
?>