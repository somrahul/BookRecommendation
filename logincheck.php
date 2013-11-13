<?
session_start();
require_once('db.php');

$username=$_POST['username']; 
$password=$_POST['password'];


$sql="SELECT * FROM current_users WHERE username='$username' and password='$password'";

$result=mysql_query($sql) or die(mysql_error());

$count=mysql_num_rows($result);


if($count==1){
$row =mysql_fetch_row($result);

echo 'yes';

$_SESSION['uid']=$row[0];


$_SESSION['username']=$row[2];



}
else {

echo 'no';

}









?>