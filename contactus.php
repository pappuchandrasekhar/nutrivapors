<?php include("includes/header.php");
session_start();
/*include("model/user.class.php");

if($_POST['submit']=="Login")
{
	userClass::checkMemberLogin();
}
*/



if($_POST['submit']=="Send")
{
	
	
	

						 $sel="Select * from tb_sitesettings";
						$rs=$callConfig->getRow($sel);
						$to=$rs->contactusmail;
						$subject = 'Contact Information :: Nutrivapors';
						$message="<table cellspacing='0' cellpadding='5'  align='center' width='100%' border='0' style='border:1px solid #CCCCCC; border-collapse:collapse; 	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>
			  <tr>
			  <td colspan='2' align='left' valign='top' style='background-color:#002868'><img src='http://aswin/nutrivapors/images/sitelogo_04.png' width='180' height='55'/></td>
			
			  </tr>
						  <td width='15%' height='23' align='left' valign='middle' colspan=2 ><strong>Contact Information:</strong></td>
						</tr>
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Name:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$_POST['name']."</td>
						</tr>
					
					   	<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Email:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$_POST['email']."</td>
						</tr>
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Subject:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$_POST['subject']."</td>
						</tr>
												
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Message:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$_POST['message']."</td>
						</tr>						
						  </table></td>
					  
				  </tr>
				  <tr>
					<td valign='top' colspan='2' align='left'>&nbsp;</td>
				  </tr>
				  <tr>
					<td valign='top' colspan='2' align='left'>&nbsp;</td>
				  </tr>
				 
				  <tr>
					<td valign='top' colspan='2' align='left'>Thank You<br />
					</tr>
					<tr>
					<td valign='top' colspan='2' align='left'>".$_POST['name']."</td>
				  </tr>
				</table>";
				
					  //$message; exit;
					
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					    $headers .= 'From:'.$_POST['email']. "\r\n";
						 $ok=mail($to, $subject, $message, $headers);
						
			if($ok!='')
			{
				
				header("Location:contactus.html?msg=Thanks for your comments");
			}
			else
			{
				header("Location:contactus.html?msg=Failed to send your contact information.Please try after 5 mints..");
			}

}






?>


















<script src="<?php echo SITEURL; ?>/js/jqvalidation/jquery.min.js"></script>
<script src="<?php echo SITEURL; ?>/js/jqvalidation/jquery.validate.js"></script>
<link rel="stylesheet" href="<?php echo SITEURL;?>/js/jqvalidation/screen.css" />
<script type="text/javascript">
jQuery.noConflict()(function ($) { 

 $(document).ready(function(){
   $("#contact").validate({   
    rules: {			   
		    name: "required",
			email_address: {
		   required: true,
		   email_address: true
		   },
		 
		   subject: "required",
		   message: "required",
		   captchacode: "required",
		  
		   },
    messages: 
	{
		name: "Please Enter your First Name.",
		email_address:
		{
			required:"Please Enter your Email.",
			email_address:"Please Enter Correct Email Format",
			
		},
		
		subject:"Please Enter your Subject",
		message:"Please Enter Message",
		captchacode:"Please Enter Captchacode",
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
                 <li><a href="<?=SITEURL?>/contactus.html">Contact Us</a></li>
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
              
             <?php if($_GET['msg']=="Thanks for your comments"){ ?> <div style="color:red;">Message Sent Sucessfully </div> <?php } else if($_GET['msg']=="Failed to send your contact information.Please try after 5 mints.."){ ?> <div style="color:red;">Message Sent Failed </div>   <?php } ?>
              
                    <h2>Contact Us</h2>
					<form name="form1" id="contact" method="post" action="" onsubmit="return validate()">
                  <ul class="loglis">
                   <li>
                     <div>Your Name(required):</div>
                     <input type="text" name="name" id="name">
                   </li>
                   <li>
                     <div>Your Email (required):</div>
                     <input type="text" name="email" id="email">
                   </li>
                     <li>
                     <div>Subject:</div>
                     <input type="text" name="subject" id="subject">
                   </li>
                  
				  <li>
				  <div>Message:</div>
				  <textarea name="message" id="message" ></textarea>
				  </li>
                  
                 
                  
                  
                  <li>
                  <div>Captcha Code:</div>
                  <input type="text" name="captchacode" />
                  </li>
				  <li>
                       <div style="width: 226px; float: left; height: 80px;padding: 5px;
background-color: #ffffff;border: #e6e6e6 solid 2px;-webkit-border-radius: 10px;-moz-border-radius: 10px; border-radius: 10px;">
      <img id="siimage" align="left" style="padding-right: 5px; border: 0; margin-top:-9px; )" src="captach/securimage_show.php?sid=<?php echo md5(time()) ?>" />
      </div>
 <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onClick="document.getElementById('siimage').src = 'captach/securimage_show.php?sid=' + Math.random(); return false"><img src="captach/refresh.gif" alt="Reload Image" border="0" onClick="this.blur()" align="bottom" /></a>
                       
                       </li>
                    <li>
                     <input type="submit" name="submit" value="Send">
                   </li>
                  </ul>
                  </form>
              </div>
              
               <div class="loginblright">
             <!--  <a href="#"> <img src="images/loginimg_03.jpg" alt="" class="res_images"></a>-->
			 <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d15201.068887174233!2d83.3034859!3d17.7320438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sSuite+No%3A505%2C+GVK+Plaza+Seethammapeta%2C+Visakhapatnam+Andhra+Pradesh%2C+India+-+530016!5e0!3m2!1sen!2sin!4v1409917056553" width="400" height="250" frameborder="0" style="border:0"></iframe>
			 
			 <?php
			 
			  $query="select * from tb_sitesettings";
			 $res=mysql_query($query);
			 $row=mysql_fetch_array($res);
			 //print_r($row);
			 ?>
			 
			 
			  <div class="clear_fix"></div> 
			 
			    <div>
                  <span class="spanmap"><a href="#"><img src="images/mapicons_92.png" alt=""></a></span>
                  <span class="persapns"><a href="#"><?php echo $row['address'];?></a></span>
                  <div class="clear_fix"></div>
                 </div>
               <div class="clear_fix"></div>
            <div>
                  <span class="spanmap" style="margin-top:10px;"><a href="#"><img src="images/mapicons_97.png" alt=""></a></span>
                  <span class="persapns"><a href="#">Email: <?php echo $row['email']?></a></span>
                  <div class="clear_fix"></div>
                </div>
				
				 <div>
                  <span class="spanmap" style="margin-top:5px;"><a href="#"><img src="images/mapicons_100.png" alt=""></a></span>
                  <span class="persapns"><a href="#">Phone:<?php echo $row['contact']?></a></span>
                  <div class="clear_fix"></div>
                </div>
			
			 
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