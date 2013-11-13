<? session_start(); 
$pagecheck='list';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="copyright" content= "Copyright all by way to chef group, interface and interaction all by Guanyi Fu" />
<link rel="stylesheet" href="guanyif.css" type="text/css" />
<script src="JS/jquery.js" type="text/javascript"></script>
<script src="JS/guanyif.js" type="text/javascript"></script>
<script src="JS/jquery.raty.min.js" type="text/javascript"></script>




<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>homepage</title>

<? require_once("header.php"); 
?>

<? require_once("recommendation.php"); ?>


</head>
<body onload="$('.loadingcontainer').fadeOut(); ">


<div class="loadingcontainer">

<img src="img/loading.GIF" style="margin-top:60px" />

</div> 


<?


$page=0;

if(isset($_GET['page']))
{$page=$_GET['page']; }
else { $page=1; }

$a=($page-1)*18;

$b=$page*18;




$query="select * from book_books LIMIT $a , $b";




$result = mysql_query($query);

$imageurl=array();

$imageurlsmall=array();

$bookname=array();

$author=array();

$year=array();

$publisher=array();

$isbn=array();


while($t_result = mysql_fetch_array($result)){

array_push($isbn,$t_result['isbn']);

array_push($imageurl,$t_result['imageLarge']);

array_push($bookname,$t_result['title']);

array_push($author,$t_result['author']);

array_push($year,$t_result['year']);

array_push($publisher,$t_result['publisher']);

array_push($imageurlsmall,$t_result['imageMedium']);


}


?>

<div class="boxcontainer">

<div class="listad"><h2>Find your favorite books in our website, and choose the best books for you :)</h2></div>


<? for($i=0;$i<=17;$i++)
{ ?>



<div class="bookbox">
<h1 class="booktitle"><? echo $bookname[$i]; ?></h1>

<a href="http://www.isbnsearch.org/isbn/<? echo $isbn[$i];?>" target="_blank">
<img src="<? echo $imageurl[$i]; ?>" class="bookpic"/></a>

<h2 class="bookauthor"><? echo $author[$i] ?></h2>

<h2 class="bookyear"><? echo $year[$i].', '.$publisher[$i] ?></h2>


<div class="bookratecontainer"></div>

<? if(isset($_SESSION['uid'])){  ?>
<div class="starrate"  id="rating<? echo $isbn[$i] ?>"></div>
<div class="ratingangel"></div>

<? } ?>





<div class="bookunderline"></div>

<div class="viewbutton"></div>



</div>


<? } ?>



<div class="pagechange">

<? if($page==1){ ?> 

<a href="list.php?page=<? echo $page+1; ?>"><div class="changepagebutton"><h1>Next Page</h1></div></a>


<? }
else { ?>

<div class="changepagebuttoncontainer">

 
<a href="list.php?page=<? echo $page-1; ?>" ><div class="changepagebuttonnew"  style="float:left; "  ><h1>Previous Page</h1></div></a>


<a href="list.php?page=<? echo $page+1; ?>" ><div class="changepagebuttonnew"  style="float:right; " ><h1>Next Page</h1></div></a>


</div>




<? } ?>






</div>






<div class="footer">
<h2>
Produced by Guanyi Fu, Weiqin Xie,Somesh Rahul<br />
More Feature will come soon
</h2>


</div>


</div>



<div class="recommendationsidbar">

<h1 class="recommendationtitle">Recommendations <span style="font-size:14px">From Us</span></h1>

<? if(isset($_SESSION['uid'])){  ?>

<h2 class="recommendationsubtitle">People who rate similar as you also like</h2>



<?



$booklist=array_keys($recommendedBooks);



$recomcount=0;

 for($a=0;$a<count($recommendedBooks);$a++)
{ 

$recomquery="select * from book_books where isbn=$booklist[$a]";

$recomresult = mysql_query($recomquery);

$checkcount=mysql_num_rows($recomresult);




if($checkcount==1){


$recomrow=mysql_fetch_row($recomresult);

$currentuid=$_SESSION['uid'];


$recomexistcheck=mysql_query("select * from book_ratings where userID=$currentuid and isbn=$recomrow[0]");



if(mysql_num_rows($recomexistcheck)<1)

{
?>

<div class="recommendationbox">

<a href="http://www.isbnsearch.org/isbn/<? echo $booklist[$a];?>" target="_blank"><img src="<? echo $recomrow[6]; ?>" class="reccomendationpic"/></a>


<a href="http://www.isbnsearch.org/isbn/<? echo $booklist[$a];?>" target="_blank"><h1 class="recommendationboxname"><? 
echo $recomrow[1];
 ?></h1></a>
<h2 class="recommendationboxauthor" > <?
echo $recomrow[2];


 ?></h2>

<h2 class="recommendationboxauthor"><? 
echo $recomrow[3].', '.$recomrow[4];



 ?></h2>
 

 <div class="recommendationrate" id="recomrating<? echo $booklist[$a]; ?>"  ></div>




</div>

<? 
$recomcount++;
if($recomcount==7)
{break;}
}



}



} 
}

else{

?>

<h2 style="margin-top:30px; height:900px; line-height:30px">
No Data Available<br />
Please <span style="color:#6B96CE" onclick="loginshow()">Log In</span> to see recommendation
</h2>



<? }  ?>



</div>











</body>
</html>





<script>


$(function() {

    function abso() {

        $('.boxcontainer').css({
            position: 'absolute',
            width: $(window).width()-360
        });
		
		
		$('.changepagebutton').css({
            marginLeft: ($(window).width()-380)/2
        });
		
		
		
		

    }

    $(window).resize(function() {
        abso();         
    });

    abso();
	
	
	
	
	
	

});


$(document).ready(function(){
<? for($i=0;$i<=17;$i++)
{ 

$isbnnumber=$isbn[$i];

$ratingnumber=2;



$currentuser=$_SESSION['uid'];


$query="select * from book_ratings where userID='$currentuser' and isbn='$isbn[$i]' ";  

$result=mysql_query($query) or die(mysql_error());

$count=mysql_num_rows($result);

if($count==1){
$row =mysql_fetch_row($result);

$ratingnumber=$row[2];


}
else {

$ratingnumber=0;

}


?>





$("#rating<? echo $isbn[$i]; ?>").raty(
{
starHalf: 'star-half.png',
half    : true,
score:<? echo $ratingnumber/2; ?>,
cancel: true,
cancelPlace: 'right',

click:function(score, evt) {

var isbnnumber=$(this).attr('id').slice(6);

$(".loadingcontainer").show();

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







$(".recommendationrate").raty({
starHalf: 'star-halfnew.png',
starOff: 'star-offnew.png',
starOn : 'star-on-new.png',
half    : true,

click:function(score, evt) {
var isbnnumber2=$(this).attr('id').slice(11);

$(".loadingcontainer").show();

 $.ajax({
       type: "POST",
       url: 'ratingcheck.php',
       data: {
            isbn:isbnnumber2,
			ratingnumber:score*2,
			
        },
       success: function(result)
     {			   
			location.reload(); 		   
							   
	
	  }   
	  
   });





 }


});








});








</script>


