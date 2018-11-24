<?php 
class  cartClass
{ 

 function inserttempcartindivurl()
 {			
 
 //echo $_POST['price']; *($_POST['quantity']+$res->quantity)
			global $callConfig;
			if($_SESSION['CART_TEMP_RANDOM'] == "") 
			{
			$_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
			}
			//$id=$_POST['spid']; 
			if($_POST['product_type']=="direct")
			{
				$id=$_POST['prod_id'];
				
				}else{
			  $id=$_GET['spid']; }
			
			echo $sel="select * from ".TPREFIX.TBL_CART." where temprandid='".$_SESSION['CART_TEMP_RANDOM']."' and prod_id='".$id."'";
		$res=$callConfig->getRow($sel);
		//print_r($res);exit;
	
		//if($res->prod_id==$_POST['spid'] && $res->bottle_size==$_POST['bottle_size'] && $res->quantity==$_POST['qun'])
		if($res->prod_id==$id && $res->bottle_size==$_POST['bottle_size'])
		{
			//echo "sarat";exit;
		$quantity=$_POST['qun']+$res->quantity;
		
		$totlaprice=$res->indiv_price*$quantity;
		$fieldnames=array('cart_cid'=>$_POST['catid'],'prod_id'=>$id,'prod_name'=>mysql_real_escape_string($_POST['probname']),'bottle_size'=>$_POST['bottle_size'],'cont_mg'=>$_POST['cont_mg'],'indiv_price'=>$_POST['price2'],'quantity'=>$quantity,'bulkpacketcount'=>$_POST['bulkpacketcount'],'type'=>$_POST['type'],'total_price'=>$totlaprice,'temprandid' =>$_SESSION['CART_TEMP_RANDOM'],'p_img'=>$_POST['pimg']);
		$whr = " prod_id='".$id."' and temprandid='".$_SESSION['CART_TEMP_RANDOM']."' ";
			$res=$callConfig->updateRecord1(TPREFIX.TBL_CART,$fieldnames,$whr,'');
			
		}
		else
			{
				
				
				/* $fieldnames=array('cart_cid'=>$_POST['catid'],'prod_id'=>$id,'prod_name'=>mysql_real_escape_string($_POST['probname']),'bottle_size'=>$_POST['bottle_size'],'cont_mg'=>$_POST['cont_mg'],'indiv_price'=>$_POST['price2'],'quantity'=>$_POST['qun'],'total_price'=>$_POST['price']*($_POST['quantity']),'temprandid' =>$_SESSION['CART_TEMP_RANDOM'],'p_img'=>$_POST['pimg']);*/
				
	        $fieldnames=array('cart_cid'=>$_POST['catid'],'prod_id'=>$id,'prod_name'=>mysql_real_escape_string($_POST['probname']),'bottle_size'=>$_POST['bottle_size'],'cont_mg'=>$_POST['cont_mg'],'indiv_price'=>$_POST['price2'],'quantity'=>$_POST['qun'],'bulkpacketcount'=>$_POST['bulkpacketcount'],'type'=>$_POST['type'],'total_price'=>$_POST['price'],'temprandid' =>$_SESSION['CART_TEMP_RANDOM'],'p_img'=>$_POST['pimg']);
			//print_r($fieldnames);exit;
			$res=$callConfig->insertRecord(TPREFIX.TBL_CART,$fieldnames);
			}
		
		 header("Location:".$_POST['url']."&msg=Your Item has been added to the cart");
  }
 
 
 function inserttempcart()
 {	
 
 //echo $id=$_GET['spid'];		
 
 //print_r($_POST);
 //echo $_POST['price']; *($_POST['quantity']+$res->quantity)
			global $callConfig;
			if($_SESSION['CART_TEMP_RANDOM'] == "") 
			{
			$_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
			}
			//$id=$_POST['spid']; 
			if($_POST['product_type']=="direct")
			{
				$id=$_POST['prod_id'];
				
				}else{
			  $id=$_GET['spid']; }
			
			echo $sel="select * from ".TPREFIX.TBL_CART." where temprandid='".$_SESSION['CART_TEMP_RANDOM']."' and prod_id='".$id."'";
		$res=$callConfig->getRow($sel);
		//print_r($res);exit;
	
		//if($res->prod_id==$_POST['spid'] && $res->bottle_size==$_POST['bottle_size'] && $res->quantity==$_POST['qun'])
		if($res->prod_id==$id && $res->bottle_size==$_POST['bottle_size'])
		{
			//echo "sarat";exit;
		$quantity=$_POST['qun']+$res->quantity;
		$weight=$_POST['weight']+$res->weight;
		$totlaprice=$res->indiv_price*$quantity;
		$fieldnames=array('cart_cid'=>$_POST['catid'],'prod_id'=>$id,'prod_name'=>mysql_real_escape_string($_POST['probname']),'bottle_size'=>$_POST['bottle_size'],'weight'=>$weight,'cont_mg'=>$_POST['cont_mg'],'indiv_price'=>$_POST['price2'],'quantity'=>$quantity,'bulkpacketcount'=>$_POST['bulkpacketcount'],'type'=>$_POST['type'],'total_price'=>$totlaprice,'temprandid' =>$_SESSION['CART_TEMP_RANDOM'],'p_img'=>$_POST['pimg']);
		$whr = " prod_id='".$id."' and temprandid='".$_SESSION['CART_TEMP_RANDOM']."' ";
			$res=$callConfig->updateRecord1(TPREFIX.TBL_CART,$fieldnames,$whr,'');
		}
		else
			{
				/* $fieldnames=array('cart_cid'=>$_POST['catid'],'prod_id'=>$id,'prod_name'=>mysql_real_escape_string($_POST['probname']),'bottle_size'=>$_POST['bottle_size'],'cont_mg'=>$_POST['cont_mg'],'indiv_price'=>$_POST['price2'],'quantity'=>$_POST['qun'],'total_price'=>$_POST['price']*($_POST['quantity']),'temprandid' =>$_SESSION['CART_TEMP_RANDOM'],'p_img'=>$_POST['pimg']);*/
				
	        $fieldnames=array('cart_cid'=>$_POST['catid'],'prod_id'=>$id,'prod_name'=>mysql_real_escape_string($_POST['probname']),'bottle_size'=>$_POST['bottle_size'],'weight'=>$_POST['weight'],'cont_mg'=>$_POST['cont_mg'],'indiv_price'=>$_POST['price2'],'quantity'=>$_POST['qun'],'bulkpacketcount'=>$_POST['bulkpacketcount'],'type'=>$_POST['type'],'total_price'=>$_POST['price'],'temprandid' =>$_SESSION['CART_TEMP_RANDOM'],'p_img'=>$_POST['pimg']);
			//print_r($fieldnames);exit;
			$res=$callConfig->insertRecord(TPREFIX.TBL_CART,$fieldnames);
			}
			
		
		 header("Location:".SITEURL."/shopping_cart.php");
  }
  
  
  
  
  
