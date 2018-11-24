<?php
ob_start();
session_start();
include('dbconfig.php');
include('administrator/includes/dbconnection.php');

include("models/user_class.php");
$userObj=new userClass();

if($_SESSION['frnt_mid']!='')
{
	header("Location:dashboard.php");
}

 if($_POST['Submit']=="Submit"){
	 
  $userObj->userRegistration($_POST);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buzz</title>
<link type="text/css" rel="stylesheet" href="<?=SITEURL?>/style.css" />
<script src="http://code.jquery.com/jquery-1.7.min.js"></script>
<script src="script.js"></script>
</head>
<body>
   <!--headder-->
      <?php include("includes/headder.php");?>
   <!--End headder-->
   
   <!--con-->
   
   <div class="conwapper">
     <div class="conwapperin">
        <!--homeheight-->
         
        <div class="homecon">
         <div class="productsthisyear" style="margin-left:370px;"> 
           Registration 
         </div>
          <div class="grayheadtext" style="margin-top:-43px;">
                    <a href="index.php"><img src="images/nlogin_20.png" alt=""/></a>
                    </div>
         
         <!--vidiosblog-->
           <div class="vidiosblog" style="margin-left:-60px;">
               <!--givevidio-->
                 <div class="givevidioblog">
                   
                 </div>
               <!--End givevidio-->
                <!--givevidio-->
                 <div class="givevidioblog2">
                  <?php if($_GET['msg']=='Failed'){?>
                 <div class='error' style="margin-top:11px; color:#9c1a0f; margin-bottom:20px;">User Registration failed, please enter correct details</div>
                <?php }else if($_GET['msg']=='Success'){?>
                <div class='error' style="margin-top:11px; color:#9c1a0f; margin-bottom:20px;">User Registration Success</div>
                <?php } else if($_GET['msg']=='Existed'){?>
                 <div class='error' style="margin-top:11px; color:#9c1a0f; margin-bottom:20px;">Email Id Already Existed</div>
                <?php }?>
 <style>
 .column
{
	
	position:relative;display:-moz-inline-stack;display:inline-block;vertical-align:middle;*vertical-align:auto;zoom:1;*display:inline;height:100%
}
.invalid {
	background:url(images/tickone_01.png) no-repeat 0 50%;
	padding-left:16px;
	line-height:16px;
	color:#7b7b7b;font-size:9px;
}
.valid {
	background:url(images/tick2_03.png) no-repeat 0 50%;
	padding-left:16px;
	line-height:16px;
	color:#29a907;font-size:9px;
}
 </style>               
   <script>
   function show_ctrls(str)
   {
	   if(str=='')
	   {
		  document.getElementById('u1').style.display='block'; 
		   document.getElementById('c1').style.display='none';
		   document.getElementById('c2').style.display='none';
		   $('#usrreg').css("height", "830");
	   }
	   if(str=='Company')
	   {
		   document.getElementById('u1').style.display='none'; 
		   document.getElementById('c1').style.display='block'; 
		      document.getElementById('c2').style.display='block';
		   $('#usrreg').css("height", "900");
	   }
	   if(str=='Customer')
	   {
		    document.getElementById('u1').style.display='block'; 
		   document.getElementById('c1').style.display='none';
		      document.getElementById('c2').style.display='none';
		   $('#usrreg').css("height", "830");
		   
	   }
	   
   }
   </script>             
               
                <form action="" id="myForm" name="myForm" method="post" onsubmit="return validateForm()">

                    <div class="givevidio" id='usrreg' style="height:830px;width:400px;" align="center">
                    
                      <ul class="homelist" style="float:none;">
                      
                       <li>
                          <select name="utype"  id="utype" onchange="show_ctrls(this.value)"  class="selct" style="width:240px;color:#666666; font-size:15px;font-family:'Conv_MyriadPro-Regular',Sans-Serif; ">
                          <option value="">Select</option>
                          <option value="Customer">Receive Products</option>
                          <option value="Company">Give Products </option>
                         
                   </select>
                        </li>
                         <li id="c1" style="display:none;">
                          <input type="text" class="username" name="c_name"  placeholder="Company name"/>
                        </li>
                       <li id="c2" style="display:none;">
                          <input type="text" class="username" name="contact_name"  placeholder="Contact name"/>
                        </li>
                       <li id="u1">
                          <input type="text" class="username" name="name"  placeholder="Full name"/>
                        </li>
                      
                         <li>
                          <input type="text" class="emailcss"  name="email"  placeholder="Email ID" value="<?=$_SESSION['email']?>"/>
                        </li>
                         <li>
                         <table width="300" style="padding-left:30px;"><tr><td>
                         <input type="password"  class="paswodt" id="txt_password" name="password" oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" autocomplete="off" placeholder="Password"	/>  </td><td>                    
                          <img src="images/password/error1.png" style="display:none;" id="err" />
                            <img src="images/password/success1.png" style="display:none;" id="success"/></td></tr></table>
                      <div  style="width:305px;" >
                   <div id="pswd_info" style="padding-left:20px;display:none;width:305px;" class="row password-strength"><br />
			    <div class="column">Please use:&nbsp;&nbsp;&nbsp;</div>
			   <div  class="column invalid" id="length">&nbsp;&nbsp;&nbsp;8 to 32 characters</div>&nbsp;&nbsp;&nbsp;
               
			   
                <div  class="column invalid" id="password-contain-numbers-special">&nbsp;&nbsp;&nbsp;Numbers</div>&nbsp;&nbsp;&nbsp;
                <?php /*?><div style="margin-left:-5px;" class="column invalid" id="password-special">&nbsp;&nbsp;&nbsp;Special character</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php */?>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <div style="margin-left:-10px;" class="column invalid" id="password-contain-mixed-case">&nbsp;&nbsp;&nbsp;Upper and lowercase letters</div>
                
			   
			  </div>
                 </div>
                   </li>
                         <li>
                       <table width="300" style="padding-left:30px;"><tr><td> <input type="password" class="paswodt"  id="txt_rpassword" name="cpassword" oncopy="return false" ondrag="return false" ondrop="return false" onpaste="return false" autocomplete="off"  placeholder="Confirm Password"/> 
                         
                         </td><td>
                        
                           <img src="images/error1.png" style="display:none;" id="err2" />
                            <img src="images/success1.png" style="display:none;" id="success2"/></td></tr></table>
                       <div  style="width:305px;clear:both;"  ></div>  </li>
                       
                         <!--<li>
                          <textarea name="address" placeholder="Address"  class="textarea"></textarea>
                         </li>-->
                         
                         
                         <li>
                          <input type="text" class="text_id1" name="address1"  placeholder="Address1"/>
                        </li>
                         
                          <li>
                          <input type="text" class="text_id1" name="address2"  placeholder="Address2"/>
                        </li>
                      
                         
                         <li>
                          <select name="country" id="country"  class="selct" style="width:240px;color:#666666;">
                          <option value="">Country</option>
                          <option value="india">india</option>
                          <option value="srilanka">srilanka</option>
                          <option value="australia">australia</option>
                          <option value="england">england</option>
                          <option value="newzeland">newzeland</option>
                   </select>
                        </li>
                        
                          <li>
                          <input type="text" class="text_id1" name="state"  placeholder="State"/>
                        </li>
                            <li>
                          <input type="text" class="text_id1" name="city"  placeholder="City"/>
                        </li>
                        <li>
                          <input type="text" class="text_id1" name="zipcode"  placeholder="ZipCode"/>
                        </li>
                         
                         
                         <li>
                          <input type="text" class="contactcss" name="contactno"  placeholder="Contact No"/>
                         </li>
                        <li>
                        <input type="hidden" name="Submit" value="Submit"/>
                         <input type="image" src="<?=SITEURL?>/images/sign_up_07.png" alt="" />
                        </li>
                 
                      </ul>
                      
                    </div> </form>
                    <div class="givevidioshadow" style="width:440px;padding-bottom:20px;" align="center" >
                    </div>
                   
                 </div>
               <!--End givevidio-->
               <!--givevidio-->
                 <div class="givevidioblog2">
                   
                 </div>
               <!--End givevidio-->
           </div>
         <!--End vidiosblog-->
         <!--ettext-->
           <div class="gettext" style="padding-bottom:20px;">
            <div>
              Get Free Products, Buzz a Little, Get Paid..<br />
              Insane, Right?
            </div>
           </div>
         <!--End ettext-->
         </div>
         <!--End homeheight-->
     </div>
   </div>
     <div class="clear">
      </div>
   <!--End con-->
   
   
   <!--footer-->
    <div class="footer">
      <?php include("includes/footer.php"); ?>
    </div>
   <!--End footer-->
</body>
</html>
<script type="text/javascript">
function validateForm()
{
	
	if(document.myForm.utype.value=='')
	{
		alert("Please select user type");
		document.myForm.utype.focus();
		return false;
	}
	
	
	if(document.myForm.utype.value=='Customer' && document.myForm.name.value=="")
	{
		alert("You must enter a name");
document.myForm.name.focus();
return false;	
	}
if(document.myForm.utype.value=='Company' && document.myForm.c_name.value=="")
	{
		alert("You must enter company name");
document.myForm.c_name.focus();
return false;	
	}
if(document.myForm.utype.value=='Company' && document.myForm.contact_name.value=="")
	{
		alert("You must enter contact person name");
document.myForm.contact_name.focus();
return false;	
	}
	
	 var a=document.myForm.email.value;
if(document.myForm.email.value=="")
{
alert("You must enter a email");
document.myForm.email.focus();
return false;	
}

var x=document.forms["myForm"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Please Enter valid e-mail address");
  return false;
  }
  
 var a=document.myForm.password.value;
if(document.myForm.password.value=="")
{
alert("You must enter a password");
document.myForm.password.focus();
return false;	
}
if(document.myForm.password.value!="" && document.myForm.password.value!=document.myForm.cpassword.value)
{
	
alert("You must enter a same password");
document.myForm.cpassword.focus();
return false;
	
}

  
  var b=document.myForm.address1.value;
  if(document.myForm.address1.value=="")
  {
	  alert("plaese enter address1:");
	  document.myForm.address1.focus();
	  return false;
  }
  
  

  
   var d=document.myForm.city.value;
  if(document.myForm.city.value=="")
  {
	  alert("plaese enter city:");
	  document.myForm.city.focus();
	  return false;
  }
  if(!isNaN(d))
	{
		alert("please enter only characters");
		document.myForm.city.focus();
		return false;
	}
	
	 var e=document.myForm.state.value;
  if(document.myForm.state.value=="")
  {
	  alert("plaese enter state:");
	  document.myForm.state.focus();
	  return false;
  }
  if(!isNaN(e))
	{
		alert("please enter only characters");
		document.myForm.state.focus();
		return false;
	}
  
  var f=document.myForm.country.value;
  if(document.myForm.country.value=="")
  {
	  alert("plaese select any one of these countries:");
	  document.myForm.country.focus();
	  return false;
  }
  
  
  var g=document.myForm.zipcode.value;
  if(document.myForm.zipcode.value=="")
  {
	  alert("plaese enter your ZipCode:");
	  document.myForm.zipcode.focus();
	  return false;
  }
  
  if(isNaN(g))
	{
		alert("please enter only numbers");
		document.myForm.zipcode.focus();
		return false;
	}
	if(g.length<5)
	{
		alert("ZipCOde should contain atleast 6 numbers");
		document.myForm.zipcode.focus();
		return false;
	}
  
  
  
  var contactno=document.myForm.contactno.value;
if(document.myForm.contactno.value=="")
{
alert("You must enter a contactno");
document.myForm.contactno.focus();
return false;	
}
if(isNaN(contactno))
	{
		alert("please enter only numbers");
		document.myForm.contactno.focus();
		return false;
	}
	
	if(contactno.length<10)
	{
		alert("phonenumber should contain atleast 10 numbers");
		document.myForm.zipcode.focus();
		return false;
	}
	
	
	
return true;
}
</script>
<script type="text/javascript">
function checkingEmailUnique(email)
{
	//alert(email);
	jQuery.ajax({
		type: "POST",
		url: "jquery_ajax_check_controls.php",
		data: "email="+email,
		success: function(msg){
			//alert(data);
			$("#email_check_value").val(msg);
		}
	});
}

</script>