<?php $query="select * from tb_sitesettings where id=1";
$sitesetting=$callConfig->getRow($query);
?> 


<?php 


	
		include("model/user.class.php");

         $userobj=new userClass();
	if($_POST['emasub']=="Submit")
	{
	
		userClass::emailInsert($_POST);
	}
	
?>

 
 <!--newsletter-->
     <div class="full_wrapper newsletter">
       <div class="site_container newsletterin">
         <div class="newslis">
            <div class="cuseheding">
             Customer Service
            </div>
            <ul class="checkorstatuslis">
             <!--<li><a href="#">Check Order Status</a></li>
             <li><a href="#">Shipping Options</a></li>
             <li><a href="#">Returns And Exchanges</a></li>
             <li><a href="#">Product Recal</a></li>
             <li><a href="#">Live chat support</a></li>
             <li><a href="#">Gift Vouchers</a></li>-->
			 
			 
			   <?php  

 
$contentlist=$bannerObj->getAllPages('','','','');?>
 <?php    if(count($contentlist)>0){
			  foreach($contentlist as $contentpage){?>
			 
           <li>
            
            <!--<a href="content.php?id=<?php echo $contentpage->page_id;?>">  <?php echo $contentpage->title; ?> </a>-->
            
              <a href="<?=SITEURL?>/<?=seoClass::fURL('content.php?id='.$contentpage->page_id)?>">  <?php echo $contentpage->title; ?> </a>
            
             
           
           </li>
         <?php  }}
 
 ?>
             
          <li><a href="<?=SITEURL?>/contactus.html">Contact Us</a></li>
            </ul>
         </div>
         <div class="newslis">
            <div class="cuseheding">
             My Account
            </div>
            <ul class="checkorstatuslis">
			<?php if($_SESSION['frnt_mid']!=''){?>
             <li><a href="#">My Account</a></li>
             <!--<li><a href="#">My Wishlist</a></li>-->
             <li><a href="#">Checkout</a> </li>
             <li><a href="logout.php">Logout</a></li>
			 <?php } else {?>
             <li><a href="<?=SITEURL?>/login.html">Login</a></li>
            <!-- <li><a href="#">My Wishlist</a></li>-->
             <li><a href="#">Checkout</a> </li>
             <li><a href="<?=SITEURL?>/register.html">Register</a></li>
			<?php } ?>
            </ul>
         </div>
         
         <div class="newslis">
            <div class="cuseheding">
             Why Buy From Us
            </div>
            <ul class="checkorstatuslis">
			
			
			 <?php  

 
$contentlist=$bannerObj->getPages('','','','');?>
 <?php    if(count($contentlist)>0){
			  foreach($contentlist as $contentpage){?>
			 
           <li>
            
           <!-- <a href="content.php?id=<?php echo $contentpage->page_id;?>">  <?php echo $contentpage->title; ?> </a>-->
            
            <a href=" <?=SITEURL?>/<?=seoClass::fURL('content.php?id='.$contentpage->page_id)?>">  <?php echo $contentpage->title; ?> </a>
           
            
           
           </li>
         <?php  }}
 
 ?>
			
			
			
			
			
             <!--<li><a href="#">Check Order Status</a></li>
             <li><a href="#">Shipping Options</a></li>
             <li><a href="#">Returns And Exchanges</a></li>
             <li><a href="#">Product Recal</a></li>
             <li><a href="#">Live chat support</a></li>
             <li><a href="#">Gift Vouchers</a></li>-->
            </ul>
         </div>
         
         <div class="newslis">
            <div class="cuseheding">
             News Letter Subscribe
            </div>
             
               <div>
               Get free product Updates & Specials !
              </div>
               <div class="emaisu">
			   <form name="sub" id="sub" method="post">
                 <input type="email" class="foinput" placeholder="Enter Email" name="email" required />
                 <input type="submit" class="subfootr" value="Submit" name="emasub">
               </form>
                 	
                 
                 
                 
                 
				  <div class="clear_fix"></div>
               </div>
              <div class="soicons">
               <a href="http://<?php echo $sitesetting->fblink;?>" target="_blank"><img src="<?=SITEURL?>/images/sosialicons_123.png" alt=""></a>
               <a href="http://<?php echo $sitesetting->twittlink;?>" target="_blank"><img src="<?=SITEURL?>/images/sosialicons_125.png" alt=""></a>
               <a href="http://<?php echo $sitesetting->ytlink;?>" target="_blank"><img src="<?=SITEURL?>/images/sosialicons_127.png" alt=""></a>
               <a href="http://<?php echo $sitesetting->plink;?>" target="_blank"><img src="<?=SITEURL?>/images/sosialicons_129.png" alt=""></a>
             
              <a href="http://<?php echo $sitesetting->plink;?>" target="_blank"><img src="<?=SITEURL?>/images/g.jpg" alt="" style="width:30px;height:29px;"></a>
             
              </div>
            
         </div>
         
         
         
         
          <div class="clear_fix"></div>
       </div>
     </div>
     <div class="clear_fix"></div> 
  <!--End newsletter-->
  
  <!--footer-->
     <div class="full_wrapper footer">
       <div class="site_container footerin">
         <div class="copwrilef">
          Copyright 2014 @ Nutrivapors.<br/>Designed & Developed by <a href="http://www.themedia3.com" target="_blank">Media3</a>
         </div>
         <div class="foleft">
           <a href="#"><img src="<?=SITEURL?>/images/paypacards_137.png" alt=""></a>
           <a href="#"><img src="<?=SITEURL?>/images/paypacards_139.png" alt=""></a>
           <a href="#"><img src="<?=SITEURL?>/images/paypacards_141.png" alt=""></a>
           <a href="#"><img src="<?=SITEURL?>/images/paypacards_143.png" alt=""></a>
		   
		   <a href="#"><img src="<?=SITEURL?>/images/icon_discover.png" alt="" width="42" height="30"></a>
		   <a href="#"><img src="<?=SITEURL?>/images/amex.png" alt="" width="42" height="30"></a>
		   
		   <a href="#"><img src="<?=SITEURL?>/images/mastercard.png" alt="" width="42" height="30"></a>
         </div>
         <div class="clear_fix"></div> 
       </div>
     </div>
  <!--End footer-->
</body>
</html>
