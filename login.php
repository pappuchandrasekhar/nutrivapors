<?php include("includes/header.php");

//include("model/user.class.php");

if($_POST['submit']=="Login")
{
	userClass::checkMemberLogin();
}

?>



<?php 

//echo $query="select * from tb_users_info"; 


?>

<script src="<?php echo SITEURL; ?>/jqvalidation/jquery.min.js"></script>
<script src="<?php echo SITEURL; ?>/jqvalidation/jquery.validate.js"></script>
<link rel="stylesheet" href="<?php echo SITEURL;?>/jqvalidation/screen.css" />
<script type="text/javascript">
jQuery.noConflict()(function ($) { 
 $(document).ready(function(){
   $("#loginform").validate({   
    rules: {
		
		email: 
		{
			required: true,
			
		},
		password: "required"
	},
	messages: {
	
		email:
		{
			required:"Please Enter your Email.",
			
		},
		//required: "Please Enter your Email.",
		//email1:"Please Enter Correct Email Format",
		password:"Please Enter your Password."
	}
  });
 });
 });
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
                 <li><a href="<?=SITEURL?>/login.html">Login</a></li>
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
              <div class="loginleft">
              
                  <?php if($_GET['ferr_frg']=="1"){?>
                
                  <p style="font-size:15px;color:#093;">Password has been sent to your email address.Please check your email.</P>
                            <?php }?>
                            <?php if($_GET['ferr_frg']=="2"){?>
						<p style="font-size:15px;color:#F00;"> Mail sending failed, please try again or contact administrator</p>
                            <?php }?>
							<?php if($_GET['ferr_frg']=="3"){?>
						<p style="font-size:15px;color:#F00;">Your entered email ID not match with our database</p>
                        <?php }?>
                        
              
                    <h2>Login</h2>
					<form name="form1" method="post" action="" onsubmit="return validate()">
                  <ul class="loglis">
                   <li>
                     <div>Email or Username:</div>
                     <input type="text" name="email_address">
                   </li>
                    <li>
                     <div>Password</div>
                     <input type="password" name="password">
                   </li>
                    <li>
                     <input type="submit" name="submit" value="Login"><span><i><a href="forgetpassword.php">Forgot username or password?</a></i></span>
                   </li>
                  </ul></form>
              </div>
                <div class="loginblright">
               <a href="<?=SITEURL?>/register.html"><img src="images/loginimg_03.jpg" alt="" class="res_images"></a>
               </div>
              
              <!--<div class="loginleft">
                
               <div style=" border-bottom:thin dashed #CCC; margin-top:10px; margin-bottom:10px; "></div>
               
                    <h2>Continue as Guest</h2>
					<form name="form1" method="post" action="" onsubmit="return validate()">
                  <ul class="loglis">
                   <li>
                     <p>You are not required to have an account to shop with us. Click button below to proceed. </p>
                   </li>
                    <li>
                     <input type="submit" name="submit" value="Continue as Guest" style="width:32%;">
                   </li>
                  </ul></form>
              </div>-->
             
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