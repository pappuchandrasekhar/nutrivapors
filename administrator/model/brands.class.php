<?php
class brandClass
{ 
 // Product category //
 
 
  function getAllBrandList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
     $query=$callConfig->selectQuery(TPREFIX.TBL_BRANDS,'*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllBrandsListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_BRANDS,'bid','','','','');
	 return $callConfig->getCount($query);
  } 
  
  /*function getAllBrandList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery(TPREFIX.TBL_BRANDS,'*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllBrandsListCount()
  {
	global $callConfig;
	 $query=$callConfig->selectQuery(TPREFIX.TBL_BRANDS,'id','','','','');
	 return $callConfig->getCount($query);
  } 
  */
  function getBrandData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_BRANDS,'*','bid='.$id,'','','');
	return $callConfig->getRow($query);
  }
 
	function insertBrands($post)
	{
	global $callConfig;
	 $brandimage = $callConfig->freeimageUploadcomncode("banner","image","../uploads/brands/","../uploads/brands/thumbs/",$post['hdn_image'],150,150);
	$fieldnames=array('title'=>mysql_real_escape_string($post['title']),'description'=>mysql_real_escape_string($post['bigtext']),'image'=>$brandimage,'display_order'=>$post['display_order'],'status'=>$post['status']);
	$res=$callConfig->insertRecord(TPREFIX.TBL_BRANDS,$fieldnames);
	if($res!="")
	{
		sitesettingsClass::recentActivities('Banners created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_brands&err=Brands created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Banners creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_brands&ferr=Brands creation failed");
	}
	}
	
	function updateBrand($post)
	{
	global $callConfig;
	 $brandimage = $callConfig->freeimageUploadcomncode("banner","image","../uploads/brands/" ,"../uploads/brands/thumbs/",$post['hdn_image'],150,150); 
	$fieldnames=array('title'=>mysql_real_escape_string($post['title']),'description'=>mysql_real_escape_string($post['bigtext']),'image'=>$brandimage,'display_order'=>$post['display_order'],'status'=>$post['status']);
	//print_r($fieldnames); exit;
	$res=$callConfig->updateRecord(TPREFIX.TBL_BRANDS,$fieldnames,'bid',$post['hdn_id']);
	//print_r($res); exit;
	if($res==1)
	{
		sitesettingsClass::recentActivities('Banners updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_brands&err=Brands updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Banners updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_brands&ferr=Brands updation failed");
	}
	}
	function BrandsDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_BRANDS,'bid',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Banners deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_brands&err=Brands deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Banners deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_brands&ferr=Brands deletion failed");
	}
	}
	
	// Product category  
}	
	?>