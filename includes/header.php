<?php 
@ob_start();
@session_start();

include('dbconfig.php');

include_once("includes/sessions.php");
echo "hii1";
include('administrator/includes/dbconnection.php');
include('administrator/model/sitesettings.class.php');
include('model/banner.class.php');
include('model/cart.class.php');
include('model/seo.class.php');

$cartobj= new cartClass();
$caroducts=$cartobj->getindcart();
 $sumofvalues=$cartobj->getindsumcartvalue();
$sumtotal= $sumofvalues->total;
$tot_cou = count($cartproducts);
//print_r($tot_cou);
//$sumofvalues=$cartproducts->total_price;
$bannerObj= new bannerClass();
$sitesettObj= new sitesettingsClass();

$sitesettings=$sitesettObj->getSitesettings();
//print_r($sitesettings);
$catlist=$bannerObj->gettoprated();

?>


<?php

  $id=$_GET['id'];

 $sid=$_GET['spid'];
 $prdtdescription=$bannerObj->getproductdescription($sid);

$pagettdata=$bannerObj->getpagetitle($id);

//print_r($pagettdata);

//echo $pagettdata->catetitle;

$sitename="NIV";
$query="select * from tb_contentpages where page_id=".$_GET['id'];
$contentpage= $callConfig->getRow($query);
if(basename($_SERVER['PHP_SELF'])=='index.php')
 {
	 //echo "hai";
 $main_head= $sitename ." | Home"; 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }
 
 else if(basename($_SERVER['PHP_SELF'])=='contactus.php')
 {
	 //echo "hai";
 $main_head=$sitename ." | Contact Us"; 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }

else if(basename($_SERVER['PHP_SELF'])=='productpage.php')
 {
	 //echo "hai";
 $main_head=$sitename .' | '. stripslashes($pagettdata->catetitle); 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }
else if(basename($_SERVER['PHP_SELF'])=='content.php')
 {
	 //echo "hai";
 $main_head=$sitename .' | '. stripslashes($contentpage->title); 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }
 
 
  else if(basename($_SERVER['PHP_SELF'])=='login.php')
 {
	 //echo "hai";
 $main_head=$sitename ." | Log In"; 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }



 else if(basename($_SERVER['PHP_SELF'])=='register.php')
 {
	 //echo "hai";
 $main_head=$sitename ." | Register"; 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }
 
 
  else if(basename($_SERVER['PHP_SELF'])=='bulkorderpage.php')
 {
	 //echo "hai";
 $main_head=$sitename ." | Bulk Order"; 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }
 
 
 
 else if(basename($_SERVER['PHP_SELF'])=='featuredproducts.php')
 {
	 //echo "hai";
 $main_head=$sitename ." | Featured Products"; 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }
 
 
  else if(basename($_SERVER['PHP_SELF'])=='newproducts.php')
 {
	 //echo "hai";
 $main_head=$sitename ." | New Products"; 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }
 
 
  else if(basename($_SERVER['PHP_SELF'])=='monthlyspecials.php')
 {
	 //echo "hai";
 $main_head=$sitename ." | Monthly Special"; 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }
 
 
  else if(basename($_SERVER['PHP_SELF'])=='subscriptions.php')
 {
	 //echo "hai";
 $main_head=$sitename ." | Subscriptions"; 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }
 
 
 else if(basename($_SERVER['PHP_SELF'])=='category.php')
 {
	 //echo "hai";
 $main_head=$sitename .' |  '. stripslashes($pagettdata->catetitle);   
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }
 
 
 else if(basename($_SERVER['PHP_SELF'])=='product_discription.php')
 {
	 //echo "hai";
	 
	 $pagettdata=$bannerObj->getpagetitle($prdtdescription->scid);

$main_head=$sitename .' | '. stripslashes($pagettdata->catetitle).' | '.stripslashes($prdtdescription->prodtitle); 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }


 else if(basename($_SERVER['PHP_SELF'])=='bulkproduct_discription.php')
 {
	 //echo "hai";
	 
	 $pagettdata=$bannerObj->getpagetitle($prdtdescription->scid);

$main_head=$sitename .' | '. 'Bulk Order' . stripslashes($pagettdata->catetitle).' | '.stripslashes($prdtdescription->prodtitle); 
 $PageTitle= $main_head;
 $MetaKeys = $main_head;
 $MetaDesc = $main_head;	 
 }


?>


