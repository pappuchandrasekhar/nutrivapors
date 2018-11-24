<?php
class couponsclass
{ 
 // Product category //
  function getAllcouponsList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery(TPREFIX.TBL_COUPONS,'*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllcouponsListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_COUPONS,'id','','','','');
	 return $callConfig->getCount($query);
  } 
  
    function getAllStoreCategoryList($where,$sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	if($where!="")
	$whr=" status='".$where."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORECATEGORY,'*',$whr,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 

  function getcouponsData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_COUPONS,'*','id='.$id,'','','');
	return $callConfig->getRow($query);
  }
 
	function insertcoupons($post)
	{
	global $callConfig;
	//$randomid='NIV'.rand(100000,10000000);
	$randomid=$post['coupon_code'];
	$querysel=$callConfig->selectQuery(TPREFIX.TBL_COUPONS,'couponcode'," couponcode='".$post['couponcode']."' ",'','','');
	$cnt=$callConfig->getCount($querysel);
	if($cnt<=0)
	{
		//print_r($post['expiredon']);
		
		$dateArray=explode('-',$post['expiredtime']);
		$dt = $dateArray[0].'-'.$dateArray[1].'-'.$dateArray[2];
		
		$fieldnames=array('couponcode'=>$randomid,'cid'=>$post['scid'],'coupon_title'=>$post['coupon_title'],'distype'=>$post['distype'],'discount'=>$post['discount'],'expiredtime'=>$dt);
		
		//print_r($fieldnames);
		
		$res=$callConfig->insertRecord(TPREFIX.TBL_COUPONS,$fieldnames);
		if($res!="")
		{
			sitesettingsClass::recentActivities('Store >> Promocode created successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=com_promocode&err=Store Promocode created successfully");
			exit;
		}
		else
		{
			sitesettingsClass::recentActivities('Store >> Promocode creation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_promocode&ferr=Store Promocode creation failed");
			exit;
		}
	} 
	else 
	{
	        sitesettingsClass::recentActivities('Store >> Coupon already exist in database >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_promocode&ferr=Store Promocode already exist in database");
	}
	}
	
	function updatecoupons($post)
	{
	global $callConfig;
	$querysel=$callConfig->selectQuery(TPREFIX.TBL_COUPONS,'couponcode'," couponcode='".$post['couponcode']."' and id!='".$post['hdn_id']."' ",'','','');
	$cnt=$callConfig->getCount($querysel);
	if($cnt<=0)
	{
	    $dateArray=explode('-',$post['expiredtime']);
		$dt = $dateArray[0].'-'.$dateArray[1].'-'.$dateArray[2];
		     $randomid=$post['coupon_code'];
			$fieldnames=array('couponcode'=>$randomid,'coupon_title'=>$post['coupon_title'],'cid'=>$post['scid'],'distype'=>$post['distype'],'discount'=>$post['discount'],'expiredtime'=>$dt);
			//print_r($fieldnames);exit;
	    $res=$callConfig->updateRecord(TPREFIX.TBL_COUPONS,$fieldnames,'id',$post['hdn_id']);
		if($res==1)
		{
			sitesettingsClass::recentActivities('Store >> Promocode updated successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=com_promocode&err=Store Coupon updated successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Store >> Promocode updation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_promocode&ferr= Promocode updation failed");
		}
	} 
	else 
	{
	    sitesettingsClass::recentActivities('Store >> Promocode already exist in database >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_promocode&ferr=Store Promocode already exist in database");
	}
	}
	
	
	function couponsDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_COUPONS,'id',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Subject deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_promocode&err=Subject deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Subject deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_promocode&ferr=Subject deletion failed");
	}
	}
	
	// Product category  
}	
	?>