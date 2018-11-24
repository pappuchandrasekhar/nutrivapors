<?php
class bannersClass
{ 
 // Product category //
  function getAllNeweventsList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery(TPREFIX.TBL_Banners,'*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllNeweventsListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_BANNERS,'id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getNeweventData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_BANNERS,'*','id='.$id,'','','');
	return $callConfig->getRow($query);
  }
 
	function insertNewevents($post)
	{
	global $callConfig;
	 $bannerimage = $callConfig->freeimageUploadcomncode("banner","image","../uploads/banners/","../uploads/banners/thumbs/",$post['hdn_image'],150,150);
	$fieldnames=array('title'=>mysql_real_escape_string($post['title']),'content'=>mysql_real_escape_string($post['content']),'url'=>$_POST['url'],'bigtext'=>mysql_real_escape_string($post['bigtext']),'image'=>$bannerimage,'status'=>$post['status'],'display_order'=>$post['display_order']);
	$res=$callConfig->insertRecord(TPREFIX.TBL_BANNERS,$fieldnames);
	if($res!="")
	{
		sitesettingsClass::recentActivities('Banners created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_bannerslist&err=Banners created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Banners creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_bannerslist&ferr=Banners creation failed");
	}
	}
	
	function updateNewevents($post)
	{
	global $callConfig;
	 $bannerimage = $callConfig->freeimageUploadcomncode("banner","image","../uploads/banners/" ,"../uploads/homebanners/thumbs/",$post['hdn_image'],150,150); 
	$fieldnames=array('title'=>mysql_real_escape_string($post['title']),'content'=>mysql_real_escape_string($post['content']),'url'=>$_POST['url'],'bigtext'=>mysql_real_escape_string($post['bigtext']),'image'=>$bannerimage,'status'=>$post['status'],'display_order'=>$post['display_order']);
	$res=$callConfig->updateRecord(TPREFIX.TBL_BANNERS,$fieldnames,'id',$post['hdn_id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Banners updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_bannerslist&err=Banners updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Banners updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_bannerslist&ferr=Banners updation failed");
	}
	}
	function neweventsDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_BANNERS,'id',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Banners deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_bannerslist&err=Banners deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Banners deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_bannerslist&ferr=Banners deletion failed");
	}
	}
	
	// Product category  
}	
	?>