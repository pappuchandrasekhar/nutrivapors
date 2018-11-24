<?php
//echo "hai"; exit;
     
	include('dbconfig.php');

	include SITEROOT."/administrator/includes/dbconnection.php";

	include('model/cart.class.php');
	$cart_obj=new cartClass();

	//echo $_POST['coupon_code'];
	$result=$cart_obj->getCouponCount($_POST['coupon_code']);
	//echo $_POST['coupon_code']; exit;
	
	if($result==1)
	{
		$discountamount=$cart_obj->couponvalidPriceCaliculation($_POST['coupon_code'],$_POST['randomid']);
		
		//echo $_POST['coupon_code'];
		$data['amount']=$cart_obj->discountCaliculation($discountamount->discount,$discountamount->distype,$_POST['cart_amount']);
		$data['type']=$discountamount->distype;
		$data['value']=$discountamount->discount;
	}
	else
		$data['amount']=0;
	
	echo json_encode($data);
?>