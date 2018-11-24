<?php

class commentClass

{ 

  function getAllcommentsList($sortfield,$order,$start,$limit)

  {
	  global $callConfig;

	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;

	$query=$callConfig->selectQuery(TPREFIX.TBL_COMMENTSECTION,'*','',$order,$start,$limit);

	return $callConfig->getAllRows($query);

  } 

  function getAllcommentsListCount()

  {

	global $callConfig;

	$query=$callConfig->selectQuery(TPREFIX.TBL_COMMENTSECTION,'email','','','','');

	 return $callConfig->getCount($query);

  } 

  

  

 

  

  

	function commentDelete($id)

	{

	global $callConfig;

	$res=$callConfig->deleteRecord(TPREFIX.TBL_COMMENTSECTION,'id',$id);

	if($res==1)

	{

		sitesettingsClass::recentActivities('comments deleted successfully on >> '.DATE_TIME_FORMAT.'','g');

		$callConfig->headerRedirect("index.php?option=com_comments&err=comments deleted successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('comments deletion failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_comments&ferr=comments deletion failed");

	}

	}

	

	function commentsStatusChanging($get){

	global $callConfig;

	if($get['st']=="Active")

	$statusbe='Inactive';

	else

	$statusbe='Active';

	$fieldnames=array('status'=>$statusbe);

	$res=$callConfig->updateRecord(TPREFIX.TBL_COMMENTSECTION,$fieldnames,'id',$get['id']);

	if($res==1)

	{

		sitesettingsClass::recentActivities('comments Status changed successfully on >> '.DATE_TIME_FORMAT.'','g');

		$callConfig->headerRedirect("index.php?option=com_comments&err=comments Status changed successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('comments Status changing failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_comments&ferr=comments Status changing failed");

	}

	}

	
function getcommentdata($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_COMMENTSECTION,'*','id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	
	
	function insertcomments($post)
	{
	global $callConfig;
	if($post['title_slug']!="")
	$titleslug=$callConfig->remove_special_symbols($post['title_slug']);
	else
	$titleslug=$callConfig->remove_special_symbols($post['title']);
	$fieldnames=array('name'=>mysql_real_escape_string($post['title']),'email'=>$_POST['emaillat'],'review'=>mysql_real_escape_string($post['review']),'reviewtitle'=>mysql_real_escape_string($post['reviewtitle']),'rating'=>mysql_real_escape_string($post['rating']),'location'=>mysql_real_escape_string($post['location']),'status'=>$post['status']);
	$res=$callConfig->insertRecord(TPREFIX.TBL_COMMENTSECTION,$fieldnames);
	if($res!="")
	{
		sitesettingsClass::recentActivities('comments created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_comments&err=comments created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('comments creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_comments&ferr=comments creation failed");
	}
	}
	
	function updatecomments($post)
	{
	global $callConfig;
	if($post['title_slug']!="")
	$titleslug=$callConfig->remove_special_symbols($post['title_slug']);
	else
	$titleslug=$callConfig->remove_special_symbols($post['title']);
	$fieldnames=array('name'=>mysql_real_escape_string($post['title']),'email'=>$_POST['emaillat'],'review'=>mysql_real_escape_string($post['review']),'reviewtitle'=>mysql_real_escape_string($post['reviewtitle']),'rating'=>mysql_real_escape_string($post['rating']),'location'=>mysql_real_escape_string($post['location']),'status'=>$post['status']);
	$res=$callConfig->updateRecord(TPREFIX.TBL_COMMENTSECTION,$fieldnames,'id',$post['hdn_id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('comments updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_comments&err=comments updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('comments updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_comments&ferr=comments updation failed");
	}
	}





	

}	

	?>