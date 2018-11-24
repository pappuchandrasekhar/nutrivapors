<?php 
//error_reporting(1);
include("includes/header.php");

include("model/user.class.php");

$userobj=new userClass();
if($_POST['action']=="Signup")

{
	
	//$dob=$_POST['age'];exit;
    //print_r($_POST); exit;
	//userClass::userRegisteration($_POST,'login');
userClass::userRegistration($_POST);
		
}



?>
<script src="js/jquery.js"></script>
<script>
function checkingEmailUnique(eid)
{
	//alert(email_address);
	jQuery.ajax({
		type: "POST",
		url: "jquery_ajax_check_controls.php",
		data: "q="+eid,
		success: function(msg){
			//alert(data);
			$("#email_check_value").val(msg);
		}
	});
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

var data=$("#email_check_value").val();
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
                       <span>Email Address:</span><input type="text" name="email_address">
                      </li>
                      <li>
                       <span>Password</span><input type="password" name="password">
                      </li>
                      <li>
                       <span>Confirm Password:</span><input type="password" name="confpassword">
                      </li>
                      <li>
                        <span>Gender:</span><input type="radio" name="gender" value="male">&nbsp;&nbsp;&nbsp;&nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="female">&nbsp;&nbsp;&nbsp;&nbsp;Female
                      </li>
                       <li>
                       <span>Age</span>
					   <select name="age" id="age" >
					   <option value="">select</option>
                       
                       <?php for($i=18;$i<100;$i++)
					   {?>
                       
                       <option value="<?php echo $i;?>"><?php echo $i;?></option>
                       
                       <?php } ?>
                       
                       
					   <!--<script language="javascript">
					   for(i=1; i<=50; i++)
					   {
						   
					  document.write("<option value="+i+">"+i+"</option>");
					 
					  
					   }
					   </script>-->
                       
                      <!-- <option value=""></option>-->
					   
                       </select>
					   
                      </li>
                      <li>
                        <input type="checkbox">&nbsp;&nbsp;&nbsp;&nbsp; <a href="#">I accept all the terms and conditions</a>
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