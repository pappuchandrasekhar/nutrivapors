 <?php
@ob_start();
@session_start();

include "dbconfig.php";
include "administrator/includes/dbconnection.php";
include("administrator/model/sitesettings.class.php");
include("model/cart.class.php");
$cartobj= new cartClass();
//echo $_REQUEST['enquiryid'];

if($_REQUEST['payaplid']!=""){
print_r($_SESSION); //exit;

echo $uid= $_SESSION['uid'];
echo $uname= $_SESSION['user_name'];
echo $uamt= $_SESSION['amount'];
echo $pro_id= $_SESSION['pro_id'];
echo $pro_name= $_SESSION['pro_name'];
echo $pro_quantity= $_SESSION['pro_qunatity'];
echo $pro_price= $_SESSION['pro_price'];
echo $user_type= $_SESSION['user_type'];
echo $shipamount= $_SESSION['shipamount'];
echo $provider_id=$_SESSION['provider_id'];

//exit;

if(isset($_SESSION['taxh']) && $_SESSION['taxh']!='')
{
$taxamount= $_SESSION['taxh']; 
}

if(isset($_SESSION['disch']) && $_SESSION['disch']!='')
{
$discountamount= $_SESSION['disch']; 
}


 //$cartproducts=cartClass::getindcart(); 
 $cartproducts=$cartobj->getindcart();
 
 //print_r($cartproducts); exit;
}
 if($_SESSION['CART_TEMP_RANDOM'] == "") 
{
	$_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
}
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nutrivapors | Payment Processing</title>
</head>
<body  onload="submitForm()">
<?php if($_REQUEST['payaplid'] !=""){ 
  ?>
<!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypalcart_form"  id="paypalcart_form">-->
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr"  
                        name="paypalcart_form"  id="paypalcart_form" method="post" > 
               <input type="hidden" name="rm" value="2"/>
			   <input type="hidden" name="cmd" value="_cart"/>
			   <input type="hidden" name="business" value="naniboss-facilitator@gmail.com"/>
               <input type="hidden" name="return" value="<?=SITEURL?>/success.php"/>
               <input type="hidden" name="cancel_return" value="<?=SITEURL?>/Cancel"/>
               <input type='hidden' name='cbt' value='Click here to Complete Order' />
               <input type="hidden" name="notify_url" value="ipn"/>
               <input type="hidden" name="upload" value="1"/>
                 
                 <?php 
				 for($j=0;$j<count($pro_name);$j++){ ?>
                  <input type="hidden" name="prod_name_<?php echo $j+1;?>" value="<?php echo $pro_name; ?>" />
                  <input type="hidden" name="item_name_<?php echo $j+1;?>" value="<?php echo $pro_name[$j]; ?>"/>
                  <input type="hidden" name="amount_<?php echo $j+1;?>" value="<?php echo $pro_price[$j]; ?>"/>
                  <input type="hidden" name="quantity_<?php echo $j+1;?>" value="<?php echo $pro_quantity[$j]; ?>"/>
                  <input type="hidden" name="currency_code_<?php echo $j+1;?>" value="USD"/>
                   <?php } ?>
                   <?php /*?><input type="hidden" name="item_name_2" value="dady"/>
                     <input type="hidden" name="amount_2" value="0.01"/>
                      <input type="hidden" name="quantity_2" value="120"/>
                      <input type="hidden" name="currency_code_2" value="USD"/>
                      <input type="hidden" name="item_name_3" value="srinu"/>
                      <input type="hidden" name="amount_3" value="0.01"/>
                      <input type="hidden" name="quantity_3" value="120"/>
                      <input type="hidden" name="currency_code_3" value="USD"/>   <?php */?>
                      
					  <?php if(isset($taxamount) && $taxamount!='') { ?>
                     <input type="hidden" name="tax_cart" value="<?php echo $taxamount; ?>" />
                      <?php } ?> 
                     <?php if(isset($discountamount) && $discountamount!='') { ?>                    
                   <input type="hidden" name="discount_amount_cart" value="<?php echo $discountamount; ?>" />
                     <?php } ?>    
                     <input type="hidden" name="frontuser_id" value="<?php echo $uid; ?>" /> 
                     <input type="hidden" name="shipping_1" value="<?php echo $shipamount; ?>"/>
                     </form>
	<?php } ?>
       <script type="text/javascript">
onload = function () { document.paypalcart_form.submit();}
</script>

      

</body>
</html>
 