<?php 
//error_reporting(1);
include("includes/header.php");


if($_POST['action']=="Signup")

{
	
	//echo "hai";exit;


//print_r($_POST);
# object oriented
$from = new DateTime($_POST['age']);
$to   = new DateTime(date("Y-m-d"));
 $year= $from->diff($to)->y; "\n";

# procedural
//echo $mm=date_diff(date_create($_POST['age']), date_create(date("Y-m-d")))->y, "\n";

	
    //print_r($_POST); exit;
	//userClass::userRegisteration($_POST,'login');
	if($year >= 18){
	
userClass::userRegistration($_POST);
}
else {
echo "<script> alert('You must be 18 years or older to purchase from this website');</script>";
}
		
}



?>







<script>
function checkingEmailUnique(eid)
{
	
	
	
	
	/*
	
	//alert('hai');exit;
	//alert(eid);
	jQuery.ajax({
		type: "POST",
		url: "jquery_ajax_check_controls.php",
		data: "q="+eid,
		success: function(msg){
			//alert(data);
			$("#email_check_value").val(msg);
		}
	});
*/


                         
					   alert(eid);
					   var xmlhttp;
						if (window.XMLHttpRequest)
						  {// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp=new XMLHttpRequest();
						  }
						else
						  {// code for IE6, IE5
						  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						  }
						xmlhttp.onreadystatechange=function()
						  {
						  if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
							document.getElementById("mydiv").innerHTML=xmlhttp.responseText;
							}
						  }
						  				       //alert(price2);
						xmlhttp.open("GET","ajax999.php?eid="+eid,true);
						xmlhttp.send()






}


function validate()
{

 var first_name=document.form1.first_name.value;
 if(first_name=='')
 {
	alert('Please enter your first name');
	document.form1.first_name.focus();
	return false;
 }
	
 	
	var lastname=document.form1.lastname.value;
 if(lastname=='')
 {
	alert('Please enter your last name');
	document.form1.lastname.focus();
	return false;
 }
	

var username=document.form1.username.value;
 if(username=='')
 {
	alert('Please enter your username');
	document.form1.username.focus();
	return false;
 }



	var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 	var email1=document.form1.email_address.value;
 if(!document.forms["form1"]["email_address"].value.match(emailRegEx))
 {
	alert('Please enter valid Email address.');
	document.form1.email_address.focus();
	return false;
 }

/*var data=$("#email_check_value").val();
//alert(data);
if(data==1)
{
	document.getElementById('msgdiv_email').innerHTML='Email Already Registered.Please Login with another emailid';
	document.form1.email_address.focus();
	
	
	return false;
}
else
{
	document.getElementById('msgdiv_email').innerHTML='';
	
	}
	*/
	var password=document.form1.password.value;
	if(password=='')
	{
	alert("please enter  password");
	document.form1.password.focus();
	return false;
	}
	
	var confpassword=document.form1.confpassword.value;
	if(confpassword=='')
	{
	alert("please enter confirm password");
	document.form1.confpassword.focus();
	return false;
	}
	
	
	var address=document.form1.address.value;
	if(address=='')
	{
	alert("please enter address");
	document.form1.address.focus();
	return false;
	}
	
	
	var city=document.form1.city.value;
	if(city=='')
	{
	alert("please enter City");
	document.form1.city.focus();
	return false;
	}
	
	var state=document.form1.state.value;
	if(state=='')
	{
	alert("please enter State");
	document.form1.state.focus();
	return false;
	}
	
	var zip=document.form1.zip.value;
	if(zip=='')
	{
	alert("please enter zip");
	document.form1.zip.focus();
	return false;
	}
	
	
	var tel=document.form1.phone.value;
	if(tel=='')
	{
	alert("please enter telephone");
	document.form1.phone.focus();
	return false;
	}
	
	 var genderM=document.form1.gender.value;
   

    if(genderM=='')
       {
            alert("You must select male or female");
            return false;
       }  
 
	
	var age=document.form1.age.value;
   

    if(age=='')
       {
            alert("You must select your age");
            return false;
       }   
 
 
 if(age.count<18)
       {
            alert("You Age should be more than 17");
            return false;
       }   
	 
	
	
	
	return true;
}



