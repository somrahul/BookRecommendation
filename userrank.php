<? session_start(); 
$pagecheck='user';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="copyright" content= "Copyright all by way to chef group, interface and interaction all by Guanyi Fu" />
<link rel="stylesheet" href="guanyif.css" type="text/css" />
<script src="JS/jquery.js" type="text/javascript"></script>
<script src="JS/guanyif.js" type="text/javascript"></script>
<script src="JS/jquery.raty.min.js" type="text/javascript"></script>

<style>
#newtitlestyle:hover{ text-decoration:underline;}
</style>



<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>homepage</title>

<? require_once("header.php"); 
?>



</head>
<body onload="$('.loadingcontainer').fadeOut(); ">


<div class="loadingcontainer">

<img src="img/loading.GIF" style="margin-top:60px" />

</div> 







<div class="userrankcontainer">

<div class="usernametitle">
<h1>
<? 
echo $row[2];


?>
</h1>
</div>


<div class="loginbutton" style=" padding:6px  4px; margin-left:30px; border:1px solid #CCCCCC; width:140px; font-size:12px; margin-top:28px; float:left; clear:none;  ">
<h2>Change Password?</h2>

</div>




<? 
$userid=$_SESSION['uid'];

$sql="SELECT * FROM book_ratings WHERE userID='$userid' ";


$result=mysql_query($sql) or die(mysql_error());


$count=mysql_num_rows($result);

if($count==0)
{ ?>

<h2 style="margin-top:30px; font-size:18px; color:#CCCCCC; float:left; clear:both;">You have not rated any book yet</h2>




<?

}

else
{


?>


<div style="width:100%; float:left; margin-top:20px; margin-bottom:10px; border-bottom:1px solid #CCCCCC; padding-bottom:10px;">

<img src="img/user2.png" style="float:left; width:40px; border-radius:3px"  />

<h2 style="float:left; font-size:18px; color:#666666; margin-top:5px; margin-left:15px;">See what you have rated here</h2>

</div>

<?

$bookisbn=array();

$ratingarray=array();

while($row = mysql_fetch_array($result))
{

array_push($bookisbn,$row['isbn']);

array_push($ratingarray,$row['rating']);

$isbn=$row['isbn'];

$userquery="select * from book_books where isbn=$isbn";

$recomresult = mysql_query($userquery);

$recomrow=mysql_fetch_row($recomresult);


?>


<div class="userrankbox">

<a href="http://www.isbnsearch.org/isbn/<? echo $recomrow[0];?>" target="_blank">
<img src="<? echo $recomrow[7]; ?>" class="userrankimag"/></a>


<a href="http://www.isbnsearch.org/isbn/<? echo $recomrow[0];?>" target="_blank">
<h1 class="userranktitle" style="color:#406FA3" id="newtitlestyle" ><? if($recomrow[1]!='')
echo $recomrow[1];
else 
echo 'Unknow Book Name'; ?></h1></a>


<h2 class="userranktitle" style="color:#999999; margin-top:20px; font-size:14px; "><? if($recomrow[2]!='')
echo $recomrow[2];
else 
echo 'Unknow Book Author'; ?></h2>
<h2 class="userranktitle" style="color:#999999; font-size:14px;"><? 
if($recomrow[3]!='')
echo $recomrow[3].', '.$recomrow[4];
else 
echo 'Unknow Book Year and Publisher';

 ?>
 </h2>
 
 
<div class="recommendationrate" id="userrating<? echo $recomrow[0] ?>" style="margin-left:10px; margin-top:40px;"></div>





</div>






<?
}

 } ?>

</div>



</body>
</html>





<script>


$(function() {

    function abso() {

        $('.userrankcontainer').css({
		
            width: $(window).width()-100
        });
		

		
		
		
		

    }

    $(window).resize(function() {
        abso();         
    });

    abso();
	
	
<? for($i=0;$i<$count;$i++){ ?>
	
	
$("#userrating<? echo $bookisbn[$i]; ?>").raty(
{
starHalf: 'star-halfnew.png',
starOff: 'star-offnew.png',
starOn : 'star-on-new.png',
cancel: true,
cancelPlace: 'right',
half    : true,
score:<? echo $ratingarray[$i]/2; ?>,

click:function(score, evt) {

var isbnnumber=$(this).attr('id').slice(10);

$('.loadingcontainer').show();


    $.ajax({
       type: "POST",
       url: 'ratingcheck.php',
       data: {
            isbn:isbnnumber,
			ratingnumber:score*2,
			
        },
       success: function(result)
     {			   
			location.reload(); 		   
							   
	
	  }   

	  
   });

       
	
  }
  
  
    

});	
	







<? } ?>
	
	
	
	
	

});











</script>


