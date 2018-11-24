<link rel="stylesheet" type="text/css" href="<?=SITEURL?>/js/silde/slideshow.css" media="screen" />
<script type="text/javascript" src="<?=SITEURL?>/js/silde/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=SITEURL?>/js/silde/jquery.nivo.slider.pack.js"></script>
<script src="<?=SITEURL?>/js/TSlider/jquery.bxslider.min.js" type="text/javascript"></script>

<link href="<?=SITEURL?>/js/TSlider/jquery.bxslider.css" rel="stylesheet" type="text/css" />


<style type="text/css">
blockquote
{
    clear: both;
    font-style: italic;
    margin-left: 10px;
    margin-right: 10px;
    padding: 10px 10px 0 50px;
    position: relative;
    quotes: none;
    
    border: 0px;
    font-size: 90%;
    line-height: 200%;
	
}
</style>
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
		  slideMargin: 10
	});
});
</script>
<!--Testimonials Start-->
 <div>
  <hr style="margin-left:34px;"/>
  <ul class="bxslider">
  
  <?php
  
  
  $query="select * from tb_testimonial";
  
  $res=mysql_query($query);
  while($row=mysql_fetch_array($res))
  { ?>
  
  
  
   <li>
    <blockquote><p class="testimo"><?php echo $row['description'];?></p>
    
    
    <p style="margin-left:-23px;color:#619090;font-style: normal;padding-top:20px;">- <?php echo $row['name'];?> -  <?php echo $row['designation'];?></p>
    
    <img src="<?=SITEURL?>/images/myacountborder_96.png" style="width:153px; height:16px;margin-left:-23px;" />
    <br />



     
   
     <img src="<?=SITEURL?>/uploads/testimonial/<?php echo $row['image']?>"  style="width:100px; height:100px;margin-left:-23px;"/>
    
   
    </blockquote>
    
    
    </li>
  <!--<li><blockquote>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Integer sed arcu massa.
  <p style="text-align:right;margin-right:20px;">- Srinivas</p>
  </blockquote>
  </li>
  <li><blockquote>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Integer sed arcu massa.
  <p style="text-align:right;margin-right:20px;">- Anita</p>
  </blockquote></li>-->
  <?php } ?>
  
  
  </ul>
 </div>

 <!--Testimonials End-->