 /* function updatetempcart($POST)
		{
		//print_r($_POST);exit;	
	//echo "hi";exit;		
		
			global $callConfig;
				//$initialweight=$_POST['weight']; 
	//$quantity=$_POST['quantity'];
 //$weight=$initialweight/$quantity; 
	
		
			//$finalweight=$_POST['weight'];
			
			 $finalweight=$_SESSION['weight'];
			//echo $pq = $_POST['qua'][0].'<br>'.$pq = $_POST['qua'][1];
			for($i=0; $i<count($_POST['quantity']); $i++) {
			
		$tprc = $_POST['quantity'][$i]*$_POST['indiv_price'][$i];
		echo	$weight = $finalweight*$_POST['quantity'][$i];
			
	print_r($fieldnames=array('quantity'=>$_POST['quantity'][$i],'weight'=>$weight ,'total_price'=>$tprc)); 
		 $whr = "prod_id='".$_POST['prod_id'][$i]."' and cart_id='".$_POST['cart_id'][$i]."' ";
			$res=$callConfig->updateRecord1(TPREFIX.TBL_CART,$fieldnames,$whr,'');
			
			}
			header("location:shopping_cart.php");
		}
	   
 */
  
   
function updatetempcart($post)
		{
		
			global $callConfig;
			//echo $pq = $_POST['qua'][0].'<br>'.$pq = $_POST['qua'][1];
			for($i=0; $i<count($_POST['quantity']); $i++) {
			
			$tprc = $_POST['quantity'][$i]*$_POST['indiv_price'][$i];
			$fieldnames=array('quantity'=>$_POST['quantity'][$i],'total_price'=>$tprc);
			
			
			$whr = "prod_id='".$_POST['prod_id'][$i]."' and cart_id='".$_POST['cart_id'][$i]."' ";
			$res=$callConfig->updateRecord1(TPREFIX.TBL_CART,$fieldnames,$whr,'');
			
			}
			//header("location:cart.php");
			header("location:shopping_cart.php");
		}
	  
