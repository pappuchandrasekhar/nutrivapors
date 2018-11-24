<?php include("includes/header.php");

include("model/user.class.php");

if($_POST['submit']=="Login")
{
	$email=$_POST['email_address'];
	//echo "hai";exit;
	
	//print_r($_POST);exit;
	
	global $callConfig;

	//$queryman=$callConfig->selectQuery(TPREFIX.TBL_SITESETTINGS,'*','','','','');

	//$sitedata=$callConfig->getRow($queryman);

	
	
	 $query=$callConfig->selectQuery(TPREFIX.TBL_USERS_INFO,'username,password,email_address',"email_address='".$email."' ",'','','');

	$row=$callConfig->getRow($query);
	//print_r($row);exit;
	if($row->email_address!="" && $row->password!="")

	{

		$message="<table width='100%' border='0' style='border:1px solid #CCCCCC; border-collapse:collapse;font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#89806e; font-weight:bold;'>
       
         <tr>
				  <td colspan='2' align='left' valign='top'><img src='http://192.254.233.173/~rajeshch/nutrivapors/images/sitelogo_04.png' width='303' height='65'/></td>
				
				  </tr>
      
       
       <tr>
       <td >
        <table cellspacing='0' cellpadding='5'  align='center' width='100%' border='0' style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>
				  <tr>
					<td  colspan='2' align='left' valign='top'>Dear<strong> ".$row->username.",</strong></td>
				  </tr>
				  
				  <tr>
					<td valign='top' colspan='2' align='left'>
				Please find below the summary of your Nutrivapors Account Information:</td>
				  </tr>
				
				  <tr>
					<td valign='top' colspan='2' align='left'><table width='100%' border='1' cellspacing='0' cellpadding='0' style='border:1px solid #eeeeee; border-collapse:collapse;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>
						
					<tr>
					  <td width='15%' height='23' align='left' valign='middle' colspan=2 ><strong>Login Details:</strong></td>
					</tr>
					<tr>
					  <td width='15%' height='23' align='left' valign='middle'><strong>Name:</strong></td>
					  <td width='32%' height='23' align='left' valign='middle'>".$row->username."</td>
					</tr>
					<tr>
					  <td width='15%' height='23' align='left' valign='middle'><strong>Password:</strong></td>
					  <td width='32%' height='23' align='left' valign='middle'>".base64_decode(base64_decode($row->password))."</td>
					</tr>
					<tr>
					  <td width='15%' height='23' align='left' valign='middle'><strong>Email:</strong></td>
					  <td width='32%' height='23' align='left' valign='middle'>".$row->email_address."</td>
					</tr>
				  <tr>
					<td valign='top' colspan='2' align='left'>Please contact our customer support team at support@Nutrivapors.com if you have questions. </td>
				  </tr>
			
				</table>
       </td>
       </tr>
       <tr  >
         <td height='35' >
         
         <br >
         <br >
         Sincerely <br >
         Nutrivapors <br > <br >
		
         Where the pursuit of looking good ends in doing good! <br >
         support@Nutrivapors.com       <br >
         
         </td>
       </tr>
     
    </table>

";

		//echo $message;exit;
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";

		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		//$headers .= 'From: StrongerRX <info@themedia3.com>' . "\r\n";

		$headers .= 'From:Nutrivapors <info@Nutrivapors.com>' . "\r\n";

		if(mail($row->email_address,"Forget Password",$message,$headers))

		{

		  $callConfig->headerRedirect("login.php?ferr_frg=1");

		  exit;

		}

		else

		{

		   $callConfig->headerRedirect("login.php?ferr_frg=2");

		   exit;

		}

		

	}

	 else

	 {

	 	 $callConfig->headerRedirect("login.php?ferr_frg=3");	

		 exit;

	 }

	}


?>

<script type="text/javascript">
function loginfrom_validate()
{
	var email = document.loginform.email_address;
if (email.value == "")
{
window.alert("Please enter  e-mail address.");
email.focus();
return false;
}
if (email.value.indexOf("@", 0) < 0)
{
window.alert("Please enter a valid e-mail address.");
email.focus();
return false;
}
if (email.value.indexOf(".", 0) < 0)
{
window.alert("Please enter a valid e-mail address.");
email.focus();
return false;
}

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
                    <h2>Forget Password</h2>
					<form name="loginform" method="post" action="" onsubmit="return loginfrom_validate()">
                  <ul class="loglis">
                   <li>
                     <div>Email or Username:</div>
                     <input type="text" name="email_address" id="email_address">
                   </li>
                    
                    <li>
                     <input type="submit" name="submit" value="Login"><span><i><a href="#">Forgot username or password?</a></i></span>
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