<?php 
$banner=$bannerObj->getAllBannersList('','','','');
?>

   <link rel="stylesheet" type="text/css" href="js/silde/slideshow1.css" media="screen" />
<!--<script type="text/javascript" src="js/silde/jquery-1.7.1.min.js"></script>
--><script type="text/javascript" src="js/silde/jquery.nivo.slider.pack.js"></script>



<?php /*?><?php 
$banner=$bannerObj->getAllBannersList('','','','');
 if($_SERVER['PHP_SELF']==='/nutrivapors/index.php'){?>

   <link rel="stylesheet" type="text/css" href="js/silde/slideshow1.css" media="screen" />
<script type="text/javascript" src="js/silde/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/silde/jquery.nivo.slider.pack.js"></script>
<?php } else {?>
  <link rel="stylesheet" type="text/css" href="js/silde/slideshow1.css" media="screen" />
<script type="text/javascript" src="js/silde/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/silde/jquery.nivo.slider.pack.js"></script>
<?php }?><?php */?>


  <div class="full_wrapper bannerpart">
  <div class="site_container">
  <section class="slider-wrapper">

          <div id="slideshow" class="nivoSlider1" > 
            <?php if(count($banner)>0){
				$i=0;
			foreach($banner as $bannerlist){
			?>
			
			
			 <a class="nivo-imageLink" href="" style="width:280px;height:372px;border: 0px solid #0033CC">         
			 <img src="uploads/banners/<?php echo $bannerlist->image; ?>" alt="slide-<?php echo $i;?>"  title=""/>
			 
			 <div class="ban_desc"> <h2><?php echo $bannerlist->title; ?></h2> <?php echo $bannerlist->content ; ?> </div>
			 </a><?php $i++; } }else{ echo "<a href='#'><img src='images/sitebaner_23.jpg' alt='' class='res_images'></a>";}?>
         </div>
          
        </section>
        </div>
        </div>
        <script type="text/javascript">
$(document).ready(function() {
	$('#slideshow').nivoSlider1();
});
</script>
  