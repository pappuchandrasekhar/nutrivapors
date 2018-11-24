<?php
class testimonialClass
{ 
 // Product category //
  function getAllNeweventsList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery(TPREFIX.TBL_TESTIMONIAL,'*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllNeweventsListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_TESTIMONIAL,'id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getNeweventData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_TESTIMONIAL,'*','id='.$id,'','','');
	return $callConfig->getRow($query);
  }
 
	function insertNewevents($post)
	{
	global $callConfig;
	$bannerimage = $callConfig->freeimageUploadcomncode("banner","image","../uploads/testimonial/","../uploads/testimonial/thumbs/",$post['hdn_image'],100,100);
	$fieldnames=array('title'=>mysql_real_escape_string($post['title']),'description'=>mysql_real_escape_string($post['bigtext']),'image'=>$bannerimage,'status'=>$post['status'],'name'=>mysql_real_escape_string($post['name']),'designation'=>mysql_real_escape_string($post['designation']),'display_order'=>$post['display_order']);
	$res=$callConfig->insertRecord(TPREFIX.TBL_TESTIMONIAL,$fieldnames);
	if($res!="")
	{
		sitesettingsClass::recentActivities('testimonial created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_testimonial&err=testimonial created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('testimonial creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_testimonial&ferr=testimonial creation failed");
	}
	}
	
	function updateNewevents($post)
	{
	 global $callConfig;
	 $bannerimage = $callConfig->freeimageUploadcomncode("banner","image","../uploads/testimonial/" ,"../uploads/testimonial/thumbs/",$post['hdn_image'],100,100); 
	$fieldnames=array('title'=>mysql_real_escape_string($post['title']),'description'=>mysql_real_escape_string($post['bigtext']),'image'=>$bannerimage,'status'=>$post['status'],'name'=>mysql_real_escape_string($post['name']),'designation'=>mysql_real_escape_string($post['designation']),'display_order'=>$post['display_order']);
	$res=$callConfig->updateRecord(TPREFIX.TBL_TESTIMONIAL,$fieldnames,'id',$post['hdn_id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('testimonial updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_testimonial&err=testimonial updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('testimonial updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_testimonial&ferr=testimonial updation failed");
	}
	}
	function neweventsDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_TESTIMONIAL,'id',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('testimonial deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_testimonial&err=testimonial deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('testimonial deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_testimonial&ferr=testimonial deletion failed");
	}
	}
	
	// Product category  
}	
	?>