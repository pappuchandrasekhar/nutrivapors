<?php
if($_GET['option']!="")
$option=$_GET['option'];
else
$option="com_login";
		switch($option)
		{
			case "com_login":
			$disptemp="views/login.php";
			break;
			case "com_dashboard":
			$disptemp="views/dashboard.php"; 
			$left_dashboard_focus='class="selected"'; 
			break;
			case "com_adminlist":
			$disptemp="views/adminlist.php";
			$left_adminlist_focus='class="selected"';  
			break;
			case "com_adminlist_insert":
			$disptemp="views/adminlist.php";
			$left_adminlist_focus='class="selected"';  
			break;
			case "com_memberlist":
			$disptemp="views/memberslist.php";
			$left_adminlist_focus='class="selected"';  
			break;
			
			case "com_sitesettings":
			$disptemp="views/sitesettings.php";
			$left_sitesettings_focus='class="selected"'; 
			break;
			case "com_dbbackup":
			$disptemp="views/dbbackup.php";
			$left_sitesettings_focus='class="selected"'; 
			break;
			
			case "com_dbdownload":
			$disptemp="views/dbdownload.php";
			$left_sitesettings_focus='class="selected"'; 
			break;
			
			case "com_pagelist":
			$disptemp="views/pagelist.php";
			$left_page_focus='class="selected"';  
			break;
			case "com_pagelist_insert":
			$disptemp="views/pagelist.php";
			$left_page_focus='class="selected"';  
			break;
			case "com_bannerslist":
			$disptemp="views/homebanners.php";
			$left_homebanners_focus='class="selected"';  
			break;
			case "com_bannerslist_insert":
			$disptemp="views/homebanners.php";
			$left_homebanners_focus='class="selected"';  
			break;
			case "com_blogpost":
			$disptemp="views/blog.php";
			$left_blog_focus='class="selected"';  
			break;
			case "com_blogpost_insert":
			$disptemp="views/blog.php";
			$left_blog_focus='class="selected"';  
			break;
			case "com_blogcommnets":
			$disptemp="views/blogcomments.php";
			$left_blog_focus='class="selected"';  
			break;
			
			case "com_articlepost":
			$disptemp="views/homearticles.php";
			$left_artcles_focus='class="selected"';  
			break;
			case "com_articlepost_insert":
			$disptemp="views/homearticles.php";
			$left_artcles_focus='class="selected"';  
			break;
			
			case "com_articlecommnets":
			$disptemp="views/homearticlescomments.php";
			$left_artcles_focus='class="selected"';  
			break;
					
			case "com_relationadvice":
			$disptemp="views/relationadvice.php";
			$left_artcles_focus='class="selected"';  
			break;	
			case "com_relationadvice_insert":
			$disptemp="views/relationadvice.php";
			$left_artcles_focus='class="selected"';  
			break;
					
						
			case "com_forumcat":
			$disptemp="views/forumcategory.php";
			$left_forumcat_focus='class="selected"';  
			break;
			case "com_forumcat_insert":
			$disptemp="views/forumcategory.php";
			$left_forumcat_focus='class="selected"';  
			break;
			case "com_forumtopics":
			$disptemp="views/forumtopics.php";
			$left_forumcat_focus='class="selected"';  
			break;
			case "com_forumtopics_insert":
			$disptemp="views/forumtopics.php";
			$left_forumcat_focus='class="selected"';  
			break;
			case "com_forumcommnets":
			$disptemp="views/forumcomments.php";
			$left_forumcat_focus='class="selected"';  
			break;
			
			case "com_storecat":
			$disptemp="views/storecategory.php";
			$left_store_focus='class="selected"';  
			break;
			case "com_storecat_insert":
			$disptemp="views/storecategory.php";
			$left_store_focus='class="selected"';  
			break;
			case "com_storeproducts":
			$disptemp="views/storeproducts.php";
			$left_store_focus='class="selected"';  
			break;
			case "com_storeproducts_insert":
			$disptemp="views/storeproducts.php";
			$left_store_focus='class="selected"';  
			break;
			case "com_orderlist":
			$disptemp="views/orderlist.php";
			$left_store_focus='class="selected"';  
			break;
			case "com_orderlistview":
			$disptemp="views/orderlistview.php";
			$left_store_focus='class="selected"';  
			break;			
			
			case "com_newslettercontent":
			$disptemp="views/newslettercontent.php";
			$left_subscribers_focus='class="selected"';  
			break;
			case "com_subscribers":
			$disptemp="views/subscribers.php";
			$left_subscribers_focus='class="selected"';  
			break;
			
			
			case "com_productslist":
			$disptemp="views/products.php";
			$left_products_focus='class="selected"';  
			break;
			case "com_productslist_insert":
			$disptemp="views/products.php";
			$left_products_focus='class="selected"';  
			break;
			case "com_newseventslist":
			$disptemp="views/newsevent.php";
			$left_newsevents_focus='class="selected"';  
			break;
			case "com_newseventslist_insert":
			$disptemp="views/newsevent.php";
			$left_newsevents_focus='class="selected"';  
			break;
			case "com_testimonialslist":
			$disptemp="views/testimonials.php";
			$left_testimonial_focus='class="selected"';  
			break;
			case "com_testimonialslist_insert":
			$disptemp="views/testimonials.php";
			$left_testimonial_focus='class="selected"';  
			break;
			
			case "com_noaccess":
			$disptemp="views/pageaccess.php";
			break;
			
			case "com_logout":
			$disptemp="views/logout.php";
			break;
			/*default:
			$disptemp="views/login.php"; */
		}
		
?>
