<?
session_start();
require_once('db.php');

$username=$_POST['signupusername']; 
$password=$_POST['signuppassword'];
$confirmpassword=$_POST['confirmpassword'];





if($password=='')
{echo 'Password should not be empty'; }

else if ($password!=$confirmpassword)
{
echo 'Please Confirm your password';
}




else
{

$sql="SELECT * FROM current_users WHERE username='$username'";

$result=mysql_query($sql) or die(mysql_error());

$count=mysql_num_rows($result);

if($count==1){
echo 'Sorry, it seems there are already user who use this username';
}

else
{


$sqlinsert="INSERT INTO current_users (username,password)
VALUES ('$username','$password')" ;

mysql_query($sqlinsert);


$sql="SELECT * FROM current_users WHERE username='$username'";

$result=mysql_query($sql) or die(mysql_error());

$row =mysql_fetch_row($result);

$_SESSION['uid']=$row[0];


$_SESSION['username']=$row[2];


echo 'yes';





}








}








?>