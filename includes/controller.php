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
			
			case "com_comments":
			$disptemp="views/comments.php";
			$left_sitesettings_focus='class="selected"'; 
			break;
			case "com_comments_insert":
			$disptemp="views/comments.php";
			$left_sitesettings_focus='class="selected"'; 
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
					
			
					
			case "com_userslist":
			$disptemp="views/userslist.php";
			$left_userlist_focus='class="selected"';  
			break;
			case "com_userslist_insert":
			$disptemp="views/userslist.php";
			$left_userlist_focus='class="selected"';  
			break;			
			case "com_forumcat":
			$disptemp="views/forumcategory.php";
			$left_forumcat_focus='class="selected"';  
			break;
			case "com_forumcat_insert":
			$disptemp="views/forumcategory.php";
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
			/*
			case "com_brands":
			$disptemp="views/brands.php";
			$left_store_focus='class="selected"';  
			break;
			case "com_brands_insert":
			$disptemp="views/brands.php";
			$left_store_focus='class="selected"';  
			break;
			
			*/
			
			case "packages":
			$disptemp="views/packages.php";
			$left_store_focus='class="selected"';  
			break;
			case "package_new":
			$disptemp="views/packages.php";
			$left_store_focus='class="selected"';  
			break;
///////////////////////////////////////////aswin //////////////////////////////////////////////////////////
		/*	case "com_size":
			$disptemp="views/size.php";
			$left_store_focus='class="selected"';  
			break;
			case "com_size_insert":
			$disptemp="views/size.php";
			$left_size_focus='class="selected"';  
			break;	*/
///////////////////////////////////////////aswin end //////////////////////////////////////////////////////			
			
			case "packages_edit":
			$disptemp="views/packages.php";
			$left_store_focus='class="selected"';  
			break;
			
			/*case "com_storecoupons":
			$disptemp="views/storecoupons.php";
			$left_store_focus='class="selected"';  
			break;
			case "com_storecoupons_insert":
			$disptemp="views/storecoupons.php";
			$left_store_focus='class="selected"';  
			break;*/
			case "com_orderlist":
			$disptemp="views/orderlist.php";
			$left_store_focus='class="selected"';  
			break;
			case "com_orderlistview":
			$disptemp="views/orderlistview.php";
			$left_store_focus='class="selected"';  
			break;			
			
			case "com_storesubcat":
			$disptemp="views/storesubcategory.php";
			$left_store_focus='class="selected"';  
			break;
			case "com_storesubcat_insert":
			$disptemp="views/storesubcategory.php";
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
		
		
		    case "com_testimonial":
			$disptemp="views/testimonial.php";
			$left_testimonial_focus='class="selected"';  
			break;
			case "com_testimonial_insert":
			$disptemp="views/testimonial.php";
			$left_testimonial_focus='class="selected"';  
			break;
		
		
		
			
			case "mail":
			$disptemp="views/mail.php";
			$left_subscribers_focus='class="selected"';  
			break;
			case "banner_insert":
			$disptemp="views/mail.php";
			$left_subscribers_focus='class="selected"';  
			break;
			case "com_newseventstemplateslist":
			$disptemp="views/newseventtemplates.php";
			$left_subscribers_focus='class="selected"';  
			break;
			case "com_newseventstemplateslist_insert":
			$disptemp="views/newseventtemplates.php";
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
/*			case "com_testimonialslist":
			$disptemp="views/testimonials.php";
			$left_testimonial_focus='class="selected"';  
			break;
			case "com_testimonialslist_insert":
			$disptemp="views/testimonials.php";
			$left_testimonial_focus='class="selected"';  
			break;*/
			
			//case "com_videoslist":
//			$disptemp="views/videos.php";
//			$left_videos_focus='class="selected"';  
//			break;
//			case "com_videoslist_insert":
//			$disptemp="views/videos.php";
//			$left_videos_focus='class="selected"';  
//			break;
//			
			case "com_smallimageslist":
			$disptemp="views/smallimages.php";
			$left_smallimages_focus='class="selected"';  
			break;
			case "com_smallimageslist_insert":
			$disptemp="views/smallimages.php";
			$left_smallimages_focus='class="selected"';  
			break;
			
			
			
			
			
			
			
			
			case "com_userslist":
			$disptemp="views/userslist.php";
			$left_adminlist_focus='class="selected"';  
			break;
			case "com_userslist_insert":
			$disptemp="views/userslist.php";
			$left_adminlist_focus='class="selected"';  
			break;
			
			
			case "com_noaccess":
			$disptemp="views/pageaccess.php";
			break;
			
			case "com_promocode":
			$disptemp="views/promocode.php";
			$left_adminlist_focus='class="selected"';  
			break;
				case "com_promocode_insert":
			$disptemp="views/promocode.php";
			$left_adminlist_focus='class="selected"';  
			break;
			
			
			case "com_logout":
			$disptemp="views/logout.php";
			break;
			/*default:
			$disptemp="views/login.php"; */
			
			
			// color insert	
			//case "com_colorslist":
			//$disptemp="views/doorcolor.php";
			//$left_colors_focus='class="selected"';
			//break;
			
			//case "com_colors_insert":
			//$disptemp="views/doorcolor.php";
			//$left_color_focus='class="selected"';
			//break;
		//////////////////	
		
		    case "com_color":
			$disptemp="views/color.php";
			$left_color_focus='class="selected"';
			break;
			
			case "com_color_insert":
			$disptemp="views/color.php";
			$left_color_focus='class="selected"';
			break;
			
			
			
			
			
			 case "com_execl":
			$disptemp="views/execl_page.php";
			$left_excle_focus='class="selected"';
			break;
			
			case "com_execl_insert":
			$disptemp="views/execl_page.php";
			$left_excle_focus='class="selected"';
			break;
			
			
			 case "com_execl2":
			$disptemp="views/execl_page1.php";
			$left_excle1_focus='class="selected"';
			break;
			
			case "com_execl2_insert":
			$disptemp="views/execl_page1.php";
			$left_excle1_focus='class="selected"';
			break;
			
			
			
			 case "com_color":
			//$disptemp="views/color.php";
			$left_excle_focus='class="selected"';
			break;
			
			
			
		}
		
?>
