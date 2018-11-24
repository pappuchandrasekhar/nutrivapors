<?php 
include('model/banner.class.php');
$bannerObj= new bannerClass();
$banner=$bannerObj->getAllBannersList('','','','');
?>
  <link rel='stylesheet' id='camera-css'  href='js/camera_silde/camera.css' type='text/css' media='all'> 
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
        
    
    <!--bannerimages-->
       <div class="full_wrapper bannerpart">
       
         <div class=" camera_wrap camera_azure_skin" id="camera_wrap_1">
          <?php if(count($banner)>0){
			foreach($banner as $bannerlist){
			?>
            <div  data-src="uploads/banners/<?php echo $bannerlist->image; ?>" >
                <div class="camera_caption fadeFromBottom">
                   <h3 style="color:#000;"><?php echo $bannerlist->content?></h3>
                </div>
            </div>
            
           <?php }}?>
            
        </div>
      
         
       </div>
    <!--   <div class="site_container">
       
           <a href="#"><img src="images/sitebaner_23.jpg" alt="" class="res_images"></a>
         </div>-->
       <div class="clear_fix"></div> 
    <!--End bannerimages-->
   