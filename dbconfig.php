<?php 
ini_set("display_errors",0);
@define(HOSTNAME,"localhost");
@define(USERNAME,"root");
@define(PASSWORD,"");
@define(DBNAME, "nutrivapors");


/*define(HOSTNAME,"strongerrxm3.db.8031369.hostedresource.com");

define(USERNAME,"strongerrxm3");

define(PASSWORD,"Allstar1!");

define(DBNAME,"strongerrxm3");

*/



//$blogcon=mysql_connect("blogstrong.db.8031369.hostedresource.com","blogstrong","Media3123");

//mysql_select_db("blogstrong",$blogcon);

###################################################################

######### TABLE CONSTANTS 

###################################################################



/********* Table Prefix *********/

define('TPREFIX', 'tb_');



/********* Table Names *********/

define('TBL_ADMIN','admin');
define('TBL_FAQ','faq');
define('TBL_ADMINSINFO','admin_info');

define('TBL_SITESETTINGS','sitesettings');

define('TBL_RECENTACTIVITIES','recentactivities');

define('TBL_CONTENTPAGES','contentpages');

define('TBL_BANNERS','banners');
define('TBL_CONTENTPAGEMENU','contentpagemenu');

define('TBL_STORECATEGORY','store_category');
define('TBL_SUBSUBCATEGORY','menu_sub_sub');
define('TBL_STOREPRODUCTS','store_products');

define('TBL_STORESIZES','store_sizes');
define('TBL_BULKSTORE_VALUE','bulkstore_value');

define('TBL_STORE_VALUE','store_value');

define('TBL_SUBSCRIBERS','newsletter_subscribers');

define('TBL_NEWSCONTENT','newsletter_content');

define('TBL_NEWSEVENTS','newsevents');

define('TBL_CART','cart');

define('TBL_CART_ORDER','cart_order');

define('TBL_ORDERS','orders');
define('TBL_IRON','iron');
define('TBL_CART_TRANSACTION','cart_transcation');

define('TBL_STORECOUPONS','coupons');

define('TBL_VIDEOS','videos');

define('TBL_PACKAGES','packages');

define('TBL_PACKAGES_LIST','packagelist');

define('TBL_WISHLIST','wishlist');

define('TBL_NEW_EXECL','new_execl');
define('TBL_SIZE','size');
define('TBL_PRODUCTS_SIZE','products_size');

define('TBL_STORE_SKU','store_sku');
define('TBL_COUPONS','coupons'); 

///////////

define('TBL_COLOR','color'); 
define('TBL_PANEL_COLOR','panel_color'); 
define('TBL_DOOR_COLOR','door_color'); 
define('TBL_REGISTER','register'); 
///////////
define('TBL_SMALLIMAGES','partners');

define('TBL_AFFILIATEBANNERS','affiliatebanners');

define('TBL_MEDIA','media');
define('TBL_STORESUBCATEGORY','store_subcategory');

define('TBL_NEWSEVENTSTEMPLATES','newseventstemplates');
define('TBL_USERS','users');
define('TBL_USERS_INFO','users_info'); 
define('TBL_BRANDS','brands'); 
define('TBL_COMMENTSECTION','commentsection'); 

define('TBL_TESTIMONIAL','testimonial'); 
define('TBL_ALBUM','album');
define('TBL_ALBUMIMG','albumimg');
define('TBL_ALBUMVID','albumvid');
define('TBL_CRONMAIL','cronmail');
define('TBL_USERIP','userip');
define('TBL_BULKSTORE_PRODUCTS','bulkstore_products');


define('TBL_EMAILID','emailid');

define('TBL_FAQ','faq');

//$timezone = "Asia/Calcutta";

//if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

define('ADMINROOT','administrator');

define('STR_TO_TIME',strtotime(date("Y-m-d H:i:s")));

define('ONLY_DATE',date("m-d-Y"));

define('DATE_TIME',date("m-d-Y H:i:s"));

define('DATE_TIME_FORMAT',date("l dS F Y, H:i:s A", STR_TO_TIME));

define('DATETIMEFORMAT',date("l-dS-F-Y-H-i-s-A", STR_TO_TIME));

define('DBIN','INSERT INTO ');

define('DBUP','UPDATE ');

define('DBWHR',' WHERE ');

define('DBDEL','DELETE ');

define('DBFROM',' FROM ');

define('DBSELECT',' SELECT ');

define('DBSET',' SET ');

define('HEAD_LTN','location:');

define('DB_LMT',' LIMIT ');

define('DB_ORDER',' ORDER BY ');

define('DB_LIKE',' LIKE ');



###################################################################

######### Physical Path Constants 

###################################################################

//define(SITEROOT, 				$_SERVER['DOCUMENT_ROOT']."/beta");

define(SITEROOT, 				$_SERVER['DOCUMENT_ROOT']."/nutrivapors");

define(LISTINGIMAGESROOT, 		SITEROOT."/images/listings");
define(UPLOADSROOT, 			SITEROOT."/uploads/");
define(USER_IMAGE_ROOT,	        SITEROOT."/images/");

###################################################################/~rajeshch/firesafety

######### Url Constants 

###################################################################

//define(SITEURL, 				"http://".$_SERVER['HTTP_HOST']);

define(SITEURL, 				"http://".$_SERVER['HTTP_HOST']."/nutrivapors");



//define(SITEPATH_URL,'http://'.$_SERVER['HTTP_HOST']);

?>