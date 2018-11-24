<?php 

$banner=$bannerObj->getAllBannersList('','','','');
?>
   <link rel="stylesheet" type="text/css" href="js/silde/slideshow1.css" media="screen" />
<script type="text/javascript" src="js/silde/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/silde/jquery.nivo.slider.pack.js"></script>

  <div class="full_wrapper bannerpart" style="width:100%; height:400px">
  <div class="site_container">
  <section class="slider-wrapper">
          
            <?php if(count($banner)>0){
				$i=0;
			foreach($banner as $bannerlist){
			?>            
            
         <div id="slideshow" class="nivoSlider" style="height:300px;border:#FF0000 solid 1px">    
      	 <a class="nivo-imageLink" href="" style="width:300px; height:200px;border:#0033CC solid 1px;">         
         <ul>
         	<li style="background-color:#CCCCFF; border:1px solid;">		 
         		<?php echo $bannerlist->content ; ?>
         	</li>
          </ul><ul>  
         	<li style="margin-top:5px;height:200px; width:199px; border:#9933CC">
         		 <img src="uploads/banners/<?php echo $bannerlist->image; ?>" alt="slide-<?php echo $i;?>"  title=""/>
         	</li>
         </ul>
                  
         </a>
		 <?php $i++; } }?>
         </div>                   		
         
        </section>
        </div>
        </div>
        <script type="text/javascript">
$(document).ready(function() {
	$('#slideshow').nivoSlider();
});
</script>
    
  <?php /*?><div class="torteright">
                 <div class="toprated">
                  About Us 
                 </div>
                
           <section class="slider-wrapper">          
				<?php if(count($banner)>0){
                    $i=0;
                foreach($banner as $bannerlist){
                ?>            
              	<div id="slideshow1" style="border:#FF0000 solid 1px; height:110px;width:320px">                                
                <a class="nivo-imageLink" href="" style="width:300px; height:90px;border:#0033CC solid 1px;">         
                <p>
                    <i>            
                    <?php echo $bannerlist->content ; ?>
                    </i>                    
                </p>
                </a>
                
                    
				 <?php $i++; } }?>
               	</div>
           </section>
        
<script type="text/javascript">
$(document).ready(function() {
	$('#slideshow1').nivoSlider();
});
</script>
                                        
                 	<div class="jhonedoie">
                  	John Doe Account Manager
                 	</div>
                  
                <section class="slider-wrapper">          
				<?php if(count($banner)>0){
                    $i=0;
                foreach($banner as $bannerlist){
                ?> 
                    
                <div id="slideshow2" style="border:#FF0000 solid 1px; height:110px;width:320px">                                
                <a class="nivo-imageLink" href="" style="width:300px; height:90px;border:#0033CC solid 1px;">         
                                         
                    <div style="width:300px; height:200px">
                      <img src="uploads/banners/<?php echo $bannerlist->image; ?>" alt="slide-<?php echo $i;?>"  title="" width="300px" height="150px"/>
                    </div>
                </a>     
				 <?php $i++; } }?>
               	</div>
           </section>                 
   </div>        

<script type="text/javascript">
$(document).ready(function() {
	$('#slideshow2').nivoSlider();
});
</script><?php */?>