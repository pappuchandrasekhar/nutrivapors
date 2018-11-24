<?php

class sizeClass

{ 

  function getAllsizeList($sortfield,$order,$start,$limit)

  {

	global $callConfig;

	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;

	$query=$callConfig->selectQuery(TPREFIX.TBL_SIZE,'*','',$order,$start,$limit);

	return $callConfig->getAllRows($query);

  } 

  function getAllContentPagesListCount()

  {

	global $callConfig;

	$query=$callConfig->selectQuery(TPREFIX.TBL_SIZE,'id','','','','');

	 return $callConfig->getCount($query);

  } 

  

  function getContentPageData($id)

  {

	global $callConfig;

	$query=$callConfig->selectQuery(TPREFIX.TBL_SIZE,'*','id='.$id,'','','');

	return $callConfig->getRow($query);

 }

 

	function insertcontentPage($post)

	{

	global $callConfig;

	
	$fieldnames=array('size'=>mysql_real_escape_string($post['size']),'status'=>$post['status']);
	//print_r($fieldnames);exit;
	$res=$callConfig->insertRecord(TPREFIX.TBL_SIZE,$fieldnames);


	if($res!="")

	{

		sitesettingsClass::recentActivities('Size created successfully on >> '.DATE_TIME_FORMAT.'','g');

		$callConfig->headerRedirect("index.php?option=com_size&err=Page created successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('Size creation failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_size&ferr=Page creation failed");

	}

	}

	

	function updatecontentPage($post)

	{

	global $callConfig;

	if($post['title_slug']!="")

	$titleslug=$callConfig->remove_special_symbols($post['title_slug']);

	else

	$titleslug=$callConfig->remove_special_symbols($post['title']);

	$fieldnames=array('size'=>mysql_real_escape_string($post['size']),'status'=>$post['status']);

	$res=$callConfig->updateRecord(TPREFIX.TBL_SIZE,$fieldnames,'id',$post['hdn_page_id']);

	if($res==1)

	{

		sitesettingsClass::recentActivities('Size updated successfully on >> '.DATE_TIME_FORMAT.'','g');

		$callConfig->headerRedirect("index.php?option=com_size&err=Page updated successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('Size updation failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_size&ferr=Page updation failed");

	}

	}

	function contentpageDelete($id)

	{

	global $callConfig;

	$res=$callConfig->deleteRecord(TPREFIX.TBL_SIZE,'id',$id);

	if($res==1)

	{

		sitesettingsClass::recentActivities('Size deleted successfully on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_size&err=Page deleted successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('Size deletion failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_size&ferr=Page deletion failed");

	}

	}



}

?>