   /*
	  function getindivqualitydata()
{
	    global $callConfig;
		$whr="spid='".$_POST['prod_id']."' and id ='".$_POST['id']."'";
	     $query=$callConfig->selectQuery('tb_store_value','*',$whr,'','','');
		// echo $query;// exit;
		return $callConfig->getRow($query);
}
*/
 
  
 
  function getindcart()
	 {
		global $callConfig;
	   $query=$callConfig->selectQuery(TPREFIX.TBL_CART,'*'," temprandid='".$_SESSION['CART_TEMP_RANDOM']."'",'','','');
		//echo $query; exit;
		return $callConfig->getAllRows($query);
	 }


  function getindsumcartvalue()
	 {
		global $callConfig;
	   $query=$callConfig->selectQuery(TPREFIX.TBL_CART,'SUM(total_price) as total'," temprandid='".$_SESSION['CART_TEMP_RANDOM']."' ",'','','');
		//echo $query; //exit;
		return $callConfig->getRow($query);
	 }
 
	   function deletetempcart($id)
	{
		global $callConfig;
	    $res=$callConfig->deleteRecord(TPREFIX.TBL_CART,'cart_id',$id);
		if($res!="")
		{
		//header("location:".SITEURL."/Addtocart");
		 header("Location:shopping_cart.php");
		}
		else
		{
		$callConfig->headerRedirect("shopping_cart.php?msg=no");
		}
		}
		
		
		/* function insertuserbilladdr()
	 {
	 global $callConfig;
	$_POST=$_REQUEST;
	 $fieldnames=array(
		'user_email'=>mysql_real_escape_string($_POST['emailaddress']),
		'first_name'=>mysql_real_escape_string($_POST['first_name']),
		'last_name'=>mysql_real_escape_string($_POST['last_name']),
		'status'=>mysql_real_escape_string($staus),
		'phone'=>mysql_real_escape_string($_POST['telephone']),
		
		'fax'=>mysql_real_escape_string($_POST['fax']),
		'companyname'=>mysql_real_escape_string($_POST['companyname']),
		
		
		'address'=>mysql_real_escape_string($_POST['address']),
		 'city'=>mysql_real_escape_string($_POST['city']),
		 'state'=>mysql_real_escape_string($_POST['state']),
		 'country'=>mysql_real_escape_string($_POST['country']),
		 'zip_code'=>mysql_real_escape_string($_POST['zip_code']));
		// $whr = "user_id='".$_SESSION['front_userid_val']."'";
		// $res=$callConfig->updateRecord(TPREFIX.TBL_USERBILLING,$fieldnames,$whr,'');
		
		$res=$callConfig->updateRecord('tb_user_billingaddress',$fieldnames,'user_id',$_SESSION['front_userid']);
		
		//$res=$callConfig->insertRecord('tb_user_billingaddress',$fieldnames,'user_id',$_SESSION['front_userid']);
		
		
		return $res;
	 
	 }
		*/
		
		
		
		
		