</script>






        <link rel='stylesheet' id='camera-css'  href='js/camera_silde/camera.css' type='text/css' media='all'> 
		<link type="text/css" rel="stylesheet" href="style.css">
        <script type='text/javascript' src='js/camera_silde/jquery.min.js'></script>
        <script type='text/javascript' src='js/camera_silde/jquery.mobile.customized.min.js'></script>
        <script type='text/javascript' src='js/camera_silde/jquery.easing.1.3.js'></script> 
        <script type='text/javascript' src='js/camera_silde/camera.min.js'></script> 
        <script>
			jQuery(function(){
			
				jQuery('#camera_wrap_1').camera({
				height: '487px',
				
				thumbnails: true
				});
				
				
			});
        </script>
  

  <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="<?=SITEURL?>/home.html">Home</a></li>
                <li><img src="images/aboutarow_03.png" alt=""></li>
                 <li><a href="<?=SITEURL?>/register.html">Register</a></li>
              </ul>
               <div class="clear_fix"></div>
          </div>
        </div>
        <div class="clear_fix"></div>
     <!--End bedgromms part-->
   
    <!--innerpagepart-->
       <div class="full_wrapper innerpart">
         <div class="site_container">
            <div class="concomimg">
              <div class="rigleft">
                    <h2>Register</h2>
					<form name="form1" id="form1" method="post" action="" onsubmit="return validate()">
                    <ul class="rigilis">
                      <li>
                       <span>First Name:</span><input type="text" name="first_name" >
                      </li>
                      <li>
                       <span>Last Name:</span><input type="text" name="lastname">
                      </li>
                       <li>
                       <span>User Name:</span><input type="text" name="username">
                      </li>
                       <li>
                       <span>Email Address:</span><input type="text" name="email_address" onchange="checkingEmailUnique(this.value)">
					   <span id="mydiv" style="color:red;margin-left:122px;"></span>
                      </li>
                      <li>
                       <span>Password</span><input type="password" name="password">
                      </li>
                      <li>
                       <span>Confirm Password:</span><input type="password" name="confpassword">
					   
                      </li>
					  
					  
					  <li>
                       <span>Address:</span><!--<input type="text" name="address" style="height:100px;">-->
					   <textarea name="address"></textarea>
                      </li>
					  
					  <li>
                       <span>City:</span><input type="text" name="city">
					   
                      </li>
					  
					  
					   <li>
                       <span>State:</span><input type="text" name="state">
					   
                      </li>
					  
					   <li>
                       <span>Zip:</span><input type="text" name="zip">
					   
                      </li>
					  
					  
					   <li>
                       <span>Telephone:</span><input type="text" name="phone">
					   
                      </li>
					  
					  
					  
					  
                      <li>
                        <span>Gender:</span><input type="radio" name="gender" value="male">&nbsp;&nbsp;&nbsp;&nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="female">&nbsp;&nbsp;&nbsp;&nbsp;Female
                      </li>
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
		<link rel="stylesheet" href="/resources/demos/style.css">
				 <script>
				$(function() {
				$( "#age" ).datepicker({ dateFormat: "mm-dd-yy"});
				
				});
				</script>
    				  
                       <li>
                       <span>Age</span>
	<input type="date" name="age" id="age" style="width:70%; height:40px; border:#b0b0b0 solid 1px; padding:0px 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; background:none; " >
					
					   
                      </li>
                      <li>
                        <input type="checkbox">&nbsp;&nbsp;&nbsp;&nbsp; 
						<?php  

       $query="select *  from tb_contentpages where page_id='5'";
       $contentlist2=$callConfig->getRow($query);
	   
	   //print_r($contentlist2);
	   //echo $contentlist2->page_id;
	   ?>
						
						
						<a href="<?=SITEURL?>/<?=seoClass::fURL('content.php?id='.$contentlist2->page_id)?>">I accept all the terms and conditions</a>
                      </li>
                      <li>
					  
					  				
                        <input type="submit" name="action" value="Signup"> 
												
						<input type="submit" value="Cancel" style="margin-left:15px; background:#8e8e8e;">
                      </li>
                    </ul></form>
                    <div class="clear_fix"></div>
              </div>
               <div class="rigright">
               <a href="#"> <img src="images/rigisterpage_03.jpg" alt="" class="res_images"></a>
               </div>
              <div class="clear_fix"></div> 
            </div>
            
         </div>
       </div>
       <div class="clear_fix"></div> 
    <!--End innerpagepart-->

   
   <!--clintblog-->
   <?php include("includes/clintblog.php")?> 
   <div class="clear_fix"></div> 
  <!--ENd clintblog-->
 


<?php include("includes/footer.php"); ?>