<?php 
	include("includes/homeheader.php");
	global $callConfig;
     if($_POST['submit2']=='Update'){
	 
	 $quer="update tb_user_billingaddress set address='".$_POST['address']."' where user_id='".$_SESSION['front_userid']."'";
	$result=mysql_query($quer); 
	
	$callConfig->headerRedirect(SITEURL."/MyAccount"); 	
	
 	
	} ?>
<style>
textarea{ width:290px; height:100px;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px; padding:5px;background:none; border:#d8d8d8 solid 1px;}
</style>
  <div class="full_wapper">
   <div class="site_container">
     <ul class="bedgromslis">
      <li><a href="#">Home</a></li>
       <li><img src="images/abot_arow_10.png" alt=""></li>
      <li><a href="<?php echo SITEURL; ?>/MyAccount">Dashboard</a></li>
     </ul>
     <div class="clear_fix"></div>
     
   </div>
  </div>
  <div class="clear_fix"></div>
<!--End bedgroms-->


<!--products-->
<div class="products" style="padding-bottom:15px;">
	<div class="wrapper" style="padding-bottom:20px;">
		<h3>My Dashboard</h3>
         <div class="clear_fix"></div>
          <div class="dashbordinb">
               <!--left-->
                  <?php include "profile_image.php";?>
               
               <?php include "dash_profile.php";?>
                  <?php  $qq=mysql_query("select * from tb_user_billingaddress where user_id='".$_SESSION['front_userid']."'");
				           $res=mysql_fetch_array($qq); 
				          ?>
                                        
               
               <!--right-->
                <div class="rightreg">
                
                   <div class="logbobox">
               <div class="returningbox">
               My Profile
               </div>
              <form name="frm" id="frm" method="post">
			  
			   <ul style='padding:15px; margin-top:20px; margin-bottom:15px;'>
			    
             <li>
                    <span>Address :</span> &nbsp; &nbsp;<textarea name="address" id="address"><?php echo $res['address'];?></textarea>
                   </li>
				   
				   <li><a href="<?php echo SITEURL ?>/MyAccount">
				     <input type="submit" name="submit2" value="Update" style=" padding:11px 7px; background-color:#F38307; width:105px;  font-size: 14px; font-family: Arial, Helvetica, sans-serif; color:#FFFFFF; border:none; margin-left:160px; margin-top:11px;  " />
				   </a><a href="<?php echo SITEURL ?>/MyAccount"></a></li>
             </ul>
			 </form>
              </div>
        
                  
                
                 <div style="margin-top:25px;">
                   <?php include("facebook.php");  ?>
                 </div>
                </div>
                <!--ENd right-->
               <div class="clear_fix"></div>
             </div> 
	</div>
</div>
    <div class="clear_fix"></div>
<!--End products-->

  <!--testimonialsblog-->
 <?php include "testimonials.php";?>
    <!--ENd testimonialsblog-->
  
  <?php include ("includes/footer.php");?>