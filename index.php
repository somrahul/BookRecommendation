<? session_start(); 
$pagecheck='home';


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





</head>
<body>

<div class="homepagebanner">

<div class="homepagetitle">
<h1>
Welcome to our Book Recommendation Site
</h1>
</div>



<div class="homepagetitle" style="margin-top:0px; font-size:25px;">
<h2>
We Introduce the best way to explore book
</h2>
</div>

<div class="homepagetitle" style="margin-top:0px; font-size:25px;">
<h2>
And provide you the easiest way to get
</h2>
</div>

<div class="homepagetitle" style="margin-top:0px; font-size:25px;">
<h2>
good recommendation
</h2>
</div>

<div class="changepagebutton" style="float:left; clear:both; margin-left:50px; margin-top:30px; width:180px; text-align:center; padding:10px  8px; border:1px solid #7C2341;" onclick='signupshow()' ><h2>Sign Up with Our Site</h2></div>


<div class="loginbutton" style="clear:none; padding:10px  8px; margin-left:10px;" onclick='loginshow()'><h2>Log In</h2></div>



</div>


<div class="homepageslide"></div>


<div class="center">

<div class="downpartpic">
<img src="img/book-below.png" />

</div>


<div class="downparttext">
<h1 style="font-size:23px">
We use the simple and smart way to give you recommendation
</h1>


<h2 style="font-size:18px; margin-top:30px;">
We use the data from the BookCrossing (BX) dataset, and based on that to give you the reommendation based on your behavior and other user's behaviour in our community
</h2>




<div class="loginbutton" style='margin-left:0px; border:1px solid #999999; width:260px;'><h2>Check how our alogrithm works</h2></div>




</div>







</div>






<div class="homefooter">
<h2>
Produced by Guanyi Fu, Weiqin Xie,Somesh Rahul<br />
More Feature will come soon
</h2>

</div>







</body>
</html>


<script>


$(function() {

    function abso() {

        $('.downparttext').css({
            width: $(window).width()*0.96-970
        });
		
		
		
		

    }

    $(window).resize(function() {
        abso();         
    });

    abso();
	
	
	
	
	
	

});




</script>