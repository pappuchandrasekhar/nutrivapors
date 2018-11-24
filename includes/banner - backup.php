<?php 
$banner=$bannerObj->getAllBannersList('','','','');
?>
<link rel="stylesheet" type="text/css" href="<?=SITEURL?>/js/silde/slideshow.css" media="screen" />
<script type="text/javascript" src="<?=SITEURL?>/js/silde/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=SITEURL?>/js/silde/jquery.nivo.slider.pack.js"></script>

<!--<script src="jquery-1.8.2.min.js" type="text/javascript"></script>-->
<script src="<?=SITEURL?>/js/TSlider/jquery.bxslider.min.js" type="text/javascript"></script>
<link href="<?=SITEURL?>/js/TSlider/jquery.bxslider.css" rel="stylesheet" type="text/css" />
<!--<link href="js/TSlider/bootstrap.min.css" rel="stylesheet" type="text/css" />
-->

  <div class="full_wrapper bannerpart">
  <div class="site_container">
  <section class="slider-wrapper">

          <div id="slideshow" class="nivoSlider" > 
            <?php 
			if(count($banner)>0){
				$i=0;
			foreach($banner as $bannerlist){
			?>
			 <a class="nivo-imageLink" href="" style="width:100%;height:500px;border: 0px solid #0033CC">         
			 <img src="<?=SITEURL?>/uploads/banners/<?php echo $bannerlist->image; ?>" alt="slide-<?php echo $i;?>"  title="" class="slide_imgm" />
			 
			 <div class="ban_desc"> <h2  class="h2bann" style="font-size: 39px;
  color:#81c341;;font-family:Varela Round,Arial; text-transform: lowercase;font-weight:normal;"><?php echo $bannerlist->title; ?></h2> <p class="h2bann1"><?php echo $bannerlist->content ; ?></p> </div>
			 </a><?php $i++; } }else{ echo "<a href='#'><img src='images/sitebaner_23.jpg' alt='' class='res_images'></a>";}?>
         </div>
        </section>
        </div>
        </div>
<script type="text/javascript">
$(document).ready(function() {
	$('#slideshow').nivoSlider();
	
	 $('.bxslider').bxSlider({
			 mode: 'horizontal',
			 slideMargin: 3,
			 auto:true
     });
	 $('.bxslider_toprated').bxSlider({
	 	  mode: 'vertical',
		  minSlides: 2,
		  maxSlides: 2,
		 
		  slideWidth: 170,
		  slideMargin: 0
	});
});
</script>
  