<?php 
function cut_paragraph($paragraph,$limit)
{
$paragraph1 = explode(" ",$paragraph);
$cnt = count($paragraph1);
$extra = '' ;
if($cnt >$limit)
{
$cnt = $limit;
$extra = "....";
}
$string = " ";
for($i=0;$i<$cnt;$i++)
{
$string.=$paragraph1[$i]." ";
}
echo  $string.$extra;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo  $main_head ?> </title>




<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link type="text/css" rel="stylesheet" href="<?=SITEURL?>/style.css">
  
<script type="text/javascript" src="<?=SITEURL?>/js/jquery-1.11.1.min.js"></script>
  



<script type="text/javascript">
$(document).ready(function(){
	$('.mobile_menuicon').click(function(){
		$('.main_nav_list').slideToggle();	
	});	
})
</script>
<script>
size=document.getElementById('bottle_size').value;

</script>
</head>
<body>

   <!--top-->
       <div class="full_wrapper top">
          <div class="site_container topin">
               <!--left-->
                 <div class="leftmenu">
                   <div class="topicon"><a href="#"><img src="<?php echo SITEURL;?>/images/topiconleft_02.png" alt=""></a></div>
                   <div class="tolmenu"><a href="#"><!--Hotline: 0123 456 789; skype: kalins.support-->sales@nutrivapors.com</a></div>
                   <div class="clear_fix"></div>
                 </div>
               <!--End Left-->
               
                <!--Right-->
                 <div class="rightmenu">
                   <ul class="tormenu"> 
                  
<?php if($_SESSION['frnt_mid']!=''){?>
				     <li> <li><span>Welcome</span>&nbsp;&nbsp;<?php echo $_SESSION['frnt_usname']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<!--<a href="#">My Account</a>-->  |   <a href="<?=SITEURL?>/login.html">Checkout</a>  | <a href="<?=SITEURL?>/logout.php">Logout</a></li>
                  
				  <?php } else {  ?>
          <li><a href="<?=SITEURL?>/register.html">Register </a> |  <a href="<?=SITEURL?>/login.html">Checkout</a>  |    <a href="<?=SITEURL?>/login.html">Log In</a></li>
<?php }?>

				   </ul>
                 </div>
               <!--End Right-->
                <div class="clear_fix"></div>
          </div>
       </div>
       <div class="clear_fix"></div>
   <!--End top-->
      
   <!--logopart-->

      <div class="full_wrapper">
        <div class="site_container">
          <!--left-->
            <div class="sitelogo">
             <a href="<?=SITEURL?>/home.html"> <img src="<?=SITEURL?>/images/sitelogo_04.png" alt=""></a>
            </div>
          <!--End left-->
          <!--right-->
              <div>
              
              <?php if($prdtdescription->scid=='1') { ?>
              
              
                  <div class="rightgreen">
                    <span style="float:left; padding-left:10px"><a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$prdtdescription->spid)?>"><img src="<?=SITEURL?>/images/topcart_07.png" alt=""></a></span>(<?=$tot_cou?>) item(s) <?php /*?>- $<?=$sumtotal?><?php */?>
                  </div>
                  <?php } else { ?>
                  <a href="<?=SITEURL?>/shopping_cart.php">
                   <div class="rightgreen">
                    <span style="float:left; padding-left:10px"><img src="<?=SITEURL?>/images/topcart_08.png" alt=""></span>(<?=$tot_cou?>) item(s) <?php /*?>- $<?=$sumtotal?><?php */?>
                  </div></a>
                  
                  
                  <?php } ?>
                  
                  
                  
                 <div class="serchbar">
                 
                  <form  action="<?=SITEURL?>/search_products.php" method="get" name="search" >
<input type="text" value="" class="serhinpput" name="search" onBlur="if(this.value=='')this.value='Search..';" onFocus="if(this.value=='Search..')this.value='';" placeholder="search" style="padding-left:3px" /> 
<input type="submit" value="" class="sersubri"  style="margin-left:-3px;"/>
</form>
                 
                 
                    <!--<input type="text" class="serhinpput" placeholder="Search entire store here..." value="">
                    <input type="submit" value="" class="sersubri">-->
                  </div>
                   
                  <div class="clear_fix"></div>
              </div>
          <!--End right-->
          
          
           <div class="clear_fix"></div>
        </div>
      </div>
      <div class="clear_fix"></div>
   <!--ENd logopart-->
   
   <!--menuslice-->
      <div class="full_wrapper menubg">
        <div class="site_container menu_main_wapm">
         <div class="mobile_menuicon"><img src="<?=SITEURL?>/images/mobile_menu.png"></div><!--mobile_menuicon-->
          <ul class="main_nav_list">
           <li><a href="<?=SITEURL?>/home.html" <?php if($_GET['id']=="1" && basename($_SERVER['PHP_SELF'])=='index.php'){echo "class='active'";}?>>Home
		   
		   
		   </a></li>
         <!--   <li><a href="productpage.php?id=1">E Juice</a></li>
            <li><a href="productpage.php?id=2">Vape Pens</a></li>
            <li><a href="productpage.php?id=4">Tanks</a></li>
            <li><a href="productpage.php?id=3">Accessories</a></li>-->
            
            
            <li><a href="<?=SITEURL?>/<?=seoClass::furl('productpage.php?id=1')?>" <?php if($_GET['id']=="1" && basename($_SERVER['PHP_SELF'])=='productpage.php'){echo "class='active'";}?>>E Juice</a></li>
            <li><a href="<?=SITEURL?>/<?=seoClass::furl('productpage.php?id=2')?>" <?php if($_GET['id']=="2" && basename($_SERVER['PHP_SELF'])=='productpage.php'){echo "class='active'";}?>>Vape Pens</a></li>
            <li><a href="<?=SITEURL?>/<?=seoClass::furl('productpage.php?id=4')?>" <?php if($_GET['id']=="4" && basename($_SERVER['PHP_SELF'])=='productpage.php'){echo "class='active'";}?>>Atomizers</a></li>
            <li><a href="<?=SITEURL?>/<?=seoClass::furl('productpage.php?id=3')?>" <?php if($_GET['id']=="3" && basename($_SERVER['PHP_SELF'])=='productpage.php'){echo "class='active'";}?>>Accessories</a></li>
            
            
            <li><a href="<?=SITEURL?>/bulkorderpage.php">Bulk Order</a></li>
            <li><a href="<?=SITEURL?>/subscriptions.php">Subscriptions</a></li>
            <li><a href="<?=SITEURL?>/monthlyspecials.php">Monthly Special</a></li>
             <li><a href="<?=SITEURL?>/contactus.html">Contact Us</a></li>
          </ul>
          <div class="clear_fix"></div> 
        </div>
      </div>
      <div class="clear_fix"></div> 
   <!--End menuslice-->
