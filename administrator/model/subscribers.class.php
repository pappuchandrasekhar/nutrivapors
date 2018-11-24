<?php
class subClass
{ 

 // Product category //
 function getAllSubscribersList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery('tb_newsletter_subscribers','*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllSubscribersListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery('tb_newsletter_subscribers','id','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getSubscribersData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery('tb_newsletter_subscribers','*','id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	function insertSubscribers($post)
	{
	global $callConfig;
	$fieldnames=array('question'=>mysql_real_escape_string($post['question']),'answer'=>mysql_real_escape_string($post['answer']),'status'=>$post['status']);
	$res=$callConfig->insertRecord('tb_newsletter_subscribers',$fieldnames);
	if($res!="")
	{
		sitesettingsClass::recentActivities('Subscribers created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=subscribers&err=Subscribers created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Subscribers creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=subscribers&ferr=Subscribers creation failed");
	}
	}
	
	function updateSubscribers($post)
	{
	global $callConfig;
$fieldnames=array('question'=>mysql_real_escape_string($post['question']),'answer'=>mysql_real_escape_string($post['answer']),'status'=>$post['status']);
	$res=$callConfig->updateRecord('tb_newsletter_subscribers',$fieldnames,'id',$post['hdn_id']);
	if($res!="")
	{
		sitesettingsClass::recentActivities('Subscribers updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=subscribers&err=Subscribers updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Subscribers updattion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=subscribers&ferr=Subscribers updattion failed");
	}
	}
	function SubscribersDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord('tb_newsletter_subscribers','id',$id);
	if($res!="")
	{
		sitesettingsClass::recentActivities('Subscribers deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=subscribers&err=Subscribers deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Subscribers deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=subscribers&ferr=Subscribers deletion failed");
	}
	}
	
	/// Product category  
}	
	?>