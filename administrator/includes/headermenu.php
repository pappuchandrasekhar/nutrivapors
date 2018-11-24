<script type="text/javascript" src="js/checkuncheckall.js"></script>
<div id="header">
  <div class="div1">
    <div class="div2"><a href="index.php" ><img src="../uploads/site/<?php echo $site_settings_disp->site_image; ?>" style="width:185px; height:51px;" alt="Site Logo" /></a></div>
        <div class="div3" id="noprint"><?php if(isset($_SESSION['us_name']) && $_SESSION['us_name']!=""){?><img src="allfiles/lock.png" alt="" style="position: relative; top: 3px;">&nbsp;You are logged in as <span><?php echo $_SESSION['us_name'];?></span><?php }?><br />
		
		</div>
    </div>
	<?php
	if($option!="com_login"){
	?>
    <div id="noprint">
	<div id="menu" >
	
    <ul class="left sf-js-enabled" style="display: block; ">
      <li  <?php echo $left_dashboard_focus;?>><a href="index.php" class="top">Dashboard</a>
      <ul style="display: none; visibility: hidden; ">
	  
      <li id="catalog" <?php echo $left_dashboard_focus;?>><a href="index.php?option=com_sitesettings">Site Settings</a>
	  </ul>
      </li>
  
        
      </li>
      
      
      
       <li id="catalog" <?php echo $left_adminlist_focus;?>><a class="top"  href="#">Users</a>
          <ul style="display: none; visibility: hidden; ">
            <li><a href="index.php?option=com_adminlist">Admin Users</a></li>
            <li><a href="index.php?option=com_adminlist_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Admin User</a></li>
             <li><a href="index.php?option=com_userslist">Register Users</a></li>
            <li><a href="index.php?option=com_userslist_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Register User</a></li>
            <!-- <li><a href="index.php?option=com_memberlist">Registered Users</a></li>-->
          </ul></li>
      
      
      
	  
	 <!--<li id="catalog" <?php // echo $left_adminlist_focus;?>><a class="top"  href="#">Users</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_adminlist">Admin Users</a></li>
		  <li><a href="index.php?option=com_adminlist_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Admin User</a></li>
		 <li><a href="index.php?option=com_memberlist">Registered Users</a></li>
        </ul>
      </li>-->
	  
	  
	  <li id="catalog" <?php echo $left_page_focus;?>><a class="top"  href="index.php?option=com_pagelist">Content Pages</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_pagelist_insert">Add New Page</a></li>
          
        </ul>
      </li>
	  <li id="catalog" <?php echo $left_homebanners_focus;?>><a class="top"  href="index.php?option=com_bannerslist">Home Banners</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_bannerslist_insert">Add New</a></li>
        </ul>
      </li> 
 
	  <li id="catalog" <?php echo $left_store_focus;?>><a class="top"  href="#">Store</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_storecat">Category</a></li>
		  <li><a href="index.php?option=com_storecat_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Category</a></li>
           <!--<li><a href="index.php?option=com_storesubcat">Sub Category</a></li>
		  <li><a href="index.php?option=com_storesubcat_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add SubCategory</a></li>
           <li><a href="index.php?option=com_size">Size</a></li>
		  <li><a href="index.php?option=com_size_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Size</a></li>-->
		  <li><a href="index.php?option=com_storeproducts">Products</a></li>
		  <li><a href="index.php?option=com_storeproducts_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Product</a></li>
          <!-- <li><a href="index.php?option=com_brands">Brands</a></li>
		  <li><a href="index.php?option=com_brands_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Brands</a></li>-->
          
         
         <li><a href="index.php?option=com_bulkproducts">Monthly specials</a></li>
		  <li><a href="index.php?option=com_bulkproducts_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Product</a></li>

         
         
       <?php /*?> <li><a href="index.php?option=com_storecoupons">Coupons</a></li>
		  <li><a href="index.php?option=com_storecoupons_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Coupon</a></li><?php */?>  
		 <li><a href="index.php?option=com_orderlist">Orders</a></li>     
</ul>
      </li>
	  <li id="catalog" <?php echo $left_subscribers_focus;?>><a class="top"  href="#">Newsletter</a>
		<ul style="display: none; visibility: hidden; ">
		<li><a href="index.php?option=com_subscribers">Subscribers</a></li>
      <!-- <li><a href="index.php?option=com_newseventslist">Testimonial</a></li>-->
	<?php /*?>	<li><a href="index.php?option=com_newslettercontent">Newsletter Content</a></li><?php */?>
		</ul>
      </li>
	  <?php /*?> <li id="catalog" <?php echo $left_newsevents_focus;?>><a class="top"  href="index.php?option=com_newseventslist">News</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_newseventslist_insert">Add News</a></li>
        </ul><?php */?>
      </li>
       
       
       
       <!--<li id="catalog" <?php echo $left_colors_focus;?>><a class="top"  href="index.php?option=com_colorslist">colors</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_colors_insert">Add color</a></li>
        </ul>
      </li>-->
       
     <?php /*?>  <li id="catalog" <?php echo $left_color_focus;?>><a class="top"  href="index.php?option=com_color">Colors</a>
          <ul style="display: none; visibility: hidden; ">
            <li><a href="index.php?option=com_color_insert">Add color</a></li>
          </ul>
        </li><?php */?>
        
	   
      <?php /*?>   <li id="catalog" <?php echo $left_excle_focus;?>><a class="top"  href="index.php?option=com_execl">Excel</a>
           <li id="catalog" <?php echo $left_excle1_focus;?>><a class="top"  href="index.php?option=com_execl2">Price Excel</a>
          
        </li><?php */?>
        
        
         <li id="catalog" <?php echo $left_testimonial_focus;?>><a class="top"  href="index.php?option=com_testimonial">Testimonial</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_testimonial_insert">Add New</a></li>
          
        </ul>
        </li>
        
        
         <li id="catalog" <?php echo $left_faq_focus;?>><a class="top"  href="index.php?option=com_faq">Faq</a>
        <ul style="display: none; visibility: hidden;">
		 <li><a href="index.php?option=com_faq_insert">Add Faq</a></li>
          
        </ul>
        </li>
        
        
         
        <li id="catalog" <?php echo $left_comments_focus;?>><a class="top"  href="index.php?option=com_comments">Customer Reviews</a>
          
        </li>
       
	   
	   
	   <li id="catalog" <?php echo $left_promocode_focus;?>><a class="top"  href="index.php?option=com_promocode">Promo Code</a>
          
        </li>
        
	   <?php /*?><li id="catalog" <?php echo $left_videos_focus;?>><a class="top"  href="index.php?option=com_videoslist">Videos</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_videoslist_insert">Add Video</a></li>
        </ul>
      </li>
      <?php */?>
        <?php /*?><li id="catalog" <?php echo $left_smallimages_focus;?>><a class="top"  href="index.php?option=com_smallimageslist">Official Partners</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_smallimageslist_insert">Add Official Partner</a></li>
        </ul>
      </li>
	  <li id="catalog" <?php echo $left_album_focus;?>><a class="top"  href="#">Media</a>
        <ul style="display: none; visibility: hidden; ">
		<li><a href="index.php?option=com_album">Albums</a></li>
		  <li><a href="index.php?option=com_album_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Album</a></li>
		  <li><a href="index.php?option=com_albumimg">Images</a></li>
		  <li><a href="index.php?option=com_albumimg_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Image</a></li>
		  <li><a href="index.php?option=com_albumvid">Videos</a></li>
		  	  <li><a href="index.php?option=com_albumvid_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Video</a></li>
		  
        </ul>
      </li><?php */?>
     <?php /*?> <li id="catalog" <?php echo $left_affiliatebanners_focus;?>><a class="top"  href="index.php?option=com_affiliatebannerslist">Affiliate Banners</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_affiliatebannerslist_insert">Add Banner</a></li>
        </ul>
      </li>
      <li id="catalog"><a class="top"  href="http://www.google.com/analytics" target="_blank">Analytics</a></li>
       <li id="catalog"><a class="top"  href="https://www.evernote.com/Login.action?targetUrl=%2FHome.action" target="_blank">Notes</a></li>
       <li id="catalog"><a class="top"  href="http://app.invoice2go.com/index.html" target="_blank">Invoice</a></li><?php */?>
       
       <li id="store"><a class="top" href="index.php?option=com_logout">Logout</a></li>
	  <?php /*?> <li id="store"><a class="top" href="http://strongerrx.eu/administrator" target="_blank">SRX Europe Admin</a></li>
	   <?php */?>
    </ul>
    <!--<ul class="right sf-js-enabled" style="display: block; ">
      <li id="store"><a class="top" href="index.php?option=com_logout">Logout</a></li>
    </ul>-->
    <script type="text/javascript"><!--
$(document).ready(function() {
	$('#menu > ul').superfish({
		hoverClass	 : 'sfHover',
		pathClass	 : 'overideThisToUse',
		delay		 : 0,
		animation	 : {height: 'show'},
		speed		 : 'normal',
		autoArrows   : false,
		dropShadows  : false, 
		disableHI	 : false, /* set to true to disable hoverIntent detection */
		onInit		 : function(){},
		onBeforeShow : function(){},
		onShow		 : function(){},
		onHide		 : function(){}
	});
	
	$('#menu > ul').css('display', 'block');
});
 
function getURLVar(urlVarName) {
	var urlHalves = String(document.location).toLowerCase().split('?');
	var urlVarValue = '';
	
	if (urlHalves[1]) {
		var urlVars = urlHalves[1].split('&');

		for (var i = 0; i <= (urlVars.length); i++) {
			if (urlVars[i]) {
				var urlVarPair = urlVars[i].split('=');
				
				if (urlVarPair[0] && urlVarPair[0] == urlVarName.toLowerCase()) {
					urlVarValue = urlVarPair[1];
				}
			}
		}
	}
	
	return urlVarValue;
} 

$(document).ready(function() {
	route = getURLVar('route');
	
	if (!route) {
		$('#dashboard').addClass('selected');
	} else {
		part = route.split('/');
		
		url = part[0];
		
		if (part[1]) {
			url += '/' + part[1];
		}
		
		$('a[href*=\'' + url + '\']').parents('li[id]').addClass('selected');
	}
});
//--></script> 
  </div>
  </div>
  <?php
  }
  ?>
  </div>