		  function insertuserbilladdr()
	 {
	 global $callConfig;
	$_POST=$_REQUEST;
	 $fieldnames=array(
		'user_email'=>mysql_real_escape_string($_POST['email']),
		'first_name'=>mysql_real_escape_string($_POST['first_name']),
		'last_name'=>mysql_real_escape_string($_POST['last_name']),
		'companyname'=>mysql_real_escape_string($_POST['companyname']),
		'status'=>mysql_real_escape_string($staus),
		'phone'=>mysql_real_escape_string($_POST['telephone']),
		'address'=>mysql_real_escape_string($_POST['address']),
		 'city'=>mysql_real_escape_string($_POST['city']),
		 'state'=>mysql_real_escape_string($_POST['state']),
		 'fax'=>mysql_real_escape_string($_POST['fax']),
		 'country'=>mysql_real_escape_string($_POST['country']),
		 'cart_id'=>$_SESSION['CART_TEMP_RANDOM'],
		 'zip_code'=>mysql_real_escape_string($_POST['zip_code']));
		
		$res=$callConfig->insertRecord('tb_user_billingaddress',$fieldnames,'user_id',$_SESSION['front_userid']);
		
		return $res;
	 
	 }
		
		
		
		
		
		
		  function insertguestbillingaddress()
	 {
	 global $callConfig;
$_POST=$_REQUEST;
	 $fieldnames=array(
		'user_email'=>mysql_real_escape_string($_POST['email']),
		'first_name'=>mysql_real_escape_string($_POST['first_name']),
		'last_name'=>mysql_real_escape_string($_POST['last_name']),
		'companyname'=>mysql_real_escape_string($_POST['companyname']),
		'status'=>mysql_real_escape_string($staus),
		'phone'=>mysql_real_escape_string($_POST['telephone']),
		'address'=>mysql_real_escape_string($_POST['address']),
		 'city'=>mysql_real_escape_string($_POST['city']),
		'dateofbirth'=>mysql_real_escape_string($_POST['date']),
		 
		 'state'=>mysql_real_escape_string($_POST['state']),
		 'fax'=>mysql_real_escape_string($_POST['fax']),
		 'country'=>mysql_real_escape_string($_POST['country']),
		 'cart_id'=>$_SESSION['CART_TEMP_RANDOM'],
		 'zip_code'=>mysql_real_escape_string($_POST['zip_code']));
		 
		 //print_r('dateofbirth');exit;
		
		$res=$callConfig->insertRecord('tb_guestubillingaddress',$fieldnames);
		
		return $res;
	 
	 }
		
		
		 function insertshipuserbilladdr()
	 {
	 global $callConfig;
	$_POST=$_REQUEST; 
	 
	 $fieldnames=array(
		'user_email'=>mysql_real_escape_string($_POST['emailaddress']),
		'first_name'=>mysql_real_escape_string($_POST['first_name']),
		'last_name'=>mysql_real_escape_string($_POST['last_name']),
		'status'=>mysql_real_escape_string($staus),
		'phone'=>mysql_real_escape_string($_POST['telephone']),
	
	'companyname'=>mysql_real_escape_string($_POST['companyname']),
	'fax'=>mysql_real_escape_string($_POST['fax']),
	
	
	
		'address'=>mysql_real_escape_string($_POST['address']),
		 'city'=>mysql_real_escape_string($_POST['city']),
		 'state'=>mysql_real_escape_string($_POST['state']),
		 'country'=>mysql_real_escape_string($_POST['country']),
		 'zip_code'=>mysql_real_escape_string($_POST['zip_code']));
		// $whr = "user_id='".$_SESSION['front_userid_val']."'";
		// $res=$callConfig->updateRecord(TPREFIX.TBL_USERBILLING,$fieldnames,$whr,'');
		//return $fieldnames;
		$res=$callConfig->updateRecord('tb_user_shippingaddress',$fieldnames,'user_id',$_SESSION['front_userid']);
		return $res;
	 
	 }
	 
	   function inserguestshippingaddress($post)
	 {
	 global $callConfig;
	 $fieldnames=array(
		'user_email'=>mysql_real_escape_string($post['email']),
		'first_name'=>mysql_real_escape_string($post['first_name']),
		'last_name'=>mysql_real_escape_string($post['last_name']),
		'status'=>mysql_real_escape_string($staus),
		'phone'=>mysql_real_escape_string($post['telephone']),
		'companyname'=>mysql_real_escape_string($post['companyname']),
		'fax'=>mysql_real_escape_string($post['fax']),
		'address'=>mysql_real_escape_string($post['address']),
		 'city'=>mysql_real_escape_string($post['city']),
		 'state'=>mysql_real_escape_string($post['state']),
		 'country'=>mysql_real_escape_string($post['country']),
		 'cart_id'=>$_SESSION['CART_TEMP_RANDOM'],
		 'zip_code'=>mysql_real_escape_string($post['zip_code']));
			
		$res=$callConfig->insertRecord('tb_guesthppingaddress',$fieldnames);
		
		return $res;
	 
	 }
	 
