<?php
class faqClass
{ 
 // Product category TBL_CORPORATETESTIMONIAL//
 function get_All_FullNames($tablename,$returnvar,$where)
	{ 
	    global $callConfig;
		$query=$callConfig->selectQuery($tablename,$returnvar,$where,'','','');
		$res=$callConfig->getRow($query); 
		return $res->$returnvar; 
	}
  function getAllfaqClassList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery(TPREFIX.TBL_FAQ,'*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllfaqClassListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_FAQ,'id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getfaqData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_FAQ,'*','id='.$id,'','','');
	return $callConfig->getRow($query);
  }
 
	function insertfaq($post)
	{
	global $callConfig;
	
	 $fieldnames=array('question'=>mysql_real_escape_string($post['question']),'answer'=>mysql_real_escape_string($post['answer']),'status'=>$post['status']); 
	// print_r($fieldnames); exit;
	$res=$callConfig->insertRecord(TPREFIX.TBL_FAQ,$fieldnames); 
	if($res!="") 
	{
		sitesettingsClass::recentActivities('faq created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_faq&err=faq created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('faq creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_faq&ferr=faq creation failed");
	}
	}
	
	function updatefaq($post)
	{
	global $callConfig;
	
	 $fieldnames=array('question'=>mysql_real_escape_string($post['question']),'answer'=>mysql_real_escape_string($post['answer']),'status'=>$post['status']); 
	//print_r($fieldnames);exit;
	$res=$callConfig->updateRecord(TPREFIX.TBL_FAQ,$fieldnames,'id',$post['hdn_id']);
	
	if($res==1)
	{
		sitesettingsClass::recentActivities('faq updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_faq&err=faq updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('faq updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_faq&ferr=faq updation failed");
	}
	}
	function faqDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_FAQ,'id',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('faq deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_faq&err=faq deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('faq deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_faq&ferr=faq deletion failed");
	}
	}
	function searchkeyword($searchword,$sortfield,$order,$start,$limit)
	{
		global $callConfig;	
		$where="title like '%".$searchword."%' ";
		$query=$callConfig->selectQuery(TPREFIX.TBL_FAQ,'*',$where,'','','');
		return $callConfig->getAllRows($query);
	}
	function getsearchkeyword1Count($searchword)
  	{
	global $callConfig;
	$where="title like '%".$searchword."%' ";
	$query=$callConfig->selectQuery(TPREFIX.TBL_FAQ,'id',$where,'','','');
	 return $callConfig->getCount($query);
  	} 
	/// Product category  

function getaswin($cid)
  {
		  global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_CATEGORY,'cid','title','','','');
	 return $callConfig->getCount($query);
  } 
	

}	
	?>