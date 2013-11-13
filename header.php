<?php require_once "db.php";?>

<div class="header">





<div class="logobox">
<a href="index.php"><img src="img/logo.png"  style="width:100px"/></a>

</div>


<? if($pagecheck=='home'){ ?>



<div class="headerbuttonselect" ><h2>Home</h2></div>

<a href="list.php"><div class="headerbutton" style="margin-left:-1px"><h2>Explore</h2></div></a>


<?  } 
else if($pagecheck=='list') {
?>

<a href="index.php"><div class="headerbutton" style="box-shadow:-1px 0px 0.2px #515151;"  ><h2>Home</h2></div></a>

<div class="headerbuttonselect"><h2>Explore</h2></div>


<?  }  


else if($pagecheck=='user')
{
?>



<a href="index.php"><div class="headerbutton" style="box-shadow:-1px 0px 0.2px #515151;"    ><h2>Home</h2></div></a>

<a href="list.php"><div class="headerbutton" style="margin-left:-1px"  ><h2>Explore</h2></div></a>


<? } ?>




<input class="searchbarbox" placeholder="Input What you want to search" style="width:450px"/> 






















<? if(isset($_SESSION['uid'])){ 

?>


<a href="logout.php"><div class="logoutbutton"><h2>Logout</h2></div></a>

<div class="loginname"><h2><? 

$userid=$_SESSION['uid'];

$sql="SELECT * FROM current_users WHERE id='$userid' ";

$result=mysql_query($sql);

$row =mysql_fetch_row($result);

echo  $row[2] ?></h2></div>

<a href="userrank.php"><img src="img/user2.png" class="loginpic" /></a>





<? } else { ?>


<div class="logoutbutton" style="margin-right:80px" onclick='signupshow()'><h2>Sign Up</h2></div>

<h2 style="float:right; font-size:13px; color:#999999; margin-left:15px; margin-right:15px; margin-top:18px;">Or</h2>


<div class="loginbutton" style="float:right; clear:none; margin-top:10px; width:60px;" onclick='loginshow()'><h2>Log In</h2></div>



<?  }  ?>





</div>




<div class="logincontainer">

<div class="loginbox">

<img src="img/login.png"  style="margin-top:20px;"/>
<h1 style="font-size:25px; color:#A95973; margin-bottom:20px ">Log In</h1>



<input class="loginputbox" placeholder="User Name" type="text"  style="border-radius:3px 3px 0px 0px" id="username" />

<input class="loginputbox"  placeholder="Password"   type="password" style="margin-top:-3px; border-radius:0px 0px 3px 3px"  id="password" />


<div class="loginbutton"   style=' border:1px solid #C1C1C1; width:365px; float:none; padding-top:8px; padding-bottom:8px; margin-top:6px;' id="logincheck" ><h2>Log In</h2></div>

<div class="loginerrormessage"><h2>It seems no accounts exists for this one</h2></div>


<img src="img/or.png">



<div class="logoutbutton"  style='width:350px;  padding-top:8px; padding-bottom:8px; margin-top:6px;  float:none; margin-left:50px;'  onclick='signupshow()' ><h2>Sign Up with Our Site</h2></div>





</div>




</div>







<div class="signupcontainer">

<div class="sigunupbox">
<img src="img/signup.png"  style="margin-top:20px; "/>

<h1 style="font-size:25px; color:#A95973; margin-bottom:20px ">Sign Up</h1>



<input class="loginputbox" placeholder="User Name you want to use *" type="text"  style="border-radius:3px 3px 0px 0px"  id="signupusername"  />


<input class="loginputbox"  placeholder="Your Password *"   type="password" style="margin-top:-3px; border-radius:0px 0px 0px 0px" id="signuppassword"  />


<input class="loginputbox"  placeholder="Confirm Password *"   type="password" style="margin-top:-3px; border-radius:0px 0px 3px 3px; background:#DBDBDB; color:#FFFFFF"  id="confirmpassword"  />



<h1 style="margin-top:20px; margin-bottom:10px; color:#999999; font-size:15px; margin-left:-230px;  ">Optional Information</h1>


<input class="loginputbox" placeholder="If it's OK, input your age here" type="text"  style="border-radius:3px 3px 0px 0px; background-color:#729AA6;"  id="optionalinput"   />

<input class="loginputbox"  placeholder="Do you mind put your location here?"   type="text" style="margin-top:-3px; border-radius:0px 0px 3px 3px; background-color:#729AA6;"    id="optionalinput"    />





<div class="signuperrormessage"><h2>It seems no accounts exists for this one</h2></div>



<div class="logoutbutton"  style='width:350px;  padding-top:8px; padding-bottom:8px; margin-top:6px;  float:none; margin-left:50px;'  id='createaccountbutton'  ><h2>Create Account</h2></div>


<img src="img/or2.png">


<div class="loginbutton"   style=' border:1px solid #C1C1C1; width:365px; float:none; padding-top:8px; padding-bottom:8px; margin-top:6px;'  onclick="loginshow()" ><h2>Log In</h2></div>





</div>



</div>














<script>


$(document).ready(function() {
  $('#logincheck').click(function() {

   $.ajax({
       type: "POST",
       url: 'logincheck.php',
       data: {
            username: $("#username").val(),
            password: $("#password").val()
        },
       success: function(result)
       {
	           if(result=='yes')
	             {  
				    location.reload(); 
				               }
	
	
	           else
	            {
				$('.loginerrormessage').fadeIn();
				
				setTimeout("$('.loginerrormessage').fadeOut()",3000);
				
				
				
				
				}
	  }
  
	   
   });
   

 });
 
 
 
 
 
 
 
 
 
 $("#createaccountbutton").click(function() {

   $.ajax({
       type: "POST",
       url: 'signup.php',
       data: {
            signupusername: $("#signupusername").val(),
            signuppassword: $("#signuppassword").val(),
			confirmpassword: $("#confirmpassword").val()
        },
       success: function(result)
       {
	           if(result=='yes')
	             {  
				    location.reload(); 
				               }
							   
				else
				{
				
				
				$('.signuperrormessage h2').text(result);
				
				$('.signuperrormessage').fadeIn();
				
				setTimeout("$('.signuperrormessage').fadeOut()",3000);
				
				
				}			   
							   
							   
	
	  }
  
	   
   });
   

 });
 
 
 
 
 
 
 
 
 
 
$('.logincontainer').click(function() {
 
 $(this).fadeOut();
 
 });
 
 


$('.loginbox').click(function( event ) {
  event.stopPropagation();
});




$('.signupcontainer').click(function() {
 
 $(this).fadeOut();
 
 });
 

$('.sigunupbox').click(function( event ) {
  event.stopPropagation();
});



 
 
});













function loginshow(){

$('.signupcontainer').fadeOut();


$('.logincontainer').fadeIn();



}



function signupshow(){

$('.logincontainer').fadeOut();

$('.signupcontainer').fadeIn();

}



</script>