	 function insertenquirytest($post)
	{ 
	 // print_r($_POST);
	  //exit;
	global $callConfig;
	  $query="select * from tb_user_billingaddress ORDER BY id LIMIT 0,1";
	$det=$callConfig->getRow($query);
	
    if($_POST['toth']!=""){ 
    //print_r($_POST['paypal']); exit;
	
	    $_SESSION['user_name']=$_POST['user_name'];
		$_SESSION['user_type']=$_POST['user_type'];
		$_SESSION['user_email']=$_POST['user_email'];
	    $_SESSION['amount']=$_POST['toth'];
		 $_SESSION['shipmethod']=$_POST['shipmethod'];
		 $_SESSION['pro_id']=$_POST['prod_id'];
		 $_SESSION['pro_qunatity']=$_POST['prod_quantity'];
		 $_SESSION['shipamount']=$_POST['shiprh'];
		 $_SESSION['pro_name']=$_POST['prod_name'];
		 $_SESSION['pro_price']=$_POST['prod_price'];
	     $_SESSION['taxh']=$_POST['taxh'];
		 $_SESSION['disch']=$_POST['disch'];
		 $_SESSION['paypal']=$_POST['paypal'];
		 $_SESSION['uid']=$_POST['uid'];
		 $_SESSION['provider_id']=$_POST['provider_id']; 
		
		if($_POST['paypal']=="paypal") //&& $_SESSION['front_userid']!="")
		{ 
		  $callConfig->headerRedirect("paypal.php?payaplid=paypal");
		 }
	   }	
	}
	 
	 
	 
	 
	 
/*
  function couponEntryChance()
  {
		global $callConfig;
		$whr="temprandid='".$_SESSION['CART_TEMP_RANDOM']."' and (discount='no' || discount='') and quantity!='0'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_CART,'discount',$whr,$order,$start,$limit);
		return $callConfig->getCount($query);
  }
  
  
  
  function getCouponCount($couponcode)
	 {
		 //print_r($couponcode); exit;
	 	global $callConfig;
		 $whr=" couponcode='".$couponcode."' and expiredtime>='".ONLY_DATE."'";
		 $query=$callConfig->selectQuery(TPREFIX.TBL_STORECOUPONS,'*',$whr,$order,$start,$limit);
		 //exit;
		return $callConfig->getCount($query);
		
	 }
	 
	 function couponvalidPriceCaliculation($couponcode,$randomid)
	 {
		global $callConfig;
		
		//echo $randomid; exit;
		$whr=" couponcode='".$couponcode."' and expiredtime >='".ONLY_DATE."'";
		 $query=$callConfig->selectQuery(TPREFIX.TBL_STORECOUPONS,'*',$whr,$order,$start,$limit);
		 $res=$callConfig->getRow($query);
		
		if($res->id!=0)
		{
		   $fieldnames=array('couponcode'=>$couponcode,'discount'=>'yes','discountamount'=>$res->discount,'distype'=>$res->distype);
		   //print_r($fieldnames);exit;
		 //  echo $_SESSION['CART_TEMP_RANDOM']; exit;
		   $res2=$callConfig->updateRecord(TPREFIX.TBL_CART,$fieldnames,'temprandid',$randomid);
		}
		//return $res;
	 }
	 
	 function discountCaliculation($discountamount,$discounttype,$subtotal)

	 {
        // echo $discountamount;
		// echo "<br/>";
		 //echo $discounttype;
		// echo "<br/>";
		 //echo $subtotal; 
		if($discounttype=='price')

		{

		  return number_format($discountamount);

		}

		else

		{

		return number_format(($discountamount*$subtotal)/100,1);

		}

		

	 }

 function getindcart()
	 {
		global $callConfig;
	    $query=$callConfig->selectQuery(TPREFIX.TBL_CART,'*'," temprandid='".$_SESSION['CART_TEMP_RANDOM']."'",'','','');
		//echo $query; 
		return $callConfig->getAllRows($query);
	 }

*/


	  function couponEntryChance()
  {
		global $callConfig;
		$whr="temprandid='".$_SESSION['CART_TEMP_RANDOM']."' and (discount='no' || discount='') and quantity!='0'";
		$query=$callConfig->selectQuery(TPREFIX.TBL_CART,'discount',$whr,$order,$start,$limit);
		return $callConfig->getCount($query);
  }
  
  
  
  function getCouponCount($couponcode)
	 {
	 	global $callConfig;
		$whr=" couponcode='".$couponcode."' and expiredtime>='".ONLY_DATE."'";
		  $query=$callConfig->selectQuery(TPREFIX.TBL_STORECOUPONS,'*',$whr,$order,$start,$limit);
		 //exit;

		return $callConfig->getCount($query);
		
	 }
	 
	 function couponvalidPriceCaliculation($couponcode,$randomid)
	 {
		global $callConfig;
		
		//echo $randomid; exit;
		$whr=" couponcode='".$couponcode."' and expiredtime>='".ONLY_DATE."'";
		 $query=$callConfig->selectQuery(TPREFIX.TBL_STORECOUPONS,'*',$whr,$order,$start,$limit);
		 $res=$callConfig->getRow($query);
		
		if($res->id!=0)
		{
		   $fieldnames=array('couponcode'=>$couponcode,'discount'=>'yes','discountamount'=>$res->discount,'distype'=>$res->distype);
		   //print_r($fieldnames);exit;
		 //  echo $_SESSION['CART_TEMP_RANDOM']; exit;
		   $res2=$callConfig->updateRecord(TPREFIX.TBL_CART,$fieldnames,'temprandid',$randomid);
		}
		return $res;
	 }
	 
	 function discountCaliculation($discountamount,$discounttype,$subtotal)

	 {

		if($discounttype=='price')

		{

		  return number_format($discountamount);

		}

		else

		{

		return number_format(($discountamount*$subtotal)/100,1);

		}

		

	 }

	 

}
?>