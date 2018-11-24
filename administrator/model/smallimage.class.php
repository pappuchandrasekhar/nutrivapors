<?php
class smallimageClass
{ 
 // Product category //
  function getAllsmallimagesList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
   $query=$callConfig->selectQuery(TPREFIX.TBL_SMALLIMAGES,'*','','id DESC',$start,$limit);
	
	return $callConfig->getAllRows($query);
  } 
    function getAllsmallimagesActiveList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
   $query=$callConfig->selectQuery(TPREFIX.TBL_SMALLIMAGES,'*','status='."'".Active."'",'id DESC',$start,$limit);
	
	return $callConfig->getAllRows($query);
  } 
  function getAllsmallimagesListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_SMALLIMAGES,'id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getsmallimagesData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_SMALLIMAGES,'*','id='.$id,'','','');
	return $callConfig->getRow($query);
  }
 
	function insertsmallimages($post)
	{
	global $callConfig;
	$image = $callConfig->freeimageUploadcomncode("image",'image',"../uploads/smallimage/",'',$post['hdn_image'],150,150);
	$fieldnames=array('title'=>mysql_real_escape_string($post['title']),'hyplink'=>mysql_real_escape_string($post['hyplink']),'image'=>$image,'content'=>mysql_real_escape_string($post['content']),'status'=>$post['status']);
	$res=$callConfig->insertRecord(TPREFIX.TBL_SMALLIMAGES,$fieldnames);
	if($res!="")
	{
		sitesettingsClass::recentActivities('partner created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_smallimageslist&err=partner created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('partner creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_smallimageslist&ferr=partner creation failed");
	}
	}
	
	function updatesmallimages($post)
	{
	global $callConfig;
	$image = $callConfig->freeimageUploadcomncode("image",'image',"../uploads/smallimage/",'',$post['hdn_image'],150,150);
	$fieldnames=array('title'=>mysql_real_escape_string($post['title']),'hyplink'=>mysql_real_escape_string($post['hyplink']),'image'=>$image,'content'=>mysql_real_escape_string($post['content']),'status'=>$post['status']);
	$res=$callConfig->updateRecord(TPREFIX.TBL_SMALLIMAGES,$fieldnames,'id',$post['hdn_id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('partner updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_smallimageslist&err=partner updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('partner updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_smallimageslist&ferr=partner updation failed");
	}
	}
	function smallimagesDelete($id)
	{
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_SMALLIMAGES,'image','id='.$id,'','','');
	$imageres = $callConfig->getRow($query);
	$callConfig->imageCommonUnlink("../uploads/smallimage/","",$imageres->image);
	$res=$callConfig->deleteRecord(TPREFIX.TBL_SMALLIMAGES,'id',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('partner deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_smallimageslist&err=partner deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('partner deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_smallimageslist&ferr=partner deletion failed");
	}
	}
	
	/// Product category  
}	
	?>