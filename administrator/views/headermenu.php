<script type="text/javascript" src="js/checkuncheckall.js"></script>
<div id="header">
  <div class="div1">
    <div class="div2"><a href="index.php" ><img src="../uploads/site/<?php echo $site_settings_disp->site_image; ?>" style="width:185px; height:51px;" alt="Site Logo" /></a></div>
        <div class="div3"><?php if(isset($_SESSION['us_name']) && $_SESSION['us_name']!=""){?><img src="allfiles/lock.png" alt="" style="position: relative; top: 3px;">&nbsp;You are logged in as <span><?php echo $_SESSION['us_name'];?></span><?php }?></div>
    </div>
	<?php
	if($option!="com_login"){
	?>
	<div id="menu">
	
    <ul class="left sf-js-enabled" style="display: block; ">
      <li  <?php echo $left_dashboard_focus;?>><a href="index.php" class="top">Dashboard</a></li>
<?php /*?><li  <?php echo $left_sitesettings_focus;?>><a href="index.php?option=com_sitesettings" class="top">Site Settings</a></li><?php */?>
	  <li id="catalog" <?php echo $left_sitesettings_focus;?>><a class="top"  href="index.php?option=com_sitesettings">Site Settings</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_dbbackup">Database Backup</a></li>
        </ul>
      </li>
	  
	 <li id="catalog" <?php echo $left_adminlist_focus;?>><a class="top"  href="#">Users</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_adminlist">Admin Users</a></li>
		  <li><a href="index.php?option=com_adminlist_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Admin User</a></li>
		  <li><a href="index.php?option=com_memberlist">Registered Users</a></li>
        </ul>
      </li>
	  
	  
	  <li id="catalog" <?php echo $left_page_focus;?>><a class="top"  href="index.php?option=com_pagelist">Content Pages</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_pagelist_insert">Add New Page</a></li>
          
        </ul>
      </li>
	  <li id="catalog" <?php echo $left_homebanners_focus;?>><a class="top"  href="index.php?option=com_bannerslist">Backgrounds</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_bannerslist_insert">Add New</a></li>
        </ul>
      </li> 
    <?php /*?> <li id="catalog" <?php echo $left_artcles_focus;?>><a class="top"  href="#">Home Articles</a>
        <ul style="display: none; visibility: hidden; ">
		  <li><a href="index.php?option=com_articlepost">Articles</a></li>
		  <li><a href="index.php?option=com_articlepost_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Article</a></li>
		  <li><a href="index.php?option=com_articlecommnets">Article Comments</a></li>
		  <li><a href="index.php?option=com_relationadvice">Relationship Advice</a></li>
        </ul>
      </li>
	  <li id="catalog" <?php echo $left_blog_focus;?>><a class="top"  href="#">Blog</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_blogpost">Posts</a></li>
		  <li><a href="index.php?option=com_blogpost_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Post</a></li>
		   <li><a href="index.php?option=com_blogcommnets">Comments</a></li>
        </ul>
      </li>
	  <li id="catalog" <?php echo $left_forumcat_focus;?>><a class="top"  href="#">Forum</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_forumcat">Category</a></li>
		  <li><a href="index.php?option=com_forumcat_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Category</a></li>
		  <li><a href="index.php?option=com_forumtopics">Topics</a></li>
		  <li><a href="index.php?option=com_forumtopics_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Topic</a></li>
		 <li><a href="index.php?option=com_forumcommnets">Posts / Replies</a></li>
        </ul>
      </li>	 <?php */?> 
	  <li id="catalog" <?php echo $left_store_focus;?>><a class="top"  href="#">Store</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_storecat">Category</a></li>
		  <li><a href="index.php?option=com_storecat_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Category</a></li>
		  <li><a href="index.php?option=com_storeproducts">Products</a></li>
		  <li><a href="index.php?option=com_storeproducts_insert">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Add Product</a></li>
		 <li><a href="index.php?option=com_orderlist">Orders</a></li>
        </ul>
      </li>
	  <li id="catalog" <?php echo $left_subscribers_focus;?>><a class="top"  href="#">Newsletter</a>
		<ul style="display: none; visibility: hidden; ">
		<li><a href="index.php?option=com_subscribers">Subscribers</a></li>
		<li><a href="index.php?option=com_newslettercontent">Newsletter Content</a></li>
		</ul>
      </li>
	   <li id="catalog" <?php echo $left_newsevents_focus;?>><a class="top"  href="index.php?option=com_newseventslist">News</a>
        <ul style="display: none; visibility: hidden; ">
		 <li><a href="index.php?option=com_newseventslist_insert">Add News</a></li>
        </ul>
      </li>
    </ul>
    <ul class="right sf-js-enabled" style="display: block; ">
      <li id="store"><a class="top" href="index.php?option=com_logout">Logout</a></li>
    </ul>
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
  <?php
  }
  ?>
  </div>