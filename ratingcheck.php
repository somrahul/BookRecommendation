<?
session_start();
require_once('db.php');

$isbn=$_POST['isbn']; 
$rating=$_POST['ratingnumber'];
$userid=$_SESSION['uid'];


$sql="SELECT * FROM book_ratings WHERE isbn='$isbn' and userID='$userid' ";


$result=mysql_query($sql) or die(mysql_error());



$count=mysql_num_rows($result);


if($count==1){

if($rating==0)
{

$sqlupdate="DELETE FROM book_ratings WHERE isbn='$isbn' and userID='$userid' ";

mysql_query($sqlupdate);

}

else{

$sqlupdate="UPDATE book_ratings SET rating = '$rating' WHERE isbn='$isbn' and userID='$userid' ";

mysql_query($sqlupdate);  }



}
else {

if($rating!=0)

{
$sqlinsert="INSERT INTO book_ratings (userID,isbn,rating) VALUES ('$userid','$isbn','$rating')" ;

mysql_query($sqlinsert); }








}